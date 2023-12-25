<?php
declare(strict_types=1);

namespace DataSource\EntityDatum;

use Atlas\Mapper\MapperSelect;

/**
 * @method EntityDatumRecord|null fetchRecord()
 * @method EntityDatumRecord[] fetchRecords()
 * @method EntityDatumRecordSet fetchRecordSet()
 */
class EntityDatumSelect extends MapperSelect
{
}
