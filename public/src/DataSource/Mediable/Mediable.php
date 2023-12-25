<?php
declare(strict_types=1);

namespace DataSource\Mediable;

use Atlas\Mapper\Mapper;
use Atlas\Table\Row;

/**
 * @method MediableTable getTable()
 * @method MediableRelationships getRelationships()
 * @method MediableRecord|null fetchRecord($primaryVal, array $with = [])
 * @method MediableRecord|null fetchRecordBy(array $whereEquals, array $with = [])
 * @method MediableRecord[] fetchRecords(array $primaryVals, array $with = [])
 * @method MediableRecord[] fetchRecordsBy(array $whereEquals, array $with = [])
 * @method MediableRecordSet fetchRecordSet(array $primaryVals, array $with = [])
 * @method MediableRecordSet fetchRecordSetBy(array $whereEquals, array $with = [])
 * @method MediableSelect select(array $whereEquals = [])
 * @method MediableRecord newRecord(array $fields = [])
 * @method MediableRecord[] newRecords(array $fieldSets)
 * @method MediableRecordSet newRecordSet(array $records = [])
 * @method MediableRecord turnRowIntoRecord(Row $row, array $with = [])
 * @method MediableRecord[] turnRowsIntoRecords(array $rows, array $with = [])
 */
class Mediable extends Mapper
{
}
