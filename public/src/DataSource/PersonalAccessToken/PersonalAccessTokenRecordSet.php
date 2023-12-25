<?php
declare(strict_types=1);

namespace DataSource\PersonalAccessToken;

use Atlas\Mapper\RecordSet;

/**
 * @method PersonalAccessTokenRecord offsetGet($offset)
 * @method PersonalAccessTokenRecord appendNew(array $fields = [])
 * @method PersonalAccessTokenRecord|null getOneBy(array $whereEquals)
 * @method PersonalAccessTokenRecordSet getAllBy(array $whereEquals)
 * @method PersonalAccessTokenRecord|null detachOneBy(array $whereEquals)
 * @method PersonalAccessTokenRecordSet detachAllBy(array $whereEquals)
 * @method PersonalAccessTokenRecordSet detachAll()
 * @method PersonalAccessTokenRecordSet detachDeleted()
 */
class PersonalAccessTokenRecordSet extends RecordSet
{
}
