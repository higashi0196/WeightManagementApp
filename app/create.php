<?php

require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $getller = new Todocontroller();
   $getller->create();
   exit;
   // header('Location: ' . SITE_URL);
}

$title = '';
$content = '';
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
   <title>新規登録</title>
   <link rel="stylesheet" href="./css/styles.css">
</head>
<body class="miyako">
   <p>新規登録</p>
   <form method="POST" action="./create.php">
      <div>
         <p>タイトル</p>
         <?php if($title_errors):?>
            <?php foreach ($title_errors as $title_error): ?>
               <p><?php echo $title_error;?></p>
            <?php endforeach;?>
            <?endif;?>
         <input type="text" name="title">
      </div>
      <div>
         <p>目標</p>
         <?php if($content_errors):?>
            <?php foreach ($content_errors as $content_error): ?>
               <p><?php echo $content_error;?></p>
            <?php endforeach;?>
         <?endif;?>
         <textarea name="content"></textarea>
      </div>  
      <button type="submit">登録</button>
   </form>
   <?php if($all_errors):?>
      <?php foreach ($all_errors as $all_error): ?>
         <p><?php echo $all_error;?></p>
      <?php endforeach;?>
   <?endif;?>
   <a href="index.php"><button>戻る</button></a>
</body>
</html>