<?php
declare(strict_types=1);

namespace DataSource\EntityOption;

use Atlas\Mapper\Record;

/**
 * @method EntityOptionRow getRow()
 */
class EntityOptionRecord extends Record
{
    use EntityOptionFields;
}
