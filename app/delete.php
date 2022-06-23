<?php

require_once('config.php');

$getller = new Todocontroller();
$result = $getller->delete();

$response = 'success';
echo json_encode($response);

// $result2 = $getller->postdelete();

?>
