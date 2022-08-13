<?php

require_once('./../../controller/controller.php');

$todocontroller = new Todocontroller();
$result = $todocontroller->delete();

$response = '非同期通信 成功';
echo json_encode($response);
echo $json;