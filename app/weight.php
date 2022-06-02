<?php

require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $getller = new Todocontroller();
   $getller->dietcreate();
   exit;
   // header('Location: ' . SITE_URL);
}

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

$getller = new Todocontroller();
$bodylists = $getller->index3();

?>

<!DOCTYPE html>
<html lang="ja">
<head> 
   <meta charset="utf-8">
   <title>新規登録</title>
   <link rel="stylesheet" href="./css/styles.css">
</head>
<body>
   <a class="new-create">体重記録</a>
   <form method="POST" action="./weight.php" class="miyako">
      <?php foreach ($bodylists as $bodylist): ?>
         <p>目標体重 : <input type="text" name="body" value=" <?php echo $bodylist['goalweights']; ?>"> kg</p>
      <?php endforeach; ?>
         <p>現在の体重 : <input type="text" name="weight"> kg</p>
         <p>日付 : <input type="date" name="today"></p>
   
      <div style="padding-top:5px">
         <button type="submit">記入</button>
         <a href="index.php">戻る</a>
      </div>
   </form>
</body>
</html>