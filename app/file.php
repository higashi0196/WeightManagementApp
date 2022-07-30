<?php

require_once('config.php');

session_start();
// $token = new Token();
// $token->create();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $getller = new Todocontroller();
   $getller->pictures();
   exit;
}

$getller = new Todocontroller();
$filelists = $getller->files();



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
   <div>
      <input type="file" name="img" class="fileinput">
      <p class="memo">☆ 一言メモ ☆</p>
      <textarea name="comment" class="comment"></textarea>
   </div>
   <button type="submit" class="file-btn">送信</button>
   <input type="hidden" name="MAX_FILE_SIZE" value="1048576">
</form>
<a href="index.php"><button class="return-btn">戻る</button></a>
<li>
   <ul>
      <?php foreach ($filelists as $filelist): ?> 
         <img src="<?php echo $filelist['file_path']; ?>" alt=""  >
         <p><?php echo $filelist['comment']; ?></p>
      <?php endforeach; ?>
   </ul>
</li>
<script>
</script>
</body>
</html>
