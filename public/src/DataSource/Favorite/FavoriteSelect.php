<?php
declare(strict_types=1);

namespace DataSource\Favorite;

use Atlas\Mapper\MapperSelect;

/**
 * @method FavoriteRecord|null fetchRecord()
 * @method FavoriteRecord[] fetchRecords()
 * @method FavoriteRecordSet fetchRecordSet()
 */
class FavoriteSelect extends MapperSelect
{
}
