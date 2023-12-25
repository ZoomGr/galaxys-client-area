<?php
	function createEntity($parent, $isWidget)
	{
		global $db;
		
		$query = "INSERT INTO entities
			(entity_creation_date, entity_creator, entity_order, entity_parent, entity_visible, entity_removable, entity_is_widget)
			VALUES
			(UTC_TIMESTAMP(), ?, ?, ?, 1, 1, ?)";
			
		$result = $db->request($query, array($_SESSION["user"], getEntityMaxOrder(), $parent, $isWidget));
		
		$insertId = $db->insertId();
		if($insertId)
		{
			return $insertId;
		}
		else
		{
			return false;
		}
	}
	
	function saveOrder($entityId)
	{
		global $db;
		
		if( isset($_POST["order"]) && is_string($_POST["order"]) && ctype_digit($_POST["order"]) )
		{
			$db->request("UPDATE entities SET entity_order=? WHERE entity_id=?", array($_POST["order"], $entityId));
		}
	}
	
	function saveVisibility($entityId)
	{
		global $db;
		
		if( isset($_POST["visibility"]) && is_string($_POST["visibility"]) && ctype_digit($_POST["visibility"]) )
		{
			if($_POST["visibility"]==="1")
			{
				$visibility = 1;
			}
			else
			{
				$visibility = 0;
			}
			
			$db->request("UPDATE entities SET entity_visible=? WHERE entity_id=?", array($visibility, $entityId));
		}
	}
	
	function saveRemovable($entityId)
	{
		global $db;
		
		if( isset($_POST["removable"]) && is_string($_POST["removable"]) && ctype_digit($_POST["removable"]) )
		{
			if($_POST["removable"]==="1")
			{
				$removable = 1;
			}
			else
			{
				$removable = 0;
			}
			
			$db->request("UPDATE entities SET entity_removable=? WHERE entity_id=?", array($removable, $entityId));
		}
	}
	
	function saveGallery($entityId)
	{
		global $db;
		
		if( isset($_FILES["gallery"]) && is_array($_FILES["gallery"]["error"]) )
		{
			foreach($_FILES["gallery"]["error"] as $ind=>$uploadError)
			{
				if($uploadError==UPLOAD_ERR_OK)
				{
					$mediaPath = false;
					
					if( isValidImage($_FILES["gallery"]["name"][$ind]) )
					{
						$mediaPath = uploadImage($_FILES["gallery"]["tmp_name"][$ind], pathinfo($_FILES["gallery"]["name"][$ind], PATHINFO_EXTENSION));
					}
					elseif( isValidFile($_FILES["gallery"]["name"][$ind]) )
					{
						$mediaPath = uploadFile($_FILES["gallery"]["tmp_name"][$ind], pathinfo($_FILES["gallery"]["name"][$ind], PATHINFO_EXTENSION));
					}
					
					if($mediaPath!==false)
					{
						$db->request("INSERT INTO entity_gallery (eg_entity, eg_path, eg_order) VALUES (?, ?, ?)", array($entityId, $mediaPath, getGalleryMaxOrder()));
					}
				}
			}
		}
	}
	
	function getGallery($entityId)
	{
		global $db;
		
		$ret = array();
		
		$results = $db->data("SELECT * FROM entity_gallery WHERE eg_entity=? ORDER BY eg_order DESC", array($entityId));
		foreach($results as $result)
		{
			$result["entity_gallery_lang"] = getGalleryData($result["eg_id"]);
			
			$ret[] = $result;
		}
		
		return $ret;
	}
	
	function getGalleryData($galleryId)
	{
		global $db;
		
		return $db->data("SELECT * FROM entity_gallery_lang WHERE egl_gallery=?", array($galleryId));
	}
	
	function findInGalleryData($galleryData, $language)
	{
		foreach($galleryData as $galleryDataRow)
		{
			if($galleryDataRow["egl_language"]===$language)
			{
				return $galleryDataRow["egl_title"];
			}
		}
		
		return "";
	}
	
	function saveGalleryData($entityId)
	{
		global $db, $languages;
		
		$gallery = getGallery($entityId);
		foreach($gallery as $photo)
		{
			foreach($languages as $ind=>$language)
			{
				$postKey = "gallery_".$photo["eg_id"]."_".$ind;
				
				if( isset($_POST[$postKey]) && is_string($_POST[$postKey]) && trim($_POST[$postKey])!=="" )
				{
					$query = "INSERT INTO entity_gallery_lang (egl_gallery, egl_language, egl_title) VALUES (?, ?, ?)
						ON DUPLICATE KEY UPDATE egl_title=?";
						
					$db->request($query, array($photo["eg_id"], $language["language_id"], trim($_POST[$postKey]), trim($_POST[$postKey])));
				}
				else
				{
					$query = "INSERT INTO entity_gallery_lang (egl_gallery, egl_language, egl_title) VALUES (?, ?, NULL)
						ON DUPLICATE KEY UPDATE egl_title=NULL";
						
					$db->request($query, array($photo["eg_id"], $language["language_id"]));
				}
			}
		}
		
		if( isset($_POST["galleryOrder"]) && is_array($_POST["galleryOrder"]) )
		{
			$galleryOrder = array_reverse($_POST["galleryOrder"]);
			
			foreach($galleryOrder as $order=>$galleryId)
			{
				$order = (int)$order;
				
				$galleryId = (int)$galleryId;
				
				$db->request("UPDATE entity_gallery SET eg_order=? WHERE eg_id=?", array($order, $galleryId));
			}
		}
	}
	
	function getGalleryMaxOrder()
	{
		global $db;
		
		$results = $db->data("SELECT MAX(eg_order) AS maxOrder FROM entity_gallery", array());
		if( count($results) > 0 )
		{
			return (int)$results[0]["maxOrder"] + 1;
		}
		else
		{
			return 1;
		}
	}
	
	function saveParent($entityId)
	{
		global $db;
		
		if( isset($_POST["parent"]) && is_string($_POST["parent"]) && ctype_digit($_POST["parent"]) )
		{
			if($_POST["parent"]==="0")
			{
				$db->request("UPDATE entities SET entity_parent=0 WHERE entity_id=?", array($entityId));
			}
			else
			{
				$parentEntity = getEntity($_POST["parent"]);
				if($parentEntity!==false && $parentEntity["entity_id"]!==$entityId)
				{
					$db->request("UPDATE entities SET entity_parent=? WHERE entity_id=?", array($parentEntity["entity_id"], $entityId));
				}
			}
		}
	}
	
	function getEntityMaxOrder()
	{
		global $db;
		
		$results = $db->data("SELECT MAX(entity_order) AS maxOrder FROM entities", array());
		if( count($results) > 0 )
		{
			return (int)$results[0]["maxOrder"] + 1;
		}
		else
		{
			return 1;
		}
	}
	
	function parseColumnPrefix($fieldName)
	{
		$chunks = explode("_", $fieldName);
		if( count($chunks) > 1 )
		{
			return $chunks[0];
		}
		else
		{
			exit("Unknown column name");
		}
	}
	
	function getTableName($fieldPrefix)
	{
		if($fieldPrefix==="es")
		{
			return "entity_seo";
		}
		elseif($fieldPrefix==="edl")
		{
			return "entity_data_lang";
		}
		elseif($fieldPrefix==="ed")
		{
			return "entity_data";
		}
		elseif($fieldPrefix==="eo")
		{
			return "entity_options";
		}
		else
		{
			exit("Unknown column prefix");
		}
	}
	
	function isMultiLang($tableName)
	{
		if($tableName==="entity_seo")
		{
			return true;
		}
		elseif($tableName==="entity_data_lang")
		{
			return true;
		}
		elseif($tableName==="entity_data")
		{
			return false;
		}
		elseif($tableName==="entity_options")
		{
			return false;
		}
		else
		{
			exit("Unknown column prefix");
		}
	}
	
	function saveHistory($entityId)
	{
		global $db;
		
		$db->request("UPDATE entities SET entity_update_date=UTC_TIMESTAMP(), entity_updater=? WHERE entity_id=?", array($_SESSION["user"], $entityId));
	}
	
	function saveTemplate($entityId)
	{
		global $db;
		
		if( isset($_POST["template"]) && is_string($_POST["template"]) )
		{
			$template = searchTemplate($_POST["template"]);
			if($template!==false)
			{
				$db->request("UPDATE entities SET entity_type=? WHERE entity_id=?", array($template["id"], $entityId));
				
				$entity = getEntity($entityId);
				if($entity!==false)
				{
					if($entity["entity_parent"]!==0)
					{
						$db->request("UPDATE entities SET entity_sub_type=? WHERE entity_id=?", array($template["id"], $entity["entity_parent"]));
					}
				}
				
				saveFields($entityId, $template["fields"]);
			}
			else
			{
				$db->request("UPDATE entities SET entity_type=NULL WHERE entity_id=?", array($entityId));
			}
		}
		else
		{
			$db->request("UPDATE entities SET entity_type=NULL WHERE entity_id=?", array($entityId));
		}
	}
	
	function getEntity($entityId)
	{
		global $db;
		
		$query = "SELECT * FROM entities
			LEFT JOIN entity_data ON ed_entity=entity_id
			LEFT JOIN entity_data_lang ON edl_entity=entity_id AND edl_lang=1
			LEFT JOIN users ON user_id=entity_creator
			WHERE entity_id=?";
		
		$results = $db->data($query, array($entityId));
		if( count($results) > 0 )
		{
			$ret = $results[0];
			
			$ret["entity_data_lang"] = $db->data("SELECT * FROM entity_data_lang WHERE edl_entity=?", array($entityId));
			$ret["entity_seo"] = $db->data("SELECT * FROM entity_seo WHERE es_entity=?", array($entityId));
			$ret["entity_options"] = $db->data("SELECT * FROM entity_options WHERE eo_entity=? ORDER BY eo_order DESC", array($entityId));
			$ret["entity_words"] = $db->data("SELECT * FROM entity_words WHERE ew_entity=?", array($entityId));
			
			return $ret;
		}
		else
		{
			return false;
		}
	}
	
	function searchLangValue($field, $language, $entity)
	{
		if($entity!==false)
		{
			$fieldName = $field["name"];
			
			foreach($entity as $key=>$value)
			{
				if( is_array($value) )
				{
					foreach($value as $row)
					{
						if( isset($row[$fieldName]) && findRowLang($row)===$language["language_id"] )
						{
							return $row[$fieldName];
						}
					}
				}
			}
		}
		
		return "";
	}
	
	function searchValue($field, $entity)
	{
		if($entity!==false)
		{
			$fieldName = $field["name"];
			
			if( isset($entity[$fieldName]) )
			{
				return $entity[$fieldName];
			}
		}
		
		return "";
	}
	
	function getOptionValues($field, $entity)
	{
		if($entity!==false)
		{
			$fieldName = $field["name"];
			
			$fieldPrefix = parseColumnPrefix($fieldName);
			
			$tableName = getTableName($fieldPrefix);
			
			$ret = array();
			
			foreach($entity[$tableName] as $row)
			{
				$rowKey = $fieldPrefix."_key";
				
				$rowValue = $fieldPrefix."_value";
				
				if( $row[$rowKey]===$fieldName )
				{
					$ret[] = $row[$rowValue];
				}
			}
			
			return $ret;
		}
		else
		{
			return array();
		}
	}
	
	function findRowLang($row)
	{
		foreach($row as $key=>$val)
		{
			if( substr($key, -5) === "_lang" )
			{
				return $val;
			}
		}
		
		return false;
	}
	
	function searchTemplate($templateId)
	{
		global $templates;
		
		foreach($templates as $template)
		{
			if($template["id"]===$templateId)
			{
				return $template;
			}
		}
		
		return false;
	}
	
	function countChildren($entityId, $isWidget)
	{
		global $db;
		
		$results = $db->data("SELECT COUNT(*) AS myCnt FROM entities WHERE entity_parent=? AND entity_is_widget=?", array($entityId, $isWidget));
		if( count($results) > 0 )
		{
			return $results[0]["myCnt"];
		}
		else
		{
			return false;
		}
	}
	
	function getFixedEntities($list)
	{
		global $db;
		
		$ret = array();
		
		if( count($list) > 0 )
		{
			$query = "SELECT * FROM entities
				LEFT JOIN entity_data ON ed_entity=entity_id
				LEFT JOIN entity_data_lang ON edl_entity=entity_id AND edl_lang=1
				WHERE entity_id IN (".implode(",", $list).") ORDER BY FIELD (entity_id, ".implode(",", $list).")";
			
			$results = $db->data($query, array());
			
			foreach($results as $result)
			{
				$ret[] = $result;
			}
		}
		
		return $ret;
	}
	
	function wipeEntity($entityId)
	{
		global $db, $languages;
		
		$entity = getEntity($entityId);
		if($entity!==false)
		{
			$template = searchTemplate($entity["entity_type"]);
			if($template!==false)
			{
				$gallery = getGallery($entity["entity_id"]);
				foreach($gallery as $photo)
				{
					delGalleryFile($entity["entity_id"], $photo["eg_id"]);
				}
				
				foreach($template["fields"] as $field)
				{
					if($field["type"]==="image" || $field["type"]==="file")
					{
						$fieldPrefix = parseColumnPrefix($field["name"]);
						
						$tableName = getTableName($fieldPrefix);
						
						if( isMultiLang($tableName) )
						{
							foreach($languages as $language)
							{
								delFileAtLang($field["name"], $entity["entity_id"], $language["language_id"]);
							}
						}
						else
						{
							delFileAt($field["name"], $entity["entity_id"]);
						}
					}
				}
				
				$db->request("DELETE FROM entities WHERE entity_id=?", array($entity["entity_id"]));
				$db->request("DELETE FROM entity_data WHERE ed_entity=?", array($entity["entity_id"]));
				$db->request("DELETE FROM entity_data_lang WHERE edl_entity=?", array($entity["entity_id"]));
				$db->request("DELETE FROM entity_options WHERE eo_entity=? OR eo_value=?", array($entity["entity_id"], $entity["entity_id"]));
				$db->request("DELETE FROM entity_seo WHERE es_entity=?", array($entity["entity_id"]));
				
				$children = $db->request("SELECT entity_id FROM entities WHERE entity_parent=?", array($entity["entity_id"]));
				foreach($children as $child)
				{
					wipeEntity($child["entity_id"]);
				}
			}
		}
	}
?>
