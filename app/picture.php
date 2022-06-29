<?php
require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $getller = new Todocontroller();
   $getller->postcreate();
   exit;
   header('Location: ' . SITE_URL);
}

// $content = '';
if($_SERVER['REQUEST_METHOD'] === 'GET') {
   if(isset($_GET['content'])) {
      $content = $_GET['content'];
   }
}

session_start();
$post_errors = $_SESSION['post_errors'];
unset($_SESSION['post_errors']);

?>

<!DOCTYPE html>
<html lang="ja">
<head> 
   <meta charset="utf-8">
   <title>画像アップロード</title>
   <link rel="stylesheet" href="./css/styles.css">
</head>
<body class="miyako">
   <form method="POST" action="./picture.php.php" enctype=”multipart/form-data”>
         <p class="kuroshima">画像アップロード１</p>
         <!-- <input type="text" name="image"> -->
         <input type="file" name="picture">
         <button type="submit">アプロード</button>
   </form>
   <a href="index.php">戻る</a>
</body>
</html>