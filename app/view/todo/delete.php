<?php

require_once('./../../controller/Controller.php');

$todocontroller = new Todocontroller();
$tododele = $todocontroller->tododelete();

$response = '非同期通信 & todo削除 成功';
echo json_encode($response);