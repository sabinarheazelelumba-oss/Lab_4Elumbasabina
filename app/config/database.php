<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

$database['main'] = array(
    'driver'    => 'mysql',
    'hostname'  => getenv('DB_HOST') ?: 'localhost',
    'port'      => getenv('DB_PORT') ?: '3306',
    'username'  => getenv('DB_USERNAME') ?: 'root',
    'password'  => getenv('DB_PASSWORD') ?: '',
    'database'  => getenv('DB_NAME') ?: 'mydb',
    'charset'   => 'utf8mb4',
    'dbprefix'  => '',
    'path'      => ''
);
