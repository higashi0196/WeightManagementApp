<?php

require_once('config.php');

// session_start();
// $token = new Token();
// $token->create();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $getller = new Todocontroller();
   $getller->pictures();
   exit;
}

$getller = new Todocontroller();
// $getller->files();
$files = $getller->files();
var_dump($files);
?>

<!DOCTYPE html>
<html lang="ja">
<head> 
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>画像アップロード</title>
   <link rel="stylesheet" href="./css/styles.css">
</head>
<body>
<p class="outline">画像アップロード</p>
<form action="file.php" method="POST" enctype="multipart/form-data">
<!-- <form action="file_upload.php" method="POST" enctype="multipart/form-data"> -->
   <input type="file" name="img">
   <input type="hidden" name="MAX_FILE_SIZE" value="1048576">
   <input type="submit" value="送信する">
</form>
<a href="index.php"><button class="return-btn">戻る</button></a>
<div>
   <?php foreach ($files as $file): ?> 
      <img src="<?php echo "{$file['file_path']}"; ?>" alt="">
      <p><?php echo $file; ?></p>
   <?php endforeach; ?>
</div>
</body>
</html>
