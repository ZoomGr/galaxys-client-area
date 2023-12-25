<?php
declare(strict_types=1);

namespace DataSource\Favorite;

use Atlas\Mapper\Record;

/**
 * @method FavoriteRow getRow()
 */
class FavoriteRecord extends Record
{
    use FavoriteFields;
}
