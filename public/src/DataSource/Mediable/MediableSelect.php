<?php
declare(strict_types=1);

namespace DataSource\Mediable;

use Atlas\Mapper\MapperSelect;

/**
 * @method MediableRecord|null fetchRecord()
 * @method MediableRecord[] fetchRecords()
 * @method MediableRecordSet fetchRecordSet()
 */
class MediableSelect extends MapperSelect
{
}
