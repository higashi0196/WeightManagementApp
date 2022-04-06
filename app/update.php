<?php

require_once('config.php');

?>

<!DOCTYPE html>
<html lang="ja">
<head> 
   <meta charset="utf-8">
   <title>編集画面</title>
   <link rel="stylesheet" href="./css/styles.css">
</head>
<body>
   <a class="">編集画面</a>
   <form method="POST" action="./update.php">
      <div>
         <div>タイトル</div>
         <input type="text" name="title"></input>
      </div>
      <div>
         <div>目標</div>
         <textarea name="content"></textarea>
      </div>
         <button type="submit" class="update-btn">更新</button>
      <div>
         <a href="index.php">戻る</a>
      </div>
   </form>
</body>
</html>