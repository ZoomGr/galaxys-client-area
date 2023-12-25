<?php
declare(strict_types=1);

namespace DataSource\Entity;

use Atlas\Mapper\RecordSet;

/**
 * @method EntityRecord offsetGet($offset)
 * @method EntityRecord appendNew(array $fields = [])
 * @method EntityRecord|null getOneBy(array $whereEquals)
 * @method EntityRecordSet getAllBy(array $whereEquals)
 * @method EntityRecord|null detachOneBy(array $whereEquals)
 * @method EntityRecordSet detachAllBy(array $whereEquals)
 * @method EntityRecordSet detachAll()
 * @method EntityRecordSet detachDeleted()
 */
class EntityRecordSet extends RecordSet
{
}
