<?php

$env = parse_ini_file('.env');

define('APP_URL', $env['APP_URL']);

define('DB_DRIVER', $env['DB_DRIVER']);
define('DB_HOST', $env['DB_HOST']);
define('DB_PORT', $env['DB_PORT']);
define('DB_NAME', $env['DB_NAME']);
define('DB_USER', $env['DB_USER']);
define('DB_PASSWORD', $env['DB_PASSWORD']);
