<?php

const DSN = 'mysql:host=mysql;dbname=todolists;charset=utf8mb4';
const USER = 'root';
const PASSWORD = 'Nanahigashi10!';
// const OPTIONS = '[
//    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
//    PDO::ATTR_EMULATE_PREPARES => false,
// ]';
define ('SITE_URL', 'http://' . $_SERVER['HTTP_HOST']);

require_once('./model/Database.php');
require_once('./controller/controller.php');