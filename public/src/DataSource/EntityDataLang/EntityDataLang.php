<?php
declare(strict_types=1);

namespace DataSource\EntityDataLang;

use Atlas\Mapper\Mapper;
use Atlas\Table\Row;

/**
 * @method EntityDataLangTable getTable()
 * @method EntityDataLangRelationships getRelationships()
 * @method EntityDataLangRecord|null fetchRecord($primaryVal, array $with = [])
 * @method EntityDataLangRecord|null fetchRecordBy(array $whereEquals, array $with = [])
 * @method EntityDataLangRecord[] fetchRecords(array $primaryVals, array $with = [])
 * @method EntityDataLangRecord[] fetchRecordsBy(array $whereEquals, array $with = [])
 * @method EntityDataLangRecordSet fetchRecordSet(array $primaryVals, array $with = [])
 * @method EntityDataLangRecordSet fetchRecordSetBy(array $whereEquals, array $with = [])
 * @method EntityDataLangSelect select(array $whereEquals = [])
 * @method EntityDataLangRecord newRecord(array $fields = [])
 * @method EntityDataLangRecord[] newRecords(array $fieldSets)
 * @method EntityDataLangRecordSet newRecordSet(array $records = [])
 * @method EntityDataLangRecord turnRowIntoRecord(Row $row, array $with = [])
 * @method EntityDataLangRecord[] turnRowsIntoRecords(array $rows, array $with = [])
 */
class EntityDataLang extends Mapper
{
}
