<?php

// const DSN = 'mysql:host=mysql;dbname=todolists;charset=utf8mb4';
// const USER = 'root';
// const PASSWORD = 'Nanahigashi10!';

// $db = parse_url($_SERVER['CLEARDB_DATABASE_URL']);
// $db['dbname'] = ltrim($db['path'], '/');
// $dsn = "mysql:host={$db['host']};dbname={$db['dbname']};charset=utf8";
// $user = $db['user'];
// $password = $db['pass'];

$url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    
$db_name = substr($url["path"], 1);
$db_host = $url["host"];
$user = $url["user"];
$password = $url["pass"];

define ('SITE_URL', 'http://' . $_SERVER['HTTP_HOST']);