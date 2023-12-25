<?php
declare(strict_types=1);

namespace DataSource\EntityWord;

use Atlas\Mapper\RecordSet;

/**
 * @method EntityWordRecord offsetGet($offset)
 * @method EntityWordRecord appendNew(array $fields = [])
 * @method EntityWordRecord|null getOneBy(array $whereEquals)
 * @method EntityWordRecordSet getAllBy(array $whereEquals)
 * @method EntityWordRecord|null detachOneBy(array $whereEquals)
 * @method EntityWordRecordSet detachAllBy(array $whereEquals)
 * @method EntityWordRecordSet detachAll()
 * @method EntityWordRecordSet detachDeleted()
 */
class EntityWordRecordSet extends RecordSet
{
}
