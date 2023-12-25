<?php
declare(strict_types=1);

namespace DataSource\Role;

use Atlas\Mapper\Mapper;
use Atlas\Table\Row;

/**
 * @method RoleTable getTable()
 * @method RoleRelationships getRelationships()
 * @method RoleRecord|null fetchRecord($primaryVal, array $with = [])
 * @method RoleRecord|null fetchRecordBy(array $whereEquals, array $with = [])
 * @method RoleRecord[] fetchRecords(array $primaryVals, array $with = [])
 * @method RoleRecord[] fetchRecordsBy(array $whereEquals, array $with = [])
 * @method RoleRecordSet fetchRecordSet(array $primaryVals, array $with = [])
 * @method RoleRecordSet fetchRecordSetBy(array $whereEquals, array $with = [])
 * @method RoleSelect select(array $whereEquals = [])
 * @method RoleRecord newRecord(array $fields = [])
 * @method RoleRecord[] newRecords(array $fieldSets)
 * @method RoleRecordSet newRecordSet(array $records = [])
 * @method RoleRecord turnRowIntoRecord(Row $row, array $with = [])
 * @method RoleRecord[] turnRowsIntoRecords(array $rows, array $with = [])
 */
class Role extends Mapper
{
}
