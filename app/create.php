<?php

require_once('config.php');
// require_once('config.php');

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
$title_msgs = $_SESSION['title_msgs'];
unset($_SESSION['title_msgs']);
$content_msgs = $_SESSION['content_msgs'];
unset($_SESSION['content_msgs']);
$all_msgs = $_SESSION['all_msgs'];
unset($_SESSION['all_msgs']);
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
         <?php if($title_msgs):?>
            <?php foreach ($title_msgs as $title_msg): ?>
               <p><?php echo $title_msg;?></p>
            <?php endforeach;?>
            <?endif;?>
         <input type="text" name="title">
      </div>
      <div>
         <p>目標</p>
         <?php if($content_msgs):?>
            <?php foreach ($content_msgs as $content_msg): ?>
               <p><?php echo $content_msg;?></p>
            <?php endforeach;?>
         <?endif;?>
         <textarea name="content"></textarea>
      </div>  
      <button type="submit">登録</button>
   </form>
   <?php if($all_msgs):?>
      <?php foreach ($all_msgs as $all_msg): ?>
         <p><?php echo $all_msg;?></p>
      <?php endforeach;?>
   <?endif;?>
   <a href="index.php"><button>戻る</button></a>
</body>
</html>