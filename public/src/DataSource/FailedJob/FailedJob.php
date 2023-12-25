<?php
declare(strict_types=1);

namespace DataSource\FailedJob;

use Atlas\Mapper\Mapper;
use Atlas\Table\Row;

/**
 * @method FailedJobTable getTable()
 * @method FailedJobRelationships getRelationships()
 * @method FailedJobRecord|null fetchRecord($primaryVal, array $with = [])
 * @method FailedJobRecord|null fetchRecordBy(array $whereEquals, array $with = [])
 * @method FailedJobRecord[] fetchRecords(array $primaryVals, array $with = [])
 * @method FailedJobRecord[] fetchRecordsBy(array $whereEquals, array $with = [])
 * @method FailedJobRecordSet fetchRecordSet(array $primaryVals, array $with = [])
 * @method FailedJobRecordSet fetchRecordSetBy(array $whereEquals, array $with = [])
 * @method FailedJobSelect select(array $whereEquals = [])
 * @method FailedJobRecord newRecord(array $fields = [])
 * @method FailedJobRecord[] newRecords(array $fieldSets)
 * @method FailedJobRecordSet newRecordSet(array $records = [])
 * @method FailedJobRecord turnRowIntoRecord(Row $row, array $with = [])
 * @method FailedJobRecord[] turnRowsIntoRecords(array $rows, array $with = [])
 */
class FailedJob extends Mapper
{
}
