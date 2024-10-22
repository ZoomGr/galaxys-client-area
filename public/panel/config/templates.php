<?php
//Available monolanguage types: text, color, url, email, number, datetime, date, time, image, file, textarea, select, multiselect, optgroup, multioptgroup, picker
//Available multilanguage types: text url email image file textarea
//select, multiselect, optgroup, multioptgroup and picker types have pid attribute
//textarea has isRichText boolean attribute
//Field names have to match with column names in DB and be with correct prefix
//All native html elements have optional required, value attributes
//Templates have hasGallery, hasSeo, isWidget boolean attributes and onAdd, onUpdate event attributes
?>
<?php
    require("helper.php");
    //-------------------------------Section templates here--------------------------------//

    $simpleSectionFields = [
        ["title"=>"Title", "type"=>"text", "name"=>"edl_title"],
        ["title"=>"Description", "type"=>"textarea", "name"=>"edl_text_1", "isRichText"=> true],
        ["title"=>"Image", "type"=>"image", "name"=>"ed_image"]
    ];

    $sliderSectionFields = [
        ["title"=>"Title", "type"=>"text", "name"=>"edl_title"],
        ["title"=>"Image", "type"=>"image", "name"=>"ed_image"],
        ["title"=>"Url", "type"=>"text", "name"=>"edl_char_1"],
    ];

    $sectionWithPromoBlockFields = [
        ["title"=>"Title", "type"=>"text", "name"=>"edl_title"],
        ["title"=>"Description", "type"=>"textarea", "name"=>"edl_text_1", "isRichText"=> true],
        ["title"=>"Image", "type"=>"image", "name"=>"ed_image"],
        ["title"=>'Show Promo', "type"=>"select", "name"=>"ed_number_1", "pid"=>function() {
            return [
                1 => 'Yes'
            ];
        }],
        ["title"=>"Promo Title", "type"=>"text", "name"=>"edl_char_1"],
        ["title"=>"Promo Description", "type"=>"textarea", "name"=>"edl_text_2", "isRichText"=> false],
        ["title"=>"Image", "type"=>"image", "name"=>"ed_char_1"],
        ["title"=>"Link", "type"=>"text", "name"=>"edl_char_2"],
        ["title"=>"Button text", "type"=>"text", "name"=>"edl_char_3"],
    ];

    $newsSectionFields = [
        ["title"=>"Title", "type"=>"text", "name"=>"edl_title"],
        ["title"=>'Favorite', "type"=>"select", "name"=>"ed_number_1", "pid"=>function() {
            return [
                1 => 'Yes'
            ];
        }],
        ["title"=>"Image", "type"=>"image", "name"=>"ed_image"],
        ["title"=>"Description", "type"=>"text", "name"=>"edl_char_1"],
        ["title"=>"Content", "type"=>"textarea", "name"=>"edl_text_1", "isRichText"=> true],
        ["title"=>"Date", "type"=>"datetime", "name"=>"ed_datetime_1"],
        ["title"=>"Event Image", "type"=>"image", "name"=>"ed_char_1"],
        ["title"=>"Event Name", "type"=>"text", "name"=>"edl_char_2"],
        ["title"=>"Event Link", "type"=>"text", "name"=>"edl_char_3"],
        ["title"=>"Tags", "type"=>"multiselect", "name"=>"eo_tags", "pid"=>function() {
            return getTagsList();
        }],
    ];

    $gameSectionFields = [
        ["title"=>"Title", "type"=>"text", "name"=>"edl_title"],
        ["title"=>"Parent Game", "type"=>"text", "name"=>"edl_text_2"],
        ["title"=>"Parent Game", "type"=>"select", "name"=>"ed_number_1", "pid"=> ID_GAME_PARENTS],
        ["title"=>"Image", "type"=>"image", "name"=>"ed_image"],
        ["title"=>"Description", "type"=>"text", "name"=>"edl_char_1"],
        ["title"=>"Content", "type"=>"textarea", "name"=>"edl_text_1", "isRichText"=> true],
        ["title"=>"Game type", "type"=>"text", "name"=>"edl_char_2"],
        ["title"=>"Game RTP", "type"=>"text", "name"=>"edl_char_3"],
        ["title"=>"Game ID", "type"=>"text", "name"=>"edl_char_4"],
        ["title"=>"Available Devices", "type"=>"multiselect", "name"=>"eo_available_devices", "pid"=>function() {
            return [
                1 => 'Desktop',
                2 => 'Tablet',
                3 => 'Mobile',
            ];
        }],
        ["title"=>"Game Release", "type"=>"date", "name"=>"ed_datetime_2"],
        ["title"=>"Files Release", "type"=>"date", "name"=>"ed_datetime_3"],
        ["title"=>"Video Preview", "type"=>"text", "name"=>"ed_char_1"],
    //        ["title"=>"License 1", "type"=>"file", "name"=>"ed_char_2"],
    //        ["title"=>"License 1", "type"=>"text", "name"=>"ed_char_3"],
    //        ["title"=>"License 2", "type"=>"file", "name"=>"ed_char_4"],
    //        ["title"=>"License 2", "type"=>"text", "name"=>"ed_char_5"],
    //        ["title"=>"License 3", "type"=>"file", "name"=>"ed_text_1"],
    //        ["title"=>"License 3", "type"=>"text", "name"=>"ed_text_2"],
    ];

    $gameCountryLicensesFields = [
        ["title"=>"Title", "type"=>"text", "name"=>"edl_title"],
        ["title"=>"Country", "type"=>"select", "name"=>"ed_number_1", "pid"=>function() {
            return getCountriesList();
        }],
        ["title"=>"License", "type"=>"file", "name"=>"ed_char_1"],
    ];

    $gameLicensesFields = [
        ["title"=>"Title", "type"=>"text", "name"=>"edl_title"],
        ["title"=>"License", "type"=>"file", "name"=>"ed_char_1"],
    ];

    $promoSectionFields = [
        ["title"=>"Title", "type"=>"text", "name"=>"edl_title"],
        ["title"=>"Image", "type"=>"image", "name"=>"ed_image"],
        ["title"=>"Description", "type"=>"text", "name"=>"edl_char_1"],
        ["title"=>"Content", "type"=>"textarea", "name"=>"edl_text_1", "isRichText"=> true],
        ["title"=>"Start hours", "type"=>"datetime", "name"=>"ed_datetime_1"],
        ["title"=>"End hours", "type"=>"date", "name"=>"ed_datetime_2"],
        ["title"=>"Tags", "type"=>"multiselect", "name"=>"eo_tags", "pid"=>function() {
            return getTagsList();
        }],
    ];

    $notificationsSectionFields = [
        ["title"=>"Title", "type"=>"text", "name"=>"edl_title"],
        ["title"=>"Content", "type"=>"textarea", "name"=>"edl_text_1", "isRichText"=> false],
        ["title"=>"Icon Type", "type"=>"select", "name"=>"ed_number_1", "pid"=>function() {
            return [
                1 => 'Info',
                2 => 'Warning',
            ];
        }],
    ];

    $chatUserFields = $chatFields = [
        ["title"=>"Title", "type"=>"text", "name"=>"ed_title"],
    ];

    $chatMessagesFields = [
        ["title"=>"Title", "type"=>"textarea", "name"=>"ed_text_1", "isRichText"=> false],
        ["title"=>"Seen", "type"=>"select", "name"=>"ed_number_1", "pid"=>function() {
            return [
                1 => 'Yes',
            ];
        }],
    ];

    $complianceSectionFields = [
        ["title"=>"Title", "type"=>"text", "name"=>"edl_title"],
        ["title"=>"Game Jurisdiction", "type"=>"file", "name"=>"ed_char_1"],
    ];

    $complianceLincesesFields = [
        ["title"=>"Title", "type"=>"text", "name"=>"edl_title"],
        ["title"=>"License", "type"=>"file", "name"=>"ed_char_1"],
    ];

