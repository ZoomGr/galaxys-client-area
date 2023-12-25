<?php
declare(strict_types=1);

namespace DataSource\PasswordResetToken;

use Atlas\Mapper\Mapper;
use Atlas\Table\Row;

/**
 * @method PasswordResetTokenTable getTable()
 * @method PasswordResetTokenRelationships getRelationships()
 * @method PasswordResetTokenRecord|null fetchRecord($primaryVal, array $with = [])
 * @method PasswordResetTokenRecord|null fetchRecordBy(array $whereEquals, array $with = [])
 * @method PasswordResetTokenRecord[] fetchRecords(array $primaryVals, array $with = [])
 * @method PasswordResetTokenRecord[] fetchRecordsBy(array $whereEquals, array $with = [])
 * @method PasswordResetTokenRecordSet fetchRecordSet(array $primaryVals, array $with = [])
 * @method PasswordResetTokenRecordSet fetchRecordSetBy(array $whereEquals, array $with = [])
 * @method PasswordResetTokenSelect select(array $whereEquals = [])
 * @method PasswordResetTokenRecord newRecord(array $fields = [])
 * @method PasswordResetTokenRecord[] newRecords(array $fieldSets)
 * @method PasswordResetTokenRecordSet newRecordSet(array $records = [])
 * @method PasswordResetTokenRecord turnRowIntoRecord(Row $row, array $with = [])
 * @method PasswordResetTokenRecord[] turnRowsIntoRecords(array $rows, array $with = [])
 */
class PasswordResetToken extends Mapper
{
}
