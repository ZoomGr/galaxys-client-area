<?php
declare(strict_types=1);

namespace DataSource\EntityDataLang;

use Atlas\Mapper\RecordSet;

/**
 * @method EntityDataLangRecord offsetGet($offset)
 * @method EntityDataLangRecord appendNew(array $fields = [])
 * @method EntityDataLangRecord|null getOneBy(array $whereEquals)
 * @method EntityDataLangRecordSet getAllBy(array $whereEquals)
 * @method EntityDataLangRecord|null detachOneBy(array $whereEquals)
 * @method EntityDataLangRecordSet detachAllBy(array $whereEquals)
 * @method EntityDataLangRecordSet detachAll()
 * @method EntityDataLangRecordSet detachDeleted()
 */
class EntityDataLangRecordSet extends RecordSet
{
}
