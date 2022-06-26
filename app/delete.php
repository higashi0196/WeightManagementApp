<?php

require_once('config.php');

$getller = new Todocontroller();
$result = $getller->delete();

$response = '非同期通信 成功';
echo json_encode($response);
echo $json;

?>
