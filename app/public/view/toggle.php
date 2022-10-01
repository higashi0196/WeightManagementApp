<?php

require_once('./../../controller/controller.php');

$todocontroller = new Todocontroller();
$toggleresult = $todocontroller->todotoggle();

$toggleresponse = '非同期通信 & toggle 成功';
echo json_encode($toggleresponse);
echo $json;