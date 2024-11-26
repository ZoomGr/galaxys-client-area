<?php
/**
 * This file was generated by Atlas. Changes will be overwritten.
 */
declare(strict_types=1);

namespace DataSource\PasswordReset;

use Atlas\Table\Table;

/**
 * @method PasswordResetRow|null fetchRow($primaryVal)
 * @method PasswordResetRow[] fetchRows(array $primaryVals)
 * @method PasswordResetTableSelect select(array $whereEquals = [])
 * @method PasswordResetRow newRow(array $cols = [])
 * @method PasswordResetRow newSelectedRow(array $cols)
 */
class PasswordResetTable extends Table
{
    const DRIVER = 'mysql';

    const NAME = 'password_resets';

    const COLUMNS = [
        'email' => array (
  'name' => 'email',
  'type' => 'varchar',
  'size' => 255,
  'scale' => NULL,
  'notnull' => true,
  'default' => NULL,
  'autoinc' => false,
  'primary' => false,
  'options' => NULL,
),
        'token' => array (
  'name' => 'token',
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
    ];

    const COLUMN_NAMES = [
        'email',
        'token',
        'created_at',
    ];

    const COLUMN_DEFAULTS = [
        'email' => null,
        'token' => null,
        'created_at' => null,
    ];

    const PRIMARY_KEY = [
    ];

    const AUTOINC_COLUMN = null;

    const AUTOINC_SEQUENCE = null;
}
