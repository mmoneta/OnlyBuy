<?php

use src\utils\DotEnv;

DotEnv::load(__DIR__);

if (!defined('HOST')) {
    define('HOST', DotEnv::get('DB_HOST'));
}

if (!defined('DATABASE')) {
    define('DATABASE', DotEnv::get('DB_NAME'));
}

if (!defined('USERNAME')) {
    define('USERNAME', DotEnv::get('DB_USER'));
}

if (!defined('PASSWORD')) {
    define('PASSWORD', DotEnv::get('DB_PASSWORD'));
}