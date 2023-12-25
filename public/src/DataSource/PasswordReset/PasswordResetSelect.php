<?php
declare(strict_types=1);

namespace DataSource\PasswordReset;

use Atlas\Mapper\MapperSelect;

/**
 * @method PasswordResetRecord|null fetchRecord()
 * @method PasswordResetRecord[] fetchRecords()
 * @method PasswordResetRecordSet fetchRecordSet()
 */
class PasswordResetSelect extends MapperSelect
{
}
