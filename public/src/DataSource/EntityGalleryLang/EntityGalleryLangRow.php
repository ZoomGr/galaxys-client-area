<?php
/**
 * This file was generated by Atlas. Changes will be overwritten.
 */
declare(strict_types=1);

namespace DataSource\EntityGalleryLang;

use Atlas\Table\Row;

/**
 * @property mixed $egl_gallery int(10,0) unsigned NOT NULL
 * @property mixed $egl_language int(10,0) unsigned NOT NULL
 * @property mixed $egl_title char(255)
 */
class EntityGalleryLangRow extends Row
{
    protected $cols = [
        'egl_gallery' => null,
        'egl_language' => null,
        'egl_title' => null,
    ];
}
