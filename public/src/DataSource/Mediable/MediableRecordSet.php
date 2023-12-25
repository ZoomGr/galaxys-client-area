<?php
declare(strict_types=1);

namespace DataSource\Mediable;

use Atlas\Mapper\RecordSet;

/**
 * @method MediableRecord offsetGet($offset)
 * @method MediableRecord appendNew(array $fields = [])
 * @method MediableRecord|null getOneBy(array $whereEquals)
 * @method MediableRecordSet getAllBy(array $whereEquals)
 * @method MediableRecord|null detachOneBy(array $whereEquals)
 * @method MediableRecordSet detachAllBy(array $whereEquals)
 * @method MediableRecordSet detachAll()
 * @method MediableRecordSet detachDeleted()
 */
class MediableRecordSet extends RecordSet
{
}
