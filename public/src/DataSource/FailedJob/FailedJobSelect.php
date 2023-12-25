<?php
declare(strict_types=1);

namespace DataSource\FailedJob;

use Atlas\Mapper\MapperSelect;

/**
 * @method FailedJobRecord|null fetchRecord()
 * @method FailedJobRecord[] fetchRecords()
 * @method FailedJobRecordSet fetchRecordSet()
 */
class FailedJobSelect extends MapperSelect
{
}