?>
<?php
    $templates = array(
        //-------------------------------Section templates here--------------------------------//
        array("id"=>"section", "title"=>"Section", "fields"=>$simpleSectionFields, "hasGallery"=>false, "hasSeo"=>false, "isWidget"=>false),
        array("id"=>"section_promo", "title"=>"Section Promo", "fields"=>$sectionWithPromoBlockFields, "hasGallery"=>false, "hasSeo"=>false, "isWidget"=>false),
        array("id"=>"news", "title"=>"News", "fields"=>$newsSectionFields, "hasGallery"=>false, "hasSeo"=>true, "isWidget"=>false),
        array("id"=>"games", "title"=>"Game", "fields"=>$gameSectionFields, "hasGallery"=>false, "hasSeo"=>true, "isWidget"=>false),
        array("id"=>"game_country_licenses", "title"=>"Country License", "fields"=>$gameCountryLicensesFields, "hasGallery"=>false, "hasSeo"=>false, "isWidget"=>false),
        array("id"=>"game_licenses", "title"=>"Game License", "fields"=>$gameLicensesFields, "hasGallery"=>false, "hasSeo"=>false, "isWidget"=>false),
        array("id"=>"promos", "title"=>"Promo", "fields"=>$promoSectionFields, "hasGallery"=>false, "hasSeo"=>true, "isWidget"=>false),
        array("id"=>"compliance_section", "title"=>"Compliance", "fields"=>$complianceSectionFields, "hasGallery"=>false, "hasSeo"=>true, "isWidget"=>false),
        array("id"=>"compliance_license", "title"=>"Licenses", "fields"=>$complianceLincesesFields, "hasGallery"=>false, "hasSeo"=>false, "isWidget"=>false),
        array("id"=>"notification", "title"=>"Notifictaion", "fields"=>$notificationsSectionFields, "hasGallery"=>false, "hasSeo"=>false, "isWidget"=>false),
        array("id"=>"slider", "title"=>"Slider", "fields"=>$sliderSectionFields, "hasGallery"=>false, "hasSeo"=>false, "isWidget"=>false),
        array("id"=>"chat_user", "title"=>"User", "fields"=>$chatUserFields, "hasGallery"=>false, "hasSeo"=>false, "isWidget"=>false),
        array("id"=>"chat", "title"=>"Chat", "fields"=>$chatFields, "hasGallery"=>false, "hasSeo"=>false, "isWidget"=>false),
        array("id"=>"chat_message", "title"=>"Chat Message", "fields"=>$chatMessagesFields, "hasGallery"=>false, "hasSeo"=>false, "isWidget"=>false, "onAdd"=>function($id) {
            global $db;

            $pid = (string)filter_input(INPUT_GET, "pid", FILTER_VALIDATE_INT);
            $db->request("UPDATE entity_data SET ed_text_1=? WHERE ed_entity = ?", array($_POST['ed_text_1'], $pid));
            $db->request("UPDATE entities SET entity_update_date=? WHERE entity_id = ?", array(date("Y-m-d H:i:s"), $pid));

            return true;
        }),
    );
?>
