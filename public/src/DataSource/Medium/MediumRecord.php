<?php
declare(strict_types=1);

namespace DataSource\Medium;

use Atlas\Mapper\Record;

/**
 * @method MediumRow getRow()
 */
class MediumRecord extends Record
{
    use MediumFields;
}
