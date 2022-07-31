<?php

require_once('config.php');

session_start();
$token = new Token();
$token->create();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $getller = new Todocontroller();
   $getller->create();
   exit;
}

if($_SERVER['REQUEST_METHOD'] === 'GET') {

   if(isset($_GET['title'])) {
      $title = $_GET['title'];
   }

   if(isset($_GET['content'])) {
      $content = $_GET['content'];
   }
}

$token_errors = $_SESSION['token_errors'];
unset($_SESSION['token_errors']);
$title_errors = $_SESSION['title_errors'];
unset($_SESSION['title_errors']);
$content_errors = $_SESSION['content_errors'];
unset($_SESSION['content_errors']);

?>

<!DOCTYPE html>
<html lang="ja">
<head> 
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>新規登録</title>
   <link rel="stylesheet" href="./css/styles.css">
</head>
<body>
   <p class="outline">新規登録</p>

   <form method="POST" action="./create.php">

      <?php if($token_errors):?>
         <?php foreach ($token_errors as $token_error): ?>
            <p class="error-log"><?php echo Utils::h($token_error);?></p>
         <?php endforeach;?>
      <?endif;?>

      <div>
         <p class="title">タイトル</p>
         <input type="text" name="title" class="titleinput" value="<?php echo Utils::h($title);?>">
         <?php if($title_errors):?>
            <?php foreach ($title_errors as $title_error): ?>
               <p class="error-log"><?php echo Utils::h($title_error);?></p>
            <?php endforeach;?>
         <?endif;?>
      </div>
      
      <div>
         <p class="title">目標</p>
         <input type="text" name="content" class="titleinput" value="<?php echo Utils::h($content);?>">
         <?php if($content_errors):?>
            <?php foreach ($content_errors as $content_error): ?>
               <p class="error-log"><?php echo Utils::h($content_error);?></p>
            <?php endforeach;?>
         <?endif;?>
      </div>
      <button type="submit" class="register-btn">登録</button>
      <input type="hidden" name="token" value="<?php echo Utils::h($_SESSION['token']); ?>">
   </form>
      
   <a href="index.php"><button class="return-btn">戻る</button></a>
</body>
</html>