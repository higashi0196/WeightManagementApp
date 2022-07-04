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
   <title>新規登録</title>
   <link rel="stylesheet" href="./css/styles.css">
</head>
<body class="all">
   <p class="outline">新規登録</p>
   <form method="POST" action="./create.php">
      <div>
         <p class="title">タイトル</p>
         <input type="text" name="title" value="<?php echo $title;?>">
      </div>
      <?php if($title_errors):?>
         <?php foreach ($title_errors as $title_error): ?>
            <p><?php echo $title_error;?></p>
         <?php endforeach;?>
      <?endif;?>
      
      <div>
         <p class="inside">目標</p>
         <?php if($content_errors):?>
            <?php foreach ($content_errors as $content_error): ?>
               <p><?php echo $content_error;?></p>
            <?php endforeach;?>
         <?endif;?>
         <textarea name="content"><?php echo $content;?></textarea>
      </div>  
      <button type="submit">登録</button>
   </form>
   <a href="index.php"><button>戻る</button></a>
   <?php if($all_errors):?>
      <?php foreach ($all_errors as $all_error): ?>
         <p><?php echo $all_error;?></p>
      <?php endforeach;?>
   <?endif;?>
</body>
</html>