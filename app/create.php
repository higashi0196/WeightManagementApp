<?php

if ($SEV['REQUEST_METHOD'] === 'post') {
   echo 'HELLO';
   exit;
}

?>

<!DOCTYPE html>
<html lang="ja">
<head> 
   <meta charset="utf-8">
   <title>新規登録</title>
   <link rel="stylesheet" href="./css/styles.css">
</head>
<body>
   <a class="new-create">新規登録</a>
   <form method="post" action="index.php">
      <div>
         <div>タイトル</div>
         <input type="text" name="title"></input>
      </div>
      <div>
         <div>目標</div>
         <textarea name="content"></textarea>
      </div>
         <button type="submit" class="shinki-btn">登録</button>
         <input type="submit" class="rtn-btn" name="submit" value="戻る">
   </form>
</body>
</html>