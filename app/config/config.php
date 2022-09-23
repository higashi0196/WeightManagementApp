<?php

$db = parse_url($_SERVER['CLEARDB_DATABASE_URL']);
$db['dbname'] = ltrim($db['path'], '/');
$dsn = "mysql:host={$db['host']};dbname={$db['dbname']};charset=utf8";
$user = $db['user'];
$password = $db['pass'];

// const DSN = 'mysql:host=mysql;dbname=todolists;charset=utf8mb4';
// const USER = 'root';
// const PASSWORD = 'Nanahigashi10!';
define ('SITE_URL', 'http://' . $_SERVER['HTTP_HOST']);