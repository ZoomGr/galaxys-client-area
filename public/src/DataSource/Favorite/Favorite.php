<?php
declare(strict_types=1);

namespace DataSource\Favorite;

use Atlas\Mapper\Mapper;
use Atlas\Table\Row;

/**
 * @method FavoriteTable getTable()
 * @method FavoriteRelationships getRelationships()
 * @method FavoriteRecord|null fetchRecord($primaryVal, array $with = [])
 * @method FavoriteRecord|null fetchRecordBy(array $whereEquals, array $with = [])
 * @method FavoriteRecord[] fetchRecords(array $primaryVals, array $with = [])
 * @method FavoriteRecord[] fetchRecordsBy(array $whereEquals, array $with = [])
 * @method FavoriteRecordSet fetchRecordSet(array $primaryVals, array $with = [])
 * @method FavoriteRecordSet fetchRecordSetBy(array $whereEquals, array $with = [])
 * @method FavoriteSelect select(array $whereEquals = [])
 * @method FavoriteRecord newRecord(array $fields = [])
 * @method FavoriteRecord[] newRecords(array $fieldSets)
 * @method FavoriteRecordSet newRecordSet(array $records = [])
 * @method FavoriteRecord turnRowIntoRecord(Row $row, array $with = [])
 * @method FavoriteRecord[] turnRowsIntoRecords(array $rows, array $with = [])
 */
class Favorite extends Mapper
{
}
