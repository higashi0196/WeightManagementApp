<?php

require_once('./../../controller/controller.php');

session_start();
$token = new Token();
$token->create();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $filecontroller = new Filecontroller();
   $filecontroller->picturecreate();
   exit;
}

$filecontroller = new Filecontroller();
$filelists = $filecontroller->files();

if($_SERVER['REQUEST_METHOD'] === 'GET') {
   if(isset($_GET['comment'])) {
      $comment = $_GET['comment'];
   }
}

$token_errors = $_SESSION['token_errors'];
unset($_SESSION['token_errors']);
$filesize_errors = $_SESSION['filesize_errors'];
unset($_SESSION['filesize_errors']);
$comment_errors = $_SESSION['comment_errors'];
unset($_SESSION['comment_errors']);
$filemodel_errors = $_SESSION['filemodel_errors'];
unset($_SESSION['filemodel_errors']);
$file_errors = $_SESSION['file_errors'];
unset($_SESSION['file_errors']);

?>

<!DOCTYPE html>
<html lang="ja">
<head> 
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>画像アップロード</title>
   <link rel="stylesheet" href="./../../css/styles.css">
</head>
<body>
<p class="outline">画像アップロード</p>

<?php if($token_errors):?> 
   <?php foreach ($token_errors as $token_error): ?>
      <p class="error-log"><?php echo Utils::h($token_error);?></p>
   <?php endforeach;?>
<?endif;?>

<form action="./file.php" method="POST" enctype="multipart/form-data">
   <input type="file" name="img" class="fileinput">

   <?php if($file_errors):?>
      <?php foreach ($file_errors as $file_error): ?>
         <p class="error-log"><?php echo Utils::h($file_error);?></p>
      <?php endforeach;?>
   <?endif;?>

   <?php if($filemodel_errors):?>
      <?php foreach ($filemodel_errors as $filemodel_error): ?>
         <p class="error-log"><?php echo Utils::h($filemodel_error);?></p>
      <?php endforeach;?>
   <?endif;?>

   <?php if($filesize_errors):?>
      <?php foreach ($filesize_errors as $filesize_error): ?>
         <p class="error-log"><?php echo Utils::h($filesize_error);?></p>
      <?php endforeach;?>
   <?endif;?>

   <div>
      <p class="memo">☆ 一言メモ ☆</p>
      <textarea name="comment" class="comment"><?php echo Utils::h($comment);?></textarea>
   </div>

   <?php if($comment_errors):?>
      <?php foreach ($comment_errors as $comment_error): ?>
         <p class="error-log"><?php echo Utils::h($comment_error);?></p>
      <?php endforeach;?>
   <?endif;?>

   <!-- <p class="number">※画像は5件までアップロードできます。</p> -->
   <button type="submit" class="file-btn">アップロード</button>
   <input type="hidden" name="MAX_FILE_SIZE" value="1048576">
   <input type="hidden" name="token" value="<?php echo Utils::h($_SESSION['token']); ?>">
</form>

<a href="./../todo/index.php"><button class="return-btn">戻る</button></a>

<ol>
   <?php foreach ($filelists as $filelist): ?> 
      <li data-token="<?= Utils::h($_SESSION['token']); ?>">
         <img src="<?php echo Utils::h($filelist['file_path']); ?>" alt="">
         <div>
            <p class="list-memo"> 〜〜  一言メモ 〜〜 </p>
            <p class="list-comment"><?php echo Utils::h($filelist['comment']); ?></p>
            <button class="filedelete-btn" data-id="<?php echo Utils::h($filelist['id']); ?>" >削除</button>
         </div>
      </li>
   <?php endforeach; ?>
</ol>

<script type="text/javascript" src="./../../js/file.js"></script>
</body>
</html>