<?php
declare(strict_types=1);

namespace DataSource\EntitySeo;

use Atlas\Mapper\Record;

/**
 * @method EntitySeoRow getRow()
 */
class EntitySeoRecord extends Record
{
    use EntitySeoFields;
}
