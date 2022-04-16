<?php

require_once('config.php');

$title   = $_GET['title'];
$content = $_GET['content'];
$id  = $_GET['id'];

?>

<!DOCTYPE html>
<html lang="ja">
<head> 
   <meta charset="utf-8">
   <title>編集画面</title>
   <link rel="stylesheet" href="./css/styles.css">
</head>
<body>
   <a class="edit-feeld">編集完了画面</a>
   <p class="taketomi">タイトル</p>
   <a>登録完了</a>
   <a href="index.php">戻る</a>
</body>
</html>