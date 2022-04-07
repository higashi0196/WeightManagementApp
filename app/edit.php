<?php

require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $getller = new Todocontroller;
   $getller->edit();
   exit;
}

?>

<!DOCTYPE html>
<html lang="ja">
<head> 
   <meta charset="utf-8">
   <title>編集画面</title>
   <link rel="stylesheet" href="./css/styles.css">
</head>
<body>
   <a class="edit-feeld">編集画面</a>
   <form method="POST" action="./edit.php">
      <div>
         <p class="taketomi">タイトル</p>
         <input type="text" name="title"></input>
      </div>
      <div>
         <p class="kohama">目標</p>
         <textarea name="content"></textarea>
      </div>
         <button type="submit" class="edit-btn">更新</button>
         <a href="index.php">戻る</a>
      </div>
   </form>
</body>
</html>