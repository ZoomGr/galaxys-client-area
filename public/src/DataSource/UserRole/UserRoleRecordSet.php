<?php
declare(strict_types=1);

namespace DataSource\UserRole;

use Atlas\Mapper\RecordSet;

/**
 * @method UserRoleRecord offsetGet($offset)
 * @method UserRoleRecord appendNew(array $fields = [])
 * @method UserRoleRecord|null getOneBy(array $whereEquals)
 * @method UserRoleRecordSet getAllBy(array $whereEquals)
 * @method UserRoleRecord|null detachOneBy(array $whereEquals)
 * @method UserRoleRecordSet detachAllBy(array $whereEquals)
 * @method UserRoleRecordSet detachAll()
 * @method UserRoleRecordSet detachDeleted()
 */
class UserRoleRecordSet extends RecordSet
{
}
