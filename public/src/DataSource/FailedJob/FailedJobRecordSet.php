<?php
declare(strict_types=1);

namespace DataSource\FailedJob;

use Atlas\Mapper\RecordSet;

/**
 * @method FailedJobRecord offsetGet($offset)
 * @method FailedJobRecord appendNew(array $fields = [])
 * @method FailedJobRecord|null getOneBy(array $whereEquals)
 * @method FailedJobRecordSet getAllBy(array $whereEquals)
 * @method FailedJobRecord|null detachOneBy(array $whereEquals)
 * @method FailedJobRecordSet detachAllBy(array $whereEquals)
 * @method FailedJobRecordSet detachAll()
 * @method FailedJobRecordSet detachDeleted()
 */
class FailedJobRecordSet extends RecordSet
{
}
