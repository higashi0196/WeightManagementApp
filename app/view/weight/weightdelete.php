<?php

require_once('./../../controller/Controller.php');

$weightcontroller = new Weightcontroller();
$weightresult = $weightcontroller->weightdelete();

$weightresponse = '非同期通信 & weight削除 成功';
echo json_encode($weightresponse);