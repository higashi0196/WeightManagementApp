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
<body class="miyako">
   <a class="new-create">新規登録</a>
   <form method="POST" action="./create.php">
      <div>
         <div>
            <p>タイトル</p>
            <input type="text" name="title">
         </div>
         <div>
            <p>目標</p>
            <textarea name="content"></textarea>
         </div>
         <button type="submit" class="shinki-btn">登録</button>
      </div>
   </form>
   <a href="index.php"><button>戻る</button></a>
</body>
</html>