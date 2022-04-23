<?php

require_once('config.php');

$getller = new Todocontroller();
$result = $getller->delete();

header('Location: ' . SITE_URL);

?>

<!-- javascript  -->
<!-- 試し用 -->
<!-- <td><button id="btn2" class="delete-btn">Click2</button></td>
<td><button id="btn3" class="delete-btn">Click3</button></td> -->
<!-- 試し用終わり -->

<!DOCTYPE html>
<html lang="ja">
<head> 
   <meta charset="utf-8">
   <title>編集画面</title>
   <link rel="stylesheet" href="./css/styles.css">
</head>
<body>
   <a class="edit-feeld">削除画面</a>
</body>
</html>