<?php
/**
 * This file was generated by Atlas. Changes will be overwritten.
 */
declare(strict_types=1);

namespace DataSource\Role;

use Atlas\Table\Table;

/**
 * @method RoleRow|null fetchRow($primaryVal)
 * @method RoleRow[] fetchRows(array $primaryVals)
 * @method RoleTableSelect select(array $whereEquals = [])
 * @method RoleRow newRow(array $cols = [])
 * @method RoleRow newSelectedRow(array $cols)
 */
class RoleTable extends Table
{
    const DRIVER = 'mysql';

    const NAME = 'roles';

    const COLUMNS = [
        'role_id' => array (
  'name' => 'role_id',
  'type' => 'bigint unsigned',
  'size' => 20,
  'scale' => 0,
  'notnull' => true,
  'default' => NULL,
  'autoinc' => true,
  'primary' => true,
  'options' => NULL,
),
        'role_name' => array (
  'name' => 'role_name',
  'type' => 'varchar',
  'size' => 255,
  'scale' => NULL,
  'notnull' => true,
  'default' => NULL,
  'autoinc' => false,
  'primary' => false,
  'options' => NULL,
),
        'slug' => array (
  'name' => 'slug',
  'type' => 'varchar',
  'size' => 255,
  'scale' => NULL,
  'notnull' => true,
  'default' => NULL,
  'autoinc' => false,
  'primary' => false,
  'options' => NULL,
),
        'created_at' => array (
  'name' => 'created_at',
  'type' => 'timestamp',
  'size' => NULL,
  'scale' => NULL,
  'notnull' => false,
  'default' => NULL,
  'autoinc' => false,
  'primary' => false,
  'options' => NULL,
),
        'updated_at' => array (
  'name' => 'updated_at',
  'type' => 'timestamp',
  'size' => NULL,
  'scale' => NULL,
  'notnull' => false,
  'default' => NULL,
  'autoinc' => false,
  'primary' => false,
  'options' => NULL,
),
    ];

    const COLUMN_NAMES = [
        'role_id',
        'role_name',
        'slug',
        'created_at',
        'updated_at',
    ];

    const COLUMN_DEFAULTS = [
        'role_id' => null,
        'role_name' => null,
        'slug' => null,
        'created_at' => null,
        'updated_at' => null,
    ];

    const PRIMARY_KEY = [
        'role_id',
    ];

    const AUTOINC_COLUMN = 'role_id';

    const AUTOINC_SEQUENCE = null;
}