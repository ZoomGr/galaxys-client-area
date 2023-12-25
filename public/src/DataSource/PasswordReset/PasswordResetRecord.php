<?php
declare(strict_types=1);

namespace DataSource\PasswordReset;

use Atlas\Mapper\Record;

/**
 * @method PasswordResetRow getRow()
 */
class PasswordResetRecord extends Record
{
    use PasswordResetFields;
}
