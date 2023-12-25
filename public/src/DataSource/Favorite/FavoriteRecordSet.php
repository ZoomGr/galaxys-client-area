<?php
declare(strict_types=1);

namespace DataSource\Favorite;

use Atlas\Mapper\RecordSet;

/**
 * @method FavoriteRecord offsetGet($offset)
 * @method FavoriteRecord appendNew(array $fields = [])
 * @method FavoriteRecord|null getOneBy(array $whereEquals)
 * @method FavoriteRecordSet getAllBy(array $whereEquals)
 * @method FavoriteRecord|null detachOneBy(array $whereEquals)
 * @method FavoriteRecordSet detachAllBy(array $whereEquals)
 * @method FavoriteRecordSet detachAll()
 * @method FavoriteRecordSet detachDeleted()
 */
class FavoriteRecordSet extends RecordSet
{
}
