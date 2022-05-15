<?php

require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $getller = new Todocontroller();
   $getller->create2();
   exit;
   header('Location: ' . SITE_URL);
}

$content = '';
if($_SERVER['REQUEST_METHOD'] === 'GET') {
   if(isset($_GET['content'])) {
      $content = $_GET['content'];
   }
}

?>

<!DOCTYPE html>
<html lang="ja">
<head> 
   <meta charset="utf-8">
   <title>明日への一言</title>
   <link rel="stylesheet" href="./css/styles.css">
</head>
<body>

<form method="POST" action="./post.php">
   <div class="miyako">
      <p class="kuroshima">明日への一言1</p>
      <textarea name="content2" cols="30" rows="4"></textarea>
   </div>
   <div class="miyako"> 
      <button type="submit" class="post-btn">投稿する</button>
      <a href="index.php">戻る</a>
   </div>
</form>
</body>
</html>