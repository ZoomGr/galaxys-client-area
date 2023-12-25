<?php
declare(strict_types=1);

namespace DataSource\EntityOption;

use Atlas\Mapper\Mapper;
use Atlas\Table\Row;

/**
 * @method EntityOptionTable getTable()
 * @method EntityOptionRelationships getRelationships()
 * @method EntityOptionRecord|null fetchRecord($primaryVal, array $with = [])
 * @method EntityOptionRecord|null fetchRecordBy(array $whereEquals, array $with = [])
 * @method EntityOptionRecord[] fetchRecords(array $primaryVals, array $with = [])
 * @method EntityOptionRecord[] fetchRecordsBy(array $whereEquals, array $with = [])
 * @method EntityOptionRecordSet fetchRecordSet(array $primaryVals, array $with = [])
 * @method EntityOptionRecordSet fetchRecordSetBy(array $whereEquals, array $with = [])
 * @method EntityOptionSelect select(array $whereEquals = [])
 * @method EntityOptionRecord newRecord(array $fields = [])
 * @method EntityOptionRecord[] newRecords(array $fieldSets)
 * @method EntityOptionRecordSet newRecordSet(array $records = [])
 * @method EntityOptionRecord turnRowIntoRecord(Row $row, array $with = [])
 * @method EntityOptionRecord[] turnRowsIntoRecords(array $rows, array $with = [])
 */
class EntityOption extends Mapper
{
}
