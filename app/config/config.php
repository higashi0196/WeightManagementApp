<?php

session_start();

const DSN = 'mysql:host=mysql;dbname=todolists;charset=utf8mb4';
const USER = 'root';
const PASSWORD = 'Nanahigashi10!';
define ('SITE_URL', 'http://' . $_SERVER['HTTP_HOST']);