<?php
declare(strict_types=1);

namespace DataSource\Entity;

use Atlas\Table\TableSelect;

/**
 * @method EntityRow|null fetchRow()
 * @method EntityRow[] fetchRows()
 */
class EntityTableSelect extends TableSelect
{
}
