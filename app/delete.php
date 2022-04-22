<?php

require_once('config.php');

$getller = new Todocontroller();
$result = $getller->delete();
header('Location: ' . SITE_URL);

$response = array();
if($result) {
    $response['result'] = 'success';
} else {
    $response['result'] = 'fail';
}

echo json_encode($response);
?>