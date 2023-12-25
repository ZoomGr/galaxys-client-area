<?php
declare(strict_types=1);

namespace DataSource\EntityGalleryLang;

use Atlas\Mapper\Mapper;
use Atlas\Table\Row;

/**
 * @method EntityGalleryLangTable getTable()
 * @method EntityGalleryLangRelationships getRelationships()
 * @method EntityGalleryLangRecord|null fetchRecord($primaryVal, array $with = [])
 * @method EntityGalleryLangRecord|null fetchRecordBy(array $whereEquals, array $with = [])
 * @method EntityGalleryLangRecord[] fetchRecords(array $primaryVals, array $with = [])
 * @method EntityGalleryLangRecord[] fetchRecordsBy(array $whereEquals, array $with = [])
 * @method EntityGalleryLangRecordSet fetchRecordSet(array $primaryVals, array $with = [])
 * @method EntityGalleryLangRecordSet fetchRecordSetBy(array $whereEquals, array $with = [])
 * @method EntityGalleryLangSelect select(array $whereEquals = [])
 * @method EntityGalleryLangRecord newRecord(array $fields = [])
 * @method EntityGalleryLangRecord[] newRecords(array $fieldSets)
 * @method EntityGalleryLangRecordSet newRecordSet(array $records = [])
 * @method EntityGalleryLangRecord turnRowIntoRecord(Row $row, array $with = [])
 * @method EntityGalleryLangRecord[] turnRowsIntoRecords(array $rows, array $with = [])
 */
class EntityGalleryLang extends Mapper
{
}
