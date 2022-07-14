<?php
require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $getller = new Todocontroller();
   $getller->postcreate();
   exit;
}

if($_SERVER['REQUEST_METHOD'] === 'GET') {
   if(isset($_GET['content'])) {
      $content = $_GET['content'];
   }
}

session_start();
$post_errors = $_SESSION['post_errors'];
unset($_SESSION['post_errors']);

?>

<!DOCTYPE html>
<html lang="ja">
<head> 
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>明日への一言</title>
   <link rel="stylesheet" href="./css/styles.css">
</head>
<body>
   <form method="POST" action="./post.php">
      <div>
         <p class="outline">明日への一言</p>
         <textarea name="postcontent" placeholder="明日への一言を入力できます"></textarea>
      </div>
      <?php if($post_errors):?>
         <?php foreach ($post_errors as $post_error): ?>
            <p class="error-log"><?php echo Utils::h($post_error);?></p>
         <?php endforeach;?>
      <?endif;?>
      <button type="submit" class="post-btn2">投稿する</button>
   </form>

   <a href="index.php"><button class="return-btn">戻る</button></a>
</body>
</html>