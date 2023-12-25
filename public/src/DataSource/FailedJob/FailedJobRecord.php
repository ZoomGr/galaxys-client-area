<?php
declare(strict_types=1);

namespace DataSource\FailedJob;

use Atlas\Mapper\Record;

/**
 * @method FailedJobRow getRow()
 */
class FailedJobRecord extends Record
{
    use FailedJobFields;
}
