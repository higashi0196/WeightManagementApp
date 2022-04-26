<?php

// require_once('config.php');

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//    $getller = new Todocontroller();
//    $getller->create2();
//    exit;
//    header('Location: ' . SITE_URL);
// }

// $content = '';
// if($_SERVER['REQUEST_METHOD'] === 'GET') {
//    if(isset($_GET['content'])) {
//       $content = $_GET['content'];
//    }
// }

?>

<!DOCTYPE html>
<html lang="ja">
<head> 
   <meta charset="utf-8">
   <title>明日への一言</title>
   <link rel="stylesheet" href="./css/styles.css">
</head>
<body>
<div class="miyako">
   <p>明日への一言</p>
   <textarea id="days" name="message" rows="2" cols="30"></textarea>
   <input type="button" onclick="" value="投稿">
   <a href="index.php">戻る</a>
</div>
</body>
</html>