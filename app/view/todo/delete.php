<?php

require_once('./../../controller/controller.php');

$todocontroller = new Todocontroller();
$result = $todocontroller->tododelete();

$response = '非同期通信 & todo削除 成功';
echo json_encode($response);