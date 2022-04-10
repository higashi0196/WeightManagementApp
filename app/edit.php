<?php

require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $getller = new Todocontroller;
   $getller->edit();
   exit;
}

$getller = new Todocontroller;
$data =  $getller->edit();
$todo = $data['todo'];
$param = $data['param'];

$title = '';
$content = '';
$todo_id = '';


?>

<!DOCTYPE html>
<html lang="ja">
<head> 
   <meta charset="utf-8">
   <title>編集画面</title>
   <link rel="stylesheet" href="./css/styles.css">
</head>
<body>
   <a class="edit-feeld">編集画面</a>
   <form method="POST" action="./index.php">
      <div>
         <p class="taketomi">タイトル</p>
         <input type="text" name="title" value="<?php echo $todo['title']; ?>">
      </div>
      <div>
         <p class="kohama">目標</p>
         <!-- <input name="content" value="<?php echo $todo['content']; ?>"> -->
         <textarea name="content"><?php echo $todo['content']; ?></textarea>
      </div>
         <input type="hidden" name="todo_id" value="<?php echo $todo['id']; ?>">
         <button type="submit" class="edit-btn">更新</button>
         <a href="index.php">戻る</a>
      </div>
   </form>
</body>
</html>