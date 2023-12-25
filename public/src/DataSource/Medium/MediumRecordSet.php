<?php
declare(strict_types=1);

namespace DataSource\Medium;

use Atlas\Mapper\RecordSet;

/**
 * @method MediumRecord offsetGet($offset)
 * @method MediumRecord appendNew(array $fields = [])
 * @method MediumRecord|null getOneBy(array $whereEquals)
 * @method MediumRecordSet getAllBy(array $whereEquals)
 * @method MediumRecord|null detachOneBy(array $whereEquals)
 * @method MediumRecordSet detachAllBy(array $whereEquals)
 * @method MediumRecordSet detachAll()
 * @method MediumRecordSet detachDeleted()
 */
class MediumRecordSet extends RecordSet
{
}
