<?php
declare(strict_types=1);

namespace DataSource\Entity;

use Atlas\Mapper\Mapper;
use Atlas\Table\Row;

/**
 * @method EntityTable getTable()
 * @method EntityRelationships getRelationships()
 * @method EntityRecord|null fetchRecord($primaryVal, array $with = [])
 * @method EntityRecord|null fetchRecordBy(array $whereEquals, array $with = [])
 * @method EntityRecord[] fetchRecords(array $primaryVals, array $with = [])
 * @method EntityRecord[] fetchRecordsBy(array $whereEquals, array $with = [])
 * @method EntityRecordSet fetchRecordSet(array $primaryVals, array $with = [])
 * @method EntityRecordSet fetchRecordSetBy(array $whereEquals, array $with = [])
 * @method EntitySelect select(array $whereEquals = [])
 * @method EntityRecord newRecord(array $fields = [])
 * @method EntityRecord[] newRecords(array $fieldSets)
 * @method EntityRecordSet newRecordSet(array $records = [])
 * @method EntityRecord turnRowIntoRecord(Row $row, array $with = [])
 * @method EntityRecord[] turnRowsIntoRecords(array $rows, array $with = [])
 */
class Entity extends Mapper
{
}
