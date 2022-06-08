<?php

require_once('config.php');
// require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $getller = new Todocontroller();
   $getller->create();
   exit;
   // header('Location: ' . SITE_URL);
}

// $title = '';
// $content = '';
if($_SERVER['REQUEST_METHOD'] === 'GET') {

   if(isset($_GET['title'])) {
      $title = $_GET['title'];
   }

   if(isset($_GET['content'])) {
      $content = $_GET['content'];
   }
}


// session_start();
// $_SESSION['error_sign'] = $error_sign;
// unset($_SESSION['error_sign']);

?>

<!DOCTYPE html>
<html lang="ja">
<head> 
   <meta charset="utf-8">
   <title>新規登録</title>
   <link rel="stylesheet" href="./css/styles.css">
</head>
<body class="miyako">
   <a class="new-create">新規登録</a>
   <form method="POST" action="./create.php">
      <div>
         <div>
            <p>タイトル</p>
            <input type="text" name="title">
            <!-- <?php if ($error['title'] = 'blank'):?>
            <p class='error'>タイトルが空です</p>
            <?php endif; ?> -->
         </div>
         <div>
            <p>目標</p>
            <textarea name="content"></textarea>
            <!-- <?php if ($error_sign['content'] = 'blank'):?>
            <p class='error'>目標が空です</p>
            <?php endif; ?> -->
         </div>
         <button type="submit" class="shinki-btn">登録</button>
      </div>
   </form>
   <a href="index.php"><button>戻る</button></a>
   <!-- <?php if($error_sign):?>
        <div>
                <?php foreach ($error_sign as $error_signs): ?>
                    <p><?php echo $error_signs;?></p>
                <?php endforeach;?>
        </div>
    <?endif;?> -->
</body>
</html>