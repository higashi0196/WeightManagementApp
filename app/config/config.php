<?php

session_start();

// const DSN = 'mysql:host=mysql;dbname=todolists;charset=utf8mb4';
// const USER = 'root';
// const PASSWORD = 'Nanahigashi10!';
// define ('SITE_URL', 'http://' . $_SERVER['HTTP_HOST']);

$db = parse_url($_SERVER['CLEARDB_DATABASE_URL']);
$db['dbname'] = ltrim($db['path'], '/');
$user = $db['user'];
$password = $db['pass'];
$dsn = "mysql:host={$db['host']};dbname={$db['dbname']};charset=utf8mb4";