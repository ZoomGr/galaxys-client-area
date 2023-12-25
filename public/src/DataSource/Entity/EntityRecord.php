<?php
declare(strict_types=1);

namespace DataSource\Entity;

use Atlas\Mapper\Record;

/**
 * @method EntityRow getRow()
 */
class EntityRecord extends Record
{
    use EntityFields;
}
