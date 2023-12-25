<?php
declare(strict_types=1);

namespace DataSource\EntityGallery;

use Atlas\Mapper\Record;

/**
 * @method EntityGalleryRow getRow()
 */
class EntityGalleryRecord extends Record
{
    use EntityGalleryFields;
}
