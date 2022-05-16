<?php

require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $getller = new Todocontroller();
   $getller->dietcreate();
   exit;
   header('Location: ' . SITE_URL);
}

$body = '';
$weight = '';
if($_SERVER['REQUEST_METHOD'] === 'GET') {

   if(isset($_GET['body'])) {
      $body = $_GET['body'];
   }

   if(isset($_GET['weight'])) {
      $weight = $_GET['weight'];
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
   <a class="new-create">体重記録</a>
   <form method="POST" action="./weight.php">
      <div class="miyako">
      <div>
         <p>目標体重 : <input type="text" name="body"></p>
      </div>
      <div>
         <p>現在の体重 : <input type="date" name="111"></p>
         <input type="text" name="weight">
      </div>
      <button type="submit" class="shinki-btn">記入</button>
      <a href="index.php">戻る</a>
      </div>
   </form>
</body>
</html>