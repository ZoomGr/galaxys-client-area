<?php
declare(strict_types=1);

namespace DataSource\EntityDataLang;

use Atlas\Mapper\Record;

/**
 * @method EntityDataLangRow getRow()
 */
class EntityDataLangRecord extends Record
{
    use EntityDataLangFields;
}
