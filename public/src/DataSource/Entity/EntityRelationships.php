<?php
declare(strict_types=1);

namespace DataSource\Entity;

use Atlas\Mapper\MapperRelationships;
use DataSource\EntityDataLang\EntityDataLang;
use DataSource\EntityDatum\EntityDatum;
use DataSource\EntityGallery\EntityGallery;
use DataSource\EntityOption\EntityOption;
use DataSource\EntitySeo\EntitySeo;
use DataSource\EntityWord\EntityWord;

class EntityRelationships extends MapperRelationships
{
    protected function define()
    {
        $this->oneToOne('entity_data_lang', EntityDataLang::CLASS, [
            'entity_id' => 'edl_entity',
        ])->where('edl_lang = ', LANG);
        
        $this->oneToOne('entity_seo', EntitySeo::CLASS, [
            'entity_id' => 'es_entity',
        ])->where('es_lang = ', LANG);
        
        $this->oneToMany('entity_all_seo', EntitySeo::CLASS, [
            'entity_id' => 'es_entity',
        ]);
        
        $this->oneToOne('entity_data', EntityDatum::CLASS, [
            'entity_id' => 'ed_entity',
        ]);
        
        $this->oneToMany('entity_gallery', EntityGallery::CLASS, [
            'entity_id' => 'eg_entity',
        ]);
        
        $this->oneToMany('entity_options', EntityOption::CLASS, [
            'entity_id' => 'eo_entity',
        ]);
        
        $this->oneToMany('entity_words', EntityWord::CLASS, [
            'entity_id' => 'ew_entity',
        ])->where('ew_lang = ', LANG);
    }
}
