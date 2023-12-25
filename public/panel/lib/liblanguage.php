<?php
	function getLanguages()
	{
		global $db;

		$ret = array();

		$results = $db->data("SELECT * FROM languages ORDER BY language_id ASC", array());
		foreach($results as $result)
		{
			$ret[] = $result;
		}

		return $ret;
	}

	function isValidLanguageId($languageId)
	{
		global $languages;

		$languageId = (int)$languageId;

		foreach($languages as $language)
		{
			if($language["language_id"]===$languageId)
			{
				return true;
			}
		}

		return false;
	}
?>
