<?php

require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $getller = new Todocontroller();
   $getller->dietcreate();
   exit;
}

$getller = new Todocontroller();
$goallists = $getller->index4();

if($_SERVER['REQUEST_METHOD'] === 'GET') {

   if(isset($_GET['body'])) {
      $weightparam['body'] = $_GET['body'];
   }

   if(isset($_GET['weight'])) {
      $weightparam['weight'] = $_GET['weight'];
   }

   if(isset($_GET['today'])) {
      $weightparam['today'] = $_GET['today'];
   }
}

session_start();
$weighttoday_errors = $_SESSION['weighttoday_errors'];
unset($_SESSION['weighttoday_errors']);
$weight_errors = $_SESSION['weight_errors'];
unset($_SESSION['weight_errors']);
$body_errors = $_SESSION['body_errors'];
unset($_SESSION['body_errors']);
$today_errors = $_SESSION['today_errors'];
unset($_SESSION['today_errors']);

?>

<!DOCTYPE html>
<html lang="ja">
<head> 
   <meta charset="utf-8">
   <title>新規登録</title>
   <link rel="stylesheet" href="./css/styles.css">
</head>
<body class="miyako">
   <a>体重記録</a>
   
   <form method="POST" action="./weight.php">
      <p>目標体重 : <input type="text" name="body" value="<?php if(isset($weightparam['body'])):?><?php echo $weightparam['body'];?><?php else:?><?php echo $goallists['goalweights'];?><?php endif;?>"> kg</p>

      <?php if($body_errors):?>
         <?php foreach ($body_errors as $body_error): ?>
            <p><?php echo $body_error;?></p>
         <?php endforeach;?>
      <?endif;?>
      
      <p>現在の体重 : <input type="text" name="weight" value="<?php echo $weightparam['weight']; ?>"> kg</p>

      <?php if($weight_errors):?>
         <?php foreach ($weight_errors as $weight_error): ?>
            <p><?php echo $weight_error;?></p>
         <?php endforeach;?>
      <?endif;?>

      <p>日付 : <input type="date" name="today" value="<?php echo $weightparam['today']; ?>"></p>
      <?php if($today_errors):?>
         <?php foreach ($today_errors as $today_error): ?>
            <p><?php echo $today_error;?></p>
         <?php endforeach;?>
      <?endif;?>

      <?php if($weighttoday_errors):?>
         <?php foreach ($weighttoday_errors as $weighttoday_error): ?>
            <p><?php echo $weighttoday_error;?></p>
         <?php endforeach;?>
      <?endif;?>

      <button type="submit">記入</button>
   </form>
   <a href="index.php"><button>戻る</button></a>
</body>
</html>