<?php
declare(strict_types=1);

namespace DataSource\PasswordReset;

use Atlas\Mapper\RecordSet;

/**
 * @method PasswordResetRecord offsetGet($offset)
 * @method PasswordResetRecord appendNew(array $fields = [])
 * @method PasswordResetRecord|null getOneBy(array $whereEquals)
 * @method PasswordResetRecordSet getAllBy(array $whereEquals)
 * @method PasswordResetRecord|null detachOneBy(array $whereEquals)
 * @method PasswordResetRecordSet detachAllBy(array $whereEquals)
 * @method PasswordResetRecordSet detachAll()
 * @method PasswordResetRecordSet detachDeleted()
 */
class PasswordResetRecordSet extends RecordSet
{
}
