<?php

require_once('config.php');

session_start();
$token = new Token();
$token->create();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $getller = new Todocontroller();
   $getller->pictures();
   exit;
}

$getller = new Todocontroller();
$filelists = $getller->files();

$token_errors = $_SESSION['token_errors'];
unset($_SESSION['token_errors']);
$filesize_errors = $_SESSION['filesize_errors'];
unset($_SESSION['filesize_errors']);
$comment_errors = $_SESSION['comment_errors'];
unset($_SESSION['comment_errors']);

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
   <?php if($token_errors):?>
      <?php foreach ($token_errors as $token_error): ?>
         <p class="error-log"><?php echo Utils::h($token_error);?></p>
      <?php endforeach;?>
   <?endif;?>

   <div>
      <input type="file" name="img" class="fileinput">
      <p class="memo">☆ 一言メモ ☆</p>
      <textarea name="comment" class="comment"></textarea>
   </div>
   <p>※画像は5件までアップロードできます。</p>
   <button type="submit" class="file-btn">送信</button>
   <input type="hidden" name="MAX_FILE_SIZE" value="1048576">
   <input type="hidden" name="token" value="<?php echo Utils::h($_SESSION['token']); ?>">
</form>
   <?php if($filesize_errors):?>
      <?php foreach ($filesize_errors as $filesize_error): ?>
         <p class="error-log"><?php echo Utils::h($filesize_error);?></p>
      <?php endforeach;?>
   <?endif;?>
   <?php if($comment_errors):?>
      <?php foreach ($comment_errors as $comment_error): ?>
         <p class="error-log"><?php echo Utils::h($comment_error);?></p>
      <?php endforeach;?>
   <?endif;?>
<a href="index.php"><button class="return-btn">戻る</button></a>

<ul>
   <?php
      $counter = 0;
      foreach ($filelists as $filelist): ?> 
      <li>
         <img src="<?php echo Utils::h($filelist['file_path']); ?>" alt="">
         <p><?php echo Utils::h($filelist['comment']); ?></p>
         <p class="filedelete-btn" data-id="<?php echo Utils::h($filelist['id']); ?>">
         <button class="postdlt-btn">削除</button></p>
      </li>
      <?php
      if ($counter >= 4) {break;} 
      $counter++;
      endforeach; ?>
</ul>

<script>
  
   const filebtns = document.querySelectorAll('.filedelete-btn');
   filebtns.forEach(filebtn => {
      filebtn.addEventListener('click', () => {
         if (!confirm('削除しますか?')) {
            return;
         }
      fetch('./filedelete.php', {
         method: 'POST',
         body: new URLSearchParams({
         id: filebtn.dataset.id,
      }),
      }).then(response => {
         return response.json();
      }).then(json => {
         console.log(json);
      })
      .catch(error => {
         console.log("画像削除に失敗しました");
      })
      filebtn.parentNode.remove();
      });
   });

</script>
</body>
</html>
