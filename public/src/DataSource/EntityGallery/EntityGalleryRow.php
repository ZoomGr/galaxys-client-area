<?php
/**
 * This file was generated by Atlas. Changes will be overwritten.
 */
declare(strict_types=1);

namespace DataSource\EntityGallery;

use Atlas\Table\Row;

/**
 * @property mixed $eg_id int(10,0) unsigned NOT NULL
 * @property mixed $eg_entity int(10,0) unsigned NOT NULL
 * @property mixed $eg_path char(255) NOT NULL
 * @property mixed $eg_order int(10,0) unsigned NOT NULL
 */
class EntityGalleryRow extends Row
{
    protected $cols = [
        'eg_id' => null,
        'eg_entity' => null,
        'eg_path' => null,
        'eg_order' => null,
    ];
}