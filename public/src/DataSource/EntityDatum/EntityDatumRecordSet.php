<?php
declare(strict_types=1);

namespace DataSource\EntityDatum;

use Atlas\Mapper\RecordSet;

/**
 * @method EntityDatumRecord offsetGet($offset)
 * @method EntityDatumRecord appendNew(array $fields = [])
 * @method EntityDatumRecord|null getOneBy(array $whereEquals)
 * @method EntityDatumRecordSet getAllBy(array $whereEquals)
 * @method EntityDatumRecord|null detachOneBy(array $whereEquals)
 * @method EntityDatumRecordSet detachAllBy(array $whereEquals)
 * @method EntityDatumRecordSet detachAll()
 * @method EntityDatumRecordSet detachDeleted()
 */
class EntityDatumRecordSet extends RecordSet
{
}
