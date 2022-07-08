<?php

require_once('config.php');

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

session_start();
$title_errors = $_SESSION['title_errors'];
unset($_SESSION['title_errors']);
$content_errors = $_SESSION['content_errors'];
unset($_SESSION['content_errors']);
$all_errors = $_SESSION['all_errors'];
unset($_SESSION['all_errors']);

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
   <?php if($all_errors):?>
      <?php foreach ($all_errors as $all_error): ?>
         <p class="error-log"><?php echo $all_error;?></p>
      <?php endforeach;?>
   <?endif;?>

   <form method="POST" action="./create.php">
      <div>
         <p class="title">タイトル</p>
         <?php if($title_errors):?>
            <?php foreach ($title_errors as $title_error): ?>
               <p class="error-log"><?php echo $title_error;?></p>
            <?php endforeach;?>
         <?endif;?>
         
         <input type="text" name="title" class="titleinput" value="<?php echo $title;?>">
      </div>
      
      <div>
         <p class="title">目標</p>
         <?php if($content_errors):?>
            <?php foreach ($content_errors as $content_error): ?>
               <p class="error-log"><?php echo $content_error;?></p>
            <?php endforeach;?>
         <?endif;?>
         <input type="text" name="content" class="titleinput" value="<?php echo $content;?>">
      </div>
         <button type="submit" class="register-btn">登録</button>
      </form>
      
      <a href="index.php"><button class="return-btn">戻る</button></a>
   
</body>
</html>