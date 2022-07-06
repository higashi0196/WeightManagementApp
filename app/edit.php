<?php

require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $getller = new Todocontroller();
   $getller->update();
   exit;
}

$getller = new Todocontroller();
$data =  $getller->edit();
// $bodylists = $getller->index3();
$lists = $getller->index();
$todo = $data['todo'];
$params = $data['params'];

session_start();
$all_errors = $_SESSION['all_errors'];
unset($_SESSION['all_errors']);
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
   <?php if($all_errors):?>
      <?php foreach ($all_errors as $all_error): ?>
         <p class="error-log"><?php echo $all_error;?></p>
      <?php endforeach;?>
   <?endif;?>

   <form method="POST" action="./edit.php">
      <div>
         <p class="title">タイトル</p>
         <?php if($title_errors):?>
            <?php foreach ($title_errors as $title_error): ?>
               <p class="error-log"><?php echo $title_error;?></p>
            <?php endforeach;?>
         <?endif;?>
         <input type="text" name="title" class="titleinput" value="<?php if(isset($params['title'])):?><?php echo $params['title'];?><?php else:?><?php echo $todo['title'];?><?php endif;?>">
      </div>

      <div>
         <p class="title">目標</p>
         <?php if($content_errors):?>
            <?php foreach ($content_errors as $content_error): ?>
               <p class="error-log"><?php echo $content_error;?></p>
            <?php endforeach;?>
         <?endif;?>
         <input type="text" name="content" class="titleinput" value="<?php if(isset($params['content'])):?><?php echo $params['content'];?><?php else:?><?php echo $todo['content'];?><?php endif;?>">
      </div>
      <input type="hidden" name="id" value="<?php echo $todo['id']; ?>">
      <button type="submit" class="register-btn">更新</button>
   </form>

   <a href="index.php"><button class="return-btn">戻る</button></a>

</body>
</html>