<?php
	function getSingleLevelOptions($pid)
	{
		global $db;
		
		$ret = array();
		
		$query = "SELECT * FROM entities
			LEFT JOIN entity_data ON ed_entity=entity_id
			LEFT JOIN entity_data_lang ON edl_entity=entity_id AND edl_lang=1
			WHERE entity_parent=? ORDER BY entity_creation_date DESC";
		
		$results = $db->data($query, array($pid));
		
		foreach($results as $result)
		{
			$key = $result["entity_id"];
			
			if( trim($result[TITLE_FIELD])!=="" )
			{
				$value = trim($result[TITLE_FIELD]);
			}
			else
			{
				$value = "ID: ".$result["entity_id"];
			}
			
			$ret[$key] = $value;
		}
		
		return $ret;
	}
	
	function getMultiLevelOptions($pid)
	{
		global $db;
		
		$ret = array();
		
		$query = "SELECT * FROM entities
			LEFT JOIN entity_data ON ed_entity=entity_id
			LEFT JOIN entity_data_lang ON edl_entity=entity_id AND edl_lang=1
			WHERE entity_parent=? ORDER BY entity_creation_date DESC";
		
		$results = $db->data($query, array($pid));
		
		foreach($results as $result)
		{
			$innerQuery = "SELECT * FROM entities
				LEFT JOIN entity_data ON ed_entity=entity_id
				LEFT JOIN entity_data_lang ON edl_entity=entity_id AND edl_lang=1
				WHERE entity_parent=? ORDER BY entity_creation_date DESC";
				
			$innerResults = $db->data($innerQuery, array($result["entity_id"]));
			if( count($innerResults) > 0 )
			{
				$newRow = array();
				
				if( trim($result[TITLE_FIELD])!=="" )
				{
					$newRow["title"] = trim($result[TITLE_FIELD]);
				}
				else
				{
					$newRow["title"] = "ID: ".$result["entity_id"];
				}
				
				$newRow["options"] = array();
				
				foreach($innerResults as $innerResult)
				{
					$key = $innerResult["entity_id"];
					
					if( trim($innerResult[TITLE_FIELD])!=="" )
					{
						$value = trim($innerResult[TITLE_FIELD]);
					}
					else
					{
						$value = "ID: ".$innerResult["entity_id"];
					}
					
					$newRow["options"][$key] = $value;
				}
				
				$ret[] = $newRow;
			}
		}
		
		return $ret;
	}
	
	function countMultiLevelOptions($options)
	{
		$counter = count($options);
		
		foreach($options as $suboptions)
		{
			$counter += count($suboptions["options"]);
		}
		
		return $counter;
	}
	
	function execOptionSource($fnc, $entity)
	{
		if($entity!==false)
		{
			return $fnc($entity["entity_parent"], $entity["entity_type"]);
		}
		else
		{
			global $pid, $selectedTemplateId;
			if($pid && $selectedTemplateId)
			{
				return $fnc($pid, $selectedTemplateId);
			}
		}
		
		return [];
	}
?>
