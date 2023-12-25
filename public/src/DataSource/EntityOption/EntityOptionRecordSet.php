<?php
declare(strict_types=1);

namespace DataSource\EntityOption;

use Atlas\Mapper\RecordSet;

/**
 * @method EntityOptionRecord offsetGet($offset)
 * @method EntityOptionRecord appendNew(array $fields = [])
 * @method EntityOptionRecord|null getOneBy(array $whereEquals)
 * @method EntityOptionRecordSet getAllBy(array $whereEquals)
 * @method EntityOptionRecord|null detachOneBy(array $whereEquals)
 * @method EntityOptionRecordSet detachAllBy(array $whereEquals)
 * @method EntityOptionRecordSet detachAll()
 * @method EntityOptionRecordSet detachDeleted()
 */
class EntityOptionRecordSet extends RecordSet
{
}
