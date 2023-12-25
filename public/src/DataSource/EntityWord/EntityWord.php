<?php
declare(strict_types=1);

namespace DataSource\EntityWord;

use Atlas\Mapper\Mapper;
use Atlas\Table\Row;

/**
 * @method EntityWordTable getTable()
 * @method EntityWordRelationships getRelationships()
 * @method EntityWordRecord|null fetchRecord($primaryVal, array $with = [])
 * @method EntityWordRecord|null fetchRecordBy(array $whereEquals, array $with = [])
 * @method EntityWordRecord[] fetchRecords(array $primaryVals, array $with = [])
 * @method EntityWordRecord[] fetchRecordsBy(array $whereEquals, array $with = [])
 * @method EntityWordRecordSet fetchRecordSet(array $primaryVals, array $with = [])
 * @method EntityWordRecordSet fetchRecordSetBy(array $whereEquals, array $with = [])
 * @method EntityWordSelect select(array $whereEquals = [])
 * @method EntityWordRecord newRecord(array $fields = [])
 * @method EntityWordRecord[] newRecords(array $fieldSets)
 * @method EntityWordRecordSet newRecordSet(array $records = [])
 * @method EntityWordRecord turnRowIntoRecord(Row $row, array $with = [])
 * @method EntityWordRecord[] turnRowsIntoRecords(array $rows, array $with = [])
 */
class EntityWord extends Mapper
{
}
