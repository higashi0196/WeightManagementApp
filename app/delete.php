<?php

require_once('config.php');

$getller = new Todocontroller();
$result = $getller->delete();
header('Location: ' . SITE_URL);
?>