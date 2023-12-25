<?php
declare(strict_types=1);

namespace DataSource\PersonalAccessToken;

use Atlas\Mapper\Record;

/**
 * @method PersonalAccessTokenRow getRow()
 */
class PersonalAccessTokenRecord extends Record
{
    use PersonalAccessTokenFields;
}
