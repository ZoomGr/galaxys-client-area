<?php
declare(strict_types=1);

namespace DataSource\EntityGallery;

use Atlas\Mapper\MapperRelationships;
use DataSource\EntityGalleryLang\EntityGalleryLang;

class EntityGalleryRelationships extends MapperRelationships
{
    protected function define()
    {
        $this->oneToOne('entity_gallery_lang', EntityGalleryLang::CLASS, [
            'eg_id' => 'egl_gallery',
        ])->where('egl_language = ', LANG);
    }
}
