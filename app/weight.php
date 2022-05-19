<?php

require_once('config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
   $getller = new Todocontroller();
   $getller->dietcreate();
   exit;
   // header('Location: ' . SITE_URL);
}

$getller = new Todocontroller();
$weightdata = $getller->dietget();
$muscle = $weightdata['muscle'];
$weightparam = $weightdata['weightparam'];

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
   <form method="POST" action="./weight.php">
      <div class="miyako">
      <div>
         <p>目標体重 : <input type="text" name="body" value= "<?php echo $muscle['body']; ?>"></p>
      </div>
      <div>
         <p>現在の体重 : <input type="text" name="weight" value="<?php echo $muscle['weight']; ?>"> <input type="date" name="today"></p>
      </div>
      <div style="padding-top:5px">
      <input type="hidden" name="muscle_id" value="<?php echo $muscle['id']; ?>">
      <button type="submit">記入</button>
      <a href="index.php">戻る</a>
      </div>
   </form>

   <p><?php echo $muscle['body']; ?></p>
   <p><?php echo $bodylist['nowdate']; ?></p>
</body>
</html>