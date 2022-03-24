<?php

define('DSN', '');
define('DB_USER', '');
define('DB_PASS', '');

$pdo = new PDO(
   'mysql:host=db;dbname=todoapp;charset=utf8m4',
   'higashi',
   'higashi'
);