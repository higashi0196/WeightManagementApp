<?php

require_once('config.php');

$getller = new Todocontroller();
$result = $getller->delete();

// $result = $getller->postdelete();

$response = '非同期通信 成功';
echo json_encode($response);

?>
