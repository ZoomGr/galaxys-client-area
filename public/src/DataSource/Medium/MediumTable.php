<?php
/**
 * This file was generated by Atlas. Changes will be overwritten.
 */
declare(strict_types=1);

namespace DataSource\Medium;

use Atlas\Table\Table;

/**
 * @method MediumRow|null fetchRow($primaryVal)
 * @method MediumRow[] fetchRows(array $primaryVals)
 * @method MediumTableSelect select(array $whereEquals = [])
 * @method MediumRow newRow(array $cols = [])
 * @method MediumRow newSelectedRow(array $cols)
 */
class MediumTable extends Table
{
    const DRIVER = 'mysql';

    const NAME = 'media';

    const COLUMNS = [
        'id' => array (
  'name' => 'id',
  'type' => 'int unsigned',
  'size' => 10,
  'scale' => 0,
  'notnull' => true,
  'default' => NULL,
  'autoinc' => true,
  'primary' => true,
  'options' => NULL,
),
        'disk' => array (
  'name' => 'disk',
  'type' => 'varchar',
  'size' => 32,
  'scale' => NULL,
  'notnull' => true,
  'default' => NULL,
  'autoinc' => false,
  'primary' => false,
  'options' => NULL,
),
        'directory' => array (
  'name' => 'directory',
  'type' => 'varchar',
  'size' => 255,
  'scale' => NULL,
  'notnull' => true,
  'default' => NULL,
  'autoinc' => false,
  'primary' => false,
  'options' => NULL,
),
        'filename' => array (
  'name' => 'filename',
  'type' => 'varchar',
  'size' => 255,
  'scale' => NULL,
  'notnull' => true,
  'default' => NULL,
  'autoinc' => false,
  'primary' => false,
  'options' => NULL,
),
        'extension' => array (
  'name' => 'extension',
  'type' => 'varchar',
  'size' => 32,
  'scale' => NULL,
  'notnull' => true,
  'default' => NULL,
  'autoinc' => false,
  'primary' => false,
  'options' => NULL,
),
        'mime_type' => array (
  'name' => 'mime_type',
  'type' => 'varchar',
  'size' => 128,
  'scale' => NULL,
  'notnull' => true,
  'default' => NULL,
  'autoinc' => false,
  'primary' => false,
  'options' => NULL,
),
        'aggregate_type' => array (
  'name' => 'aggregate_type',
  'type' => 'varchar',
  'size' => 32,
  'scale' => NULL,
  'notnull' => true,
  'default' => NULL,
  'autoinc' => false,
  'primary' => false,
  'options' => NULL,
),
        'size' => array (
  'name' => 'size',
  'type' => 'int unsigned',
  'size' => 10,
  'scale' => 0,
  'notnull' => true,
  'default' => NULL,
  'autoinc' => false,
  'primary' => false,
  'options' => NULL,
),
        'variant_name' => array (
  'name' => 'variant_name',
  'type' => 'varchar',
  'size' => 255,
  'scale' => NULL,
  'notnull' => false,
  'default' => NULL,
  'autoinc' => false,
  'primary' => false,
  'options' => NULL,
),
        'original_media_id' => array (
  'name' => 'original_media_id',
  'type' => 'int unsigned',
  'size' => 10,
  'scale' => 0,
  'notnull' => false,
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
        'id',
        'disk',
        'directory',
        'filename',
        'extension',
        'mime_type',
        'aggregate_type',
        'size',
        'variant_name',
        'original_media_id',
        'created_at',
        'updated_at',
    ];

    const COLUMN_DEFAULTS = [
        'id' => null,
        'disk' => null,
        'directory' => null,
        'filename' => null,
        'extension' => null,
        'mime_type' => null,
        'aggregate_type' => null,
        'size' => null,
        'variant_name' => null,
        'original_media_id' => null,
        'created_at' => null,
        'updated_at' => null,
    ];

    const PRIMARY_KEY = [
        'id',
    ];

    const AUTOINC_COLUMN = 'id';

    const AUTOINC_SEQUENCE = null;
}
