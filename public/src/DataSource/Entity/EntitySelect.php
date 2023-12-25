<?php
declare(strict_types=1);

namespace DataSource\Entity;

use Atlas\Mapper\MapperSelect;

/**
 * @method EntityRecord|null fetchRecord()
 * @method EntityRecord[] fetchRecords()
 * @method EntityRecordSet fetchRecordSet()
 */
class EntitySelect extends MapperSelect
{
}
