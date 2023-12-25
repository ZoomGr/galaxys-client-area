<?php
declare(strict_types=1);

namespace DataSource\PasswordReset;

use Atlas\Mapper\Mapper;
use Atlas\Table\Row;

/**
 * @method PasswordResetTable getTable()
 * @method PasswordResetRelationships getRelationships()
 * @method PasswordResetRecord|null fetchRecord($primaryVal, array $with = [])
 * @method PasswordResetRecord|null fetchRecordBy(array $whereEquals, array $with = [])
 * @method PasswordResetRecord[] fetchRecords(array $primaryVals, array $with = [])
 * @method PasswordResetRecord[] fetchRecordsBy(array $whereEquals, array $with = [])
 * @method PasswordResetRecordSet fetchRecordSet(array $primaryVals, array $with = [])
 * @method PasswordResetRecordSet fetchRecordSetBy(array $whereEquals, array $with = [])
 * @method PasswordResetSelect select(array $whereEquals = [])
 * @method PasswordResetRecord newRecord(array $fields = [])
 * @method PasswordResetRecord[] newRecords(array $fieldSets)
 * @method PasswordResetRecordSet newRecordSet(array $records = [])
 * @method PasswordResetRecord turnRowIntoRecord(Row $row, array $with = [])
 * @method PasswordResetRecord[] turnRowsIntoRecords(array $rows, array $with = [])
 */
class PasswordReset extends Mapper
{
}
