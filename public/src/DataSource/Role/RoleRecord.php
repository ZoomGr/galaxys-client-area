<?php
declare(strict_types=1);

namespace DataSource\Role;

use Atlas\Mapper\Record;

/**
 * @method RoleRow getRow()
 */
class RoleRecord extends Record
{
    use RoleFields;
}
