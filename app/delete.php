<?php

require_once('config.php');

// echo $_SERVER['REQUEST_METHOD'];

$getller = new Todocontroller();
$result = $getller->delete();

$response = 'success1';
echo json_encode($response);

// header("Location: index.php");
// $result2 = $getller->postdelete();

// $response =  array();
// $response['result'] = $result;

// if($result) {
//    $response['result'] = 'success';
// } else {
//    $response['result'] = 'fail';
// }

?>
