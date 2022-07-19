<?php

require_once('config.php');

session_start();
$token = new Token();
$token->create();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $getller = new Todocontroller();
   $getller->update();
   exit;
}

$getller = new Todocontroller();
$data =  $getller->edit();
$lists = $getller->index();
$todo = $data['todo'];
$params = $data['params'];

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
   <title>編集画面</title>
   <link rel="stylesheet" href="./css/styles.css">
</head>
<body>
   <p class="outline">編集画面</p>

   <?php if($token_errors):?>
      <?php foreach ($token_errors as $token_error): ?>
         <p class="error-log"><?php echo Utils::h($token_error);?></p>
      <?php endforeach;?>
   <?php endif;?>

   <form method="POST" action="./edit.php">
      <div>
         <p class="title">タイトル</p>
         <input type="text" name="title" class="titleinput" value="<?php if(isset($params['title'])):?><?php echo Utils::h($params['title']);?><?php else:?><?php echo Utils::h($todo['title']);?><?php endif;?>">
         <?php if($title_errors):?>
            <?php foreach ($title_errors as $title_error): ?>
               <p class="error-log"><?php echo Utils::h($title_error);?></p>
            <?php endforeach;?>
         <?endif;?>
      </div>

      <div>
         <p class="title">目標</p>
         <input type="text" name="content" class="titleinput" value="<?php if(isset($params['content'])):?><?php echo Utils::h($params['content']);?><?php else:?><?php echo Utils::h($todo['content']);?><?php endif;?>">
         <?php if($content_errors):?>
            <?php foreach ($content_errors as $content_error): ?>
               <p class="error-log"><?php echo Utils::h($content_error);?></p>
            <?php endforeach;?>
         <?endif;?>
      </div>
      <input type="hidden" name="id" value="<?php echo Utils::h($todo['id']);?>">
      <input type="hidden" name="token" value="<?php echo Utils::h($_SESSION['token']); ?>">
      <button type="submit" class="register-btn">更新</button>
   </form>

   <a href="index.php"><button class="return-btn">戻る</button></a>

</body>
</html>