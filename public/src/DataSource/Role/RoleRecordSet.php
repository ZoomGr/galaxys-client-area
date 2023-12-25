<?php
declare(strict_types=1);

namespace DataSource\Role;

use Atlas\Mapper\RecordSet;

/**
 * @method RoleRecord offsetGet($offset)
 * @method RoleRecord appendNew(array $fields = [])
 * @method RoleRecord|null getOneBy(array $whereEquals)
 * @method RoleRecordSet getAllBy(array $whereEquals)
 * @method RoleRecord|null detachOneBy(array $whereEquals)
 * @method RoleRecordSet detachAllBy(array $whereEquals)
 * @method RoleRecordSet detachAll()
 * @method RoleRecordSet detachDeleted()
 */
class RoleRecordSet extends RecordSet
{
}
