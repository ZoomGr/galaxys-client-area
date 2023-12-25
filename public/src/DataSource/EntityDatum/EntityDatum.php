<?php
declare(strict_types=1);

namespace DataSource\EntityDatum;

use Atlas\Mapper\Mapper;
use Atlas\Table\Row;

/**
 * @method EntityDatumTable getTable()
 * @method EntityDatumRelationships getRelationships()
 * @method EntityDatumRecord|null fetchRecord($primaryVal, array $with = [])
 * @method EntityDatumRecord|null fetchRecordBy(array $whereEquals, array $with = [])
 * @method EntityDatumRecord[] fetchRecords(array $primaryVals, array $with = [])
 * @method EntityDatumRecord[] fetchRecordsBy(array $whereEquals, array $with = [])
 * @method EntityDatumRecordSet fetchRecordSet(array $primaryVals, array $with = [])
 * @method EntityDatumRecordSet fetchRecordSetBy(array $whereEquals, array $with = [])
 * @method EntityDatumSelect select(array $whereEquals = [])
 * @method EntityDatumRecord newRecord(array $fields = [])
 * @method EntityDatumRecord[] newRecords(array $fieldSets)
 * @method EntityDatumRecordSet newRecordSet(array $records = [])
 * @method EntityDatumRecord turnRowIntoRecord(Row $row, array $with = [])
 * @method EntityDatumRecord[] turnRowsIntoRecords(array $rows, array $with = [])
 */
class EntityDatum extends Mapper
{
}
