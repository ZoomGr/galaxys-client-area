<?php

function getTagsList()
{
    $tags_list = getChildren(ID_TAGS);
    $all_tags = [];
    foreach ($tags_list as $tag) {
        $all_tags[$tag['entity_id']] = $tag['edl_title'];
    }

    return $all_tags;
}

function getCountriesList()
{
    $countries_list = getChildren(ID_COUNTRIES);
    $all_countries = [];
    foreach ($countries_list as $country) {
        $all_countries[$country['entity_id']] = $country['edl_title'];
    }

    return $all_countries;
}
function getBlogCategoryarticles($pid)
{
    global $db;

    $blogCategoryArticles = [];

    $blogCategoryArticlesList = getChildren($pid);

    foreach ($blogCategoryArticlesList as $article) {
        $blogCategoryArticles[$article['entity_id']] = getTitleField($article);
    }

    return $blogCategoryArticles;
}

function getChildren($pid)
{
    global $db;

    $query = "SELECT * FROM entities
			LEFT JOIN entity_data ON ed_entity=entity_id
			LEFT JOIN entity_data_lang ON edl_entity=entity_id AND edl_lang=1
			WHERE entity_parent=? ORDER BY entity_order DESC";

    return $db->data($query, array($pid));
}

function getEntityById($entity_id) {
    global $db;

    $query = "SELECT * FROM entities
                LEFT JOIN entity_data ON ed_entity=entity_id
                LEFT JOIN entity_data_lang ON edl_entity=entity_id AND edl_lang=1
                WHERE entity_id=? and entity_visible=1 ORDER BY entity_order DESC";

    return $db->data($query, array($entity_id));
}

function getTitleField($row)
{
    if (trim($row[TITLE_FIELD]) !== "") {
        return trim($row[TITLE_FIELD]);
    } else {
        return "ID: " . $row["entity_id"];
    }
}
