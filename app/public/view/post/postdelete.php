<?php

require_once('./../../../controller/controller.php');

$postcontroller = new Postcontroller();
$postresult = $postcontroller->postdelete();

$postresponse = '非同期通信 & post削除 成功';
$json = json_encode($postresponse);
echo $json;