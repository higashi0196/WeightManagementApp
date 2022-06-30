<?php
require_once('config.php');

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
         <p class="kuroshima">画像アップロード</p>
         <input type="file" name="picture">
         <input type="submit" value="アプロード">
   </form>
   <a href="index.php">戻る</a>
</body>
</html>