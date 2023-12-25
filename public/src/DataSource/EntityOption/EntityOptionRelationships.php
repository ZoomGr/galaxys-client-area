<?php
declare(strict_types=1);

namespace DataSource\EntityOption;

use Atlas\Mapper\MapperRelationships;
use DataSource\Entity\Entity;

class EntityOptionRelationships extends MapperRelationships
{
    protected function define()
    {
        $this->oneToOne('entity', Entity::CLASS, [
            'eo_value' => 'entity_id',
        ]);
    }
}
