<?php

session_start();

// const DSN = 'mysql:host=mysql;dbname=todolists;charset=utf8mb4';
// const USER = 'root';
// const PASSWORD = 'Nanahigashi10!';

// $db = parse_url($_SERVER['CLEARDB_DATABASE_URL']);
$db = parse_url(getenv("CLEARDB_DATABASE_URL"));
$db['dbname'] = ltrim($db['path'], '/');
$user = $db['user'];
$password = $db['pass'];
$db_host = $db["host"];

$dsn = "mysql:dbname=.$db_name.;host=.$db_host;charset=utf8";
// $dsn = "mysql:dbname=".$db_name.";host=".$db_host;"charset=utf8";
define ('SITE_URL', 'http://' . $_SERVER['HTTP_HOST']);