<?php
declare(strict_types=1);

namespace DataSource\EntityGallery;

use Atlas\Mapper\Mapper;
use Atlas\Table\Row;

/**
 * @method EntityGalleryTable getTable()
 * @method EntityGalleryRelationships getRelationships()
 * @method EntityGalleryRecord|null fetchRecord($primaryVal, array $with = [])
 * @method EntityGalleryRecord|null fetchRecordBy(array $whereEquals, array $with = [])
 * @method EntityGalleryRecord[] fetchRecords(array $primaryVals, array $with = [])
 * @method EntityGalleryRecord[] fetchRecordsBy(array $whereEquals, array $with = [])
 * @method EntityGalleryRecordSet fetchRecordSet(array $primaryVals, array $with = [])
 * @method EntityGalleryRecordSet fetchRecordSetBy(array $whereEquals, array $with = [])
 * @method EntityGallerySelect select(array $whereEquals = [])
 * @method EntityGalleryRecord newRecord(array $fields = [])
 * @method EntityGalleryRecord[] newRecords(array $fieldSets)
 * @method EntityGalleryRecordSet newRecordSet(array $records = [])
 * @method EntityGalleryRecord turnRowIntoRecord(Row $row, array $with = [])
 * @method EntityGalleryRecord[] turnRowsIntoRecords(array $rows, array $with = [])
 */
class EntityGallery extends Mapper
{
}
