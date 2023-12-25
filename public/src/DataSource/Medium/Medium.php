<?php
declare(strict_types=1);

namespace DataSource\Medium;

use Atlas\Mapper\Mapper;
use Atlas\Table\Row;

/**
 * @method MediumTable getTable()
 * @method MediumRelationships getRelationships()
 * @method MediumRecord|null fetchRecord($primaryVal, array $with = [])
 * @method MediumRecord|null fetchRecordBy(array $whereEquals, array $with = [])
 * @method MediumRecord[] fetchRecords(array $primaryVals, array $with = [])
 * @method MediumRecord[] fetchRecordsBy(array $whereEquals, array $with = [])
 * @method MediumRecordSet fetchRecordSet(array $primaryVals, array $with = [])
 * @method MediumRecordSet fetchRecordSetBy(array $whereEquals, array $with = [])
 * @method MediumSelect select(array $whereEquals = [])
 * @method MediumRecord newRecord(array $fields = [])
 * @method MediumRecord[] newRecords(array $fieldSets)
 * @method MediumRecordSet newRecordSet(array $records = [])
 * @method MediumRecord turnRowIntoRecord(Row $row, array $with = [])
 * @method MediumRecord[] turnRowsIntoRecords(array $rows, array $with = [])
 */
class Medium extends Mapper
{
}
