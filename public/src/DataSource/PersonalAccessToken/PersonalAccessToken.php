<?php
declare(strict_types=1);

namespace DataSource\PersonalAccessToken;

use Atlas\Mapper\Mapper;
use Atlas\Table\Row;

/**
 * @method PersonalAccessTokenTable getTable()
 * @method PersonalAccessTokenRelationships getRelationships()
 * @method PersonalAccessTokenRecord|null fetchRecord($primaryVal, array $with = [])
 * @method PersonalAccessTokenRecord|null fetchRecordBy(array $whereEquals, array $with = [])
 * @method PersonalAccessTokenRecord[] fetchRecords(array $primaryVals, array $with = [])
 * @method PersonalAccessTokenRecord[] fetchRecordsBy(array $whereEquals, array $with = [])
 * @method PersonalAccessTokenRecordSet fetchRecordSet(array $primaryVals, array $with = [])
 * @method PersonalAccessTokenRecordSet fetchRecordSetBy(array $whereEquals, array $with = [])
 * @method PersonalAccessTokenSelect select(array $whereEquals = [])
 * @method PersonalAccessTokenRecord newRecord(array $fields = [])
 * @method PersonalAccessTokenRecord[] newRecords(array $fieldSets)
 * @method PersonalAccessTokenRecordSet newRecordSet(array $records = [])
 * @method PersonalAccessTokenRecord turnRowIntoRecord(Row $row, array $with = [])
 * @method PersonalAccessTokenRecord[] turnRowsIntoRecords(array $rows, array $with = [])
 */
class PersonalAccessToken extends Mapper
{
}
