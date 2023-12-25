<?php
declare(strict_types=1);

namespace DataSource\EntityGallery;

use Atlas\Mapper\RecordSet;

/**
 * @method EntityGalleryRecord offsetGet($offset)
 * @method EntityGalleryRecord appendNew(array $fields = [])
 * @method EntityGalleryRecord|null getOneBy(array $whereEquals)
 * @method EntityGalleryRecordSet getAllBy(array $whereEquals)
 * @method EntityGalleryRecord|null detachOneBy(array $whereEquals)
 * @method EntityGalleryRecordSet detachAllBy(array $whereEquals)
 * @method EntityGalleryRecordSet detachAll()
 * @method EntityGalleryRecordSet detachDeleted()
 */
class EntityGalleryRecordSet extends RecordSet
{
}
