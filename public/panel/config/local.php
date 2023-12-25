<?php
    use \DevCoder\DotEnv;
    require('DotEnv.php');

    (new DotEnv('../../.env'))->load();

	define("DB_LOCATION", getenv('DB_HOST'));
	define("DB_NAME", getenv('DB_DATABASE'));
	define("DB_USER", getenv('DB_USERNAME'));
	define("DB_PASSWORD", getenv('DB_PASSWORD'));

