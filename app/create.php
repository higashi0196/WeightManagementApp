<?php

require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $getller = new Todocontroller();
   $getller->create();
   exit;
   header('Location: ' . SITE_URL);
}

$title = '';
$content = '';
if($_SERVER['REQUEST_METHOD'] === 'GET') {

   if(isset($_GET['title'])) {
      $title = $_GET['title'];
   }

   if(isset($_GET['content'])) {
      $content = $_GET['content'];
   }
}

?>

<!DOCTYPE html>
<html lang="ja">
<head> 
   <meta charset="utf-8">
   <title>新規登録</title>
   <link rel="stylesheet" href="./css/styles.css">
</head>
<body>
   <a class="new-create">新規登録</a>
   <form method="POST" action="./create.php">
      <div>
         <p class="taketomi">タイトル</p>
         <input type="text" name="title">
      </div>
      <div>
         <p class="kohama">目標</p>
         <textarea name="content"></textarea>
      </div>
      <button type="submit" class="shinki-btn">登録</button>
      <a href="index.php">戻る</a>
   </form>
</body>
</html>