<?php
declare(strict_types=1);

namespace DataSource\EntitySeo;

use Atlas\Mapper\RecordSet;

/**
 * @method EntitySeoRecord offsetGet($offset)
 * @method EntitySeoRecord appendNew(array $fields = [])
 * @method EntitySeoRecord|null getOneBy(array $whereEquals)
 * @method EntitySeoRecordSet getAllBy(array $whereEquals)
 * @method EntitySeoRecord|null detachOneBy(array $whereEquals)
 * @method EntitySeoRecordSet detachAllBy(array $whereEquals)
 * @method EntitySeoRecordSet detachAll()
 * @method EntitySeoRecordSet detachDeleted()
 */
class EntitySeoRecordSet extends RecordSet
{
}
