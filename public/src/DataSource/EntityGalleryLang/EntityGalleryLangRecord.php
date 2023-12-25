<?php
declare(strict_types=1);

namespace DataSource\EntityGalleryLang;

use Atlas\Mapper\Record;

/**
 * @method EntityGalleryLangRow getRow()
 */
class EntityGalleryLangRecord extends Record
{
    use EntityGalleryLangFields;
}
