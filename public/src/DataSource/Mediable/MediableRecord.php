<?php
declare(strict_types=1);

namespace DataSource\Mediable;

use Atlas\Mapper\Record;

/**
 * @method MediableRow getRow()
 */
class MediableRecord extends Record
{
    use MediableFields;
}
