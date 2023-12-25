<?php
declare(strict_types=1);

namespace DataSource\EntityWord;

use Atlas\Mapper\Record;

/**
 * @method EntityWordRow getRow()
 */
class EntityWordRecord extends Record
{
    use EntityWordFields;
}
