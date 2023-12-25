<?php
declare(strict_types=1);

namespace DataSource\Language;

use Atlas\Mapper\Record;

/**
 * @method LanguageRow getRow()
 */
class LanguageRecord extends Record
{
    use LanguageFields;
}
