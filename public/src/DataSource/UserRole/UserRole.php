<?php
declare(strict_types=1);

namespace DataSource\UserRole;

use Atlas\Mapper\Mapper;
use Atlas\Table\Row;

/**
 * @method UserRoleTable getTable()
 * @method UserRoleRelationships getRelationships()
 * @method UserRoleRecord|null fetchRecord($primaryVal, array $with = [])
 * @method UserRoleRecord|null fetchRecordBy(array $whereEquals, array $with = [])
 * @method UserRoleRecord[] fetchRecords(array $primaryVals, array $with = [])
 * @method UserRoleRecord[] fetchRecordsBy(array $whereEquals, array $with = [])
 * @method UserRoleRecordSet fetchRecordSet(array $primaryVals, array $with = [])
 * @method UserRoleRecordSet fetchRecordSetBy(array $whereEquals, array $with = [])
 * @method UserRoleSelect select(array $whereEquals = [])
 * @method UserRoleRecord newRecord(array $fields = [])
 * @method UserRoleRecord[] newRecords(array $fieldSets)
 * @method UserRoleRecordSet newRecordSet(array $records = [])
 * @method UserRoleRecord turnRowIntoRecord(Row $row, array $with = [])
 * @method UserRoleRecord[] turnRowsIntoRecords(array $rows, array $with = [])
 */
class UserRole extends Mapper
{
}
