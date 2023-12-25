<?php
declare(strict_types=1);

namespace DataSource\EntitySeo;

use Atlas\Mapper\Mapper;
use Atlas\Table\Row;

/**
 * @method EntitySeoTable getTable()
 * @method EntitySeoRelationships getRelationships()
 * @method EntitySeoRecord|null fetchRecord($primaryVal, array $with = [])
 * @method EntitySeoRecord|null fetchRecordBy(array $whereEquals, array $with = [])
 * @method EntitySeoRecord[] fetchRecords(array $primaryVals, array $with = [])
 * @method EntitySeoRecord[] fetchRecordsBy(array $whereEquals, array $with = [])
 * @method EntitySeoRecordSet fetchRecordSet(array $primaryVals, array $with = [])
 * @method EntitySeoRecordSet fetchRecordSetBy(array $whereEquals, array $with = [])
 * @method EntitySeoSelect select(array $whereEquals = [])
 * @method EntitySeoRecord newRecord(array $fields = [])
 * @method EntitySeoRecord[] newRecords(array $fieldSets)
 * @method EntitySeoRecordSet newRecordSet(array $records = [])
 * @method EntitySeoRecord turnRowIntoRecord(Row $row, array $with = [])
 * @method EntitySeoRecord[] turnRowsIntoRecords(array $rows, array $with = [])
 */
class EntitySeo extends Mapper
{
}
