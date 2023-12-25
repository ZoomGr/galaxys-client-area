<?php
declare(strict_types=1);

namespace DataSource\PasswordResetToken;

use Atlas\Mapper\Record;

/**
 * @method PasswordResetTokenRow getRow()
 */
class PasswordResetTokenRecord extends Record
{
    use PasswordResetTokenFields;
}
