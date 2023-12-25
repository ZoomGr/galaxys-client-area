<?php
declare(strict_types=1);

namespace DataSource\EntityDatum;

use Atlas\Mapper\Record;

/**
 * @method EntityDatumRow getRow()
 */
class EntityDatumRecord extends Record
{
    use EntityDatumFields;
}
