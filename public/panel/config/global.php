<?php
	$seoFields = array(
		array("title"=>"Url", "type"=>"text", "name"=>"es_url", "isRichText"=>false),
		array("title"=>"Title", "type"=>"text", "name"=>"es_title", "isRichText"=>false),
		array("title"=>"Keywords", "type"=>"textarea", "name"=>"es_keywords", "isRichText"=>false),
		array("title"=>"Description", "type"=>"textarea", "name"=>"es_description", "isRichText"=>false),
	);

	$custormSortFields = array(

	);

	$disableAddButtonIn = array();

	$wordsMap = array(

	);

	$templateMap = array(
        0 => ['section', 'section_promo'],
        ID_NEWS => ['news'],
        ID_TAXONOMIES => ['section', 'compliance_section'],
        ID_TAGS => ['section'],
        ID_COUNTRIES => ['section'],
        ID_PROMOS => ['promos'],
        ID_NOTIFICATIONS => ['notification'],
        ID_CHATS => ['chat_user'],
        ID_GAMES => ['games'],
        ID_COMPILIANCE_LICENSES => ['compliance_license'],
        ID_SLIDER => ['slider'],
	);

	$templateChildren = array(
        'chat_user' => ['chat'],
        'chat' => ['chat_message'],
        'games' => ['game_country_licenses'],
	);

	$widgetWhiteList = [];

	$additionalColumnsInSections = array(
	);

	$additionalColumnsInWidgets = array();

	define("TITLE_FIELD", "edl_title");

	define("IMG_FIELD", "ed_image");

	define("PAGE_SIZE", 50);

	define("DISABLE_THUMBNAIL", true);
?>
