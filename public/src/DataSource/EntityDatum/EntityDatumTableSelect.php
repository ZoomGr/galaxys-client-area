<?php
declare(strict_types=1);

namespace DataSource\EntityDatum;

use Atlas\Table\TableSelect;

/**
 * @method EntityDatumRow|null fetchRow()
 * @method EntityDatumRow[] fetchRows()
 */
class EntityDatumTableSelect extends TableSelect
{
}
