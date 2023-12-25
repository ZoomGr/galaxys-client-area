<?php
declare(strict_types=1);

namespace DataSource\Language;

use Atlas\Mapper\Mapper;
use Atlas\Table\Row;

/**
 * @method LanguageTable getTable()
 * @method LanguageRelationships getRelationships()
 * @method LanguageRecord|null fetchRecord($primaryVal, array $with = [])
 * @method LanguageRecord|null fetchRecordBy(array $whereEquals, array $with = [])
 * @method LanguageRecord[] fetchRecords(array $primaryVals, array $with = [])
 * @method LanguageRecord[] fetchRecordsBy(array $whereEquals, array $with = [])
 * @method LanguageRecordSet fetchRecordSet(array $primaryVals, array $with = [])
 * @method LanguageRecordSet fetchRecordSetBy(array $whereEquals, array $with = [])
 * @method LanguageSelect select(array $whereEquals = [])
 * @method LanguageRecord newRecord(array $fields = [])
 * @method LanguageRecord[] newRecords(array $fieldSets)
 * @method LanguageRecordSet newRecordSet(array $records = [])
 * @method LanguageRecord turnRowIntoRecord(Row $row, array $with = [])
 * @method LanguageRecord[] turnRowsIntoRecords(array $rows, array $with = [])
 */
class Language extends Mapper
{
}
