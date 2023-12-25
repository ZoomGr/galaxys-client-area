<?php
declare(strict_types=1);

namespace DataSource\Medium;

use Atlas\Mapper\MapperSelect;

/**
 * @method MediumRecord|null fetchRecord()
 * @method MediumRecord[] fetchRecords()
 * @method MediumRecordSet fetchRecordSet()
 */
class MediumSelect extends MapperSelect
{
}
