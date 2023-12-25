<?php
declare(strict_types=1);

namespace DataSource\Language;

use Atlas\Mapper\RecordSet;

/**
 * @method LanguageRecord offsetGet($offset)
 * @method LanguageRecord appendNew(array $fields = [])
 * @method LanguageRecord|null getOneBy(array $whereEquals)
 * @method LanguageRecordSet getAllBy(array $whereEquals)
 * @method LanguageRecord|null detachOneBy(array $whereEquals)
 * @method LanguageRecordSet detachAllBy(array $whereEquals)
 * @method LanguageRecordSet detachAll()
 * @method LanguageRecordSet detachDeleted()
 */
class LanguageRecordSet extends RecordSet
{
}
