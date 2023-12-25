<?php
	function saveFields($entityId, $fields)
	{
		global $languages, $db, $wordsMap;
		
		if( isset($wordsMap[$entityId]) )
		{
			foreach($wordsMap[$entityId] as $wordIndex=>$wordLabel)
			{
				foreach($languages as $ind=>$language)
				{
					$fieldName = "words_".$wordIndex;
					
					if( isset($_POST[$fieldName][$ind]) && is_string($_POST[$fieldName][$ind]) )
					{
						$query = "INSERT INTO entity_words (ew_entity, ew_index, ew_lang, ew_value)
							VALUES (?, ?, ?, ?)
							ON DUPLICATE KEY UPDATE ew_value = ?";
						
						$db->request($query, array($entityId, $wordIndex, $language["language_id"], $_POST[$fieldName][$ind], $_POST[$fieldName][$ind]));
					}
				}
			}
		}
		
		foreach($fields as $field)
		{
			$fieldName = $field["name"];
			
			$fieldPrefix = parseColumnPrefix($fieldName);
			
			$tableName = getTableName($fieldPrefix);
			
			$multilang = isMultiLang($tableName);
			
			if($field["type"]==="image" || $field["type"]==="file")
			{
				if($multilang===true)
				{
					if( isset($_FILES[$fieldName]) && is_array($_FILES[$fieldName]["error"]) )
					{
						foreach($languages as $ind=>$language)
						{
							if( isset($_FILES[$fieldName]["error"][$ind]) && $_FILES[$fieldName]["error"][$ind]==UPLOAD_ERR_OK )
							{
								$mediaPath = false;
								
								if($field["type"]==="file")
								{
									if( isValidFile($_FILES[$fieldName]["name"][$ind]) )
									{
										$mediaPath = uploadFile($_FILES[$fieldName]["tmp_name"][$ind], pathinfo($_FILES[$fieldName]["name"][$ind], PATHINFO_EXTENSION));
									}
								}
								else
								{
									if(isValidImage($_FILES[$fieldName]["name"][$ind]))
									{
										$mediaPath = uploadImage($_FILES[$fieldName]["tmp_name"][$ind], pathinfo($_FILES[$fieldName]["name"][$ind], PATHINFO_EXTENSION));
									}
								}
								
								if($mediaPath!==false)
								{
									delFileAtLang($fieldName, $entityId, $language["language_id"]);
									
									$query = "INSERT INTO ".$tableName." (".$fieldPrefix."_entity, ".$fieldPrefix."_lang, ".$fieldName.")
										VALUES (?, ?, ?)
										ON DUPLICATE KEY UPDATE ".$fieldName." = ?";
										
									$db->request($query, array($entityId, $language["language_id"], $mediaPath, $mediaPath));
								}
							}
						}
					}
				}
				else
				{
					if( isset($_FILES[$fieldName]) && !is_array($_FILES[$fieldName]["error"]) && $_FILES[$fieldName]["error"]==UPLOAD_ERR_OK )
					{
						$mediaPath = false;
						
						if($field["type"]==="file")
						{
							if( isValidFile($_FILES[$fieldName]["name"]) )
							{
								$mediaPath = uploadFile($_FILES[$fieldName]["tmp_name"], pathinfo($_FILES[$fieldName]["name"], PATHINFO_EXTENSION));
							}
						}
						else
						{
							if( isValidImage($_FILES[$fieldName]["name"]) )
							{
								$mediaPath = uploadImage($_FILES[$fieldName]["tmp_name"], pathinfo($_FILES[$fieldName]["name"], PATHINFO_EXTENSION));
							}
						}
						
						if($mediaPath!==false)
						{
							delFileAt($fieldName, $entityId);
							
							$query = "INSERT INTO ".$tableName." (".$fieldPrefix."_entity, ".$fieldName.")
								VALUES (?, ?)
								ON DUPLICATE KEY UPDATE ".$fieldName." = ?";
								
							$db->request($query, array($entityId, $mediaPath, $mediaPath));
						}
					}
				}
			}
			else
			{
				if($multilang===true)
				{
					if( isset($_POST[$fieldName]) && is_array($_POST[$fieldName]) )
					{
						foreach($languages as $ind=>$language)
						{
							if( isset($_POST[$fieldName][$ind]) && is_string($_POST[$fieldName][$ind]) )
							{
								if( trim($_POST[$fieldName][$ind])==="" )
								{
									$query = "INSERT INTO ".$tableName." (".$fieldPrefix."_entity, ".$fieldPrefix."_lang, ".$fieldName.")
										VALUES (?, ?, NULL)
										ON DUPLICATE KEY UPDATE ".$fieldName." = NULL";
									
									$db->request($query, array($entityId, $language["language_id"]));
								}
								else
								{
									$query = "INSERT INTO ".$tableName." (".$fieldPrefix."_entity, ".$fieldPrefix."_lang, ".$fieldName.")
										VALUES (?, ?, ?)
										ON DUPLICATE KEY UPDATE ".$fieldName." = ?";
									
									$db->request($query, array($entityId, $language["language_id"], $_POST[$fieldName][$ind], $_POST[$fieldName][$ind]));
								}
							}
						}
					}
				}
				else
				{
					if($field["type"]==="picker" || $field["type"]==="multiselect" || $field["type"]==="multioptgroup")
					{
						$mode = "array";
					}
					else
					{
						$mode = "string";
					}
					
					if($mode==="array")
					{
						$db->request("DELETE FROM ".$tableName." WHERE ".$fieldPrefix."_entity=? AND ".$fieldPrefix."_key=?", array($entityId, $fieldName));
						
						if( isset($_POST[$fieldName]) && is_array($_POST[$fieldName]) )
						{
							$reversedArr = array_reverse($_POST[$fieldName]);
							
							foreach($reversedArr as $key=>$fieldValue)
							{
								if( is_string($fieldValue) )
								{
									$db->request("INSERT INTO ".$tableName." (".$fieldPrefix."_entity, ".$fieldPrefix."_key, ".$fieldPrefix."_value, ".$fieldPrefix."_order) VALUES (?, ?, ?, ?)", array($entityId, $fieldName, $fieldValue, $key));
								}
							}
						}
					}
					elseif($mode==="string")
					{
						if( isset($_POST[$fieldName]) && is_string($_POST[$fieldName]) )
						{
							if( trim($_POST[$fieldName])==="" )
							{
								$query = "INSERT INTO ".$tableName." (".$fieldPrefix."_entity, ".$fieldName.")
									VALUES (?, NULL)
									ON DUPLICATE KEY UPDATE ".$fieldName." = NULL";
									
								$db->request($query, array($entityId));
							}
							else
							{
								$query = "INSERT INTO ".$tableName." (".$fieldPrefix."_entity, ".$fieldName.")
									VALUES (?, ?)
									ON DUPLICATE KEY UPDATE ".$fieldName." = ?";
									
								$db->request($query, array($entityId, trim($_POST[$fieldName]), trim($_POST[$fieldName])));
							}
						}
					}
				}
			}
		}
	}
?>
