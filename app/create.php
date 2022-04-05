<?php

require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $getller = new Todocontroller;
   $getller->create();
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
         <div>タイトル</div>
         <input type="text" name="title"></input>
      </div>
      <div>
         <div>目標</div>
         <textarea name="content"></textarea>
      </div>
         <button type="submit" class="shinki-btn">登録</button>
         <input type="submit" class="rtn-btn" name="submit" value="戻る">
   </form>
</body>
</html>