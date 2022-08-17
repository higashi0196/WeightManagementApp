<?php

require_once('./../../controller/controller.php');

session_start();
$token = new Token();
$token->create();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $postcontroller = new Postcontroller();
   $postcontroller->postcreate();
   exit;
}

if($_SERVER['REQUEST_METHOD'] === 'GET') {
   if(isset($_GET['content'])) {
      $content = $_GET['content'];
   }
}

$post_errors = $_SESSION['post_errors'];
unset($_SESSION['post_errors']);
$token_errors = $_SESSION['token_errors'];
unset($_SESSION['token_errors']);

?>

<!DOCTYPE html>
<html lang="ja">
<head> 
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>明日への一言</title>
   <link rel="stylesheet" href="./../../css/styles.css">
</head>
<body>
   <form method="POST" action="./post.php">
      <div>
         <p class="outline">一言メッセージ</p>
         <p class="number">メッセージをどうぞ！</p>
         <textarea name="postcontent" placeholder="メッセージをどうぞ"></textarea>
      </div>

      <?php if($post_errors):?>
         <?php foreach ($post_errors as $post_error): ?>
            <p class="error-log"><?php echo Utils::h($post_error);?></p>
         <?php endforeach;?>
      <?endif;?>

      <?php if($token_errors):?>
         <?php foreach ($token_errors as $token_error): ?>
            <p class="error-log"><?php echo Utils::h($token_error);?></p>
         <?php endforeach;?>
      <?endif;?>

      <button type="submit" class="post-btn2">投稿する</button>
      <input type="hidden" name="token" value="<?php echo Utils::h($_SESSION['token']); ?>">
   </form>

   <a href="./../todo/index.php"><button class="return-btn">戻る</button></a>
</body>
</html>