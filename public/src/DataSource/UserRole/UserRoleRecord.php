<?php
declare(strict_types=1);

namespace DataSource\UserRole;

use Atlas\Mapper\Record;

/**
 * @method UserRoleRow getRow()
 */
class UserRoleRecord extends Record
{
    use UserRoleFields;
}
