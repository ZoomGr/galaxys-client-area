<?php
declare(strict_types=1);

namespace DataSource\PasswordResetToken;

use Atlas\Mapper\RecordSet;

/**
 * @method PasswordResetTokenRecord offsetGet($offset)
 * @method PasswordResetTokenRecord appendNew(array $fields = [])
 * @method PasswordResetTokenRecord|null getOneBy(array $whereEquals)
 * @method PasswordResetTokenRecordSet getAllBy(array $whereEquals)
 * @method PasswordResetTokenRecord|null detachOneBy(array $whereEquals)
 * @method PasswordResetTokenRecordSet detachAllBy(array $whereEquals)
 * @method PasswordResetTokenRecordSet detachAll()
 * @method PasswordResetTokenRecordSet detachDeleted()
 */
class PasswordResetTokenRecordSet extends RecordSet
{
}
