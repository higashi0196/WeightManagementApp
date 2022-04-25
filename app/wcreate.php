<?php

require_once('config.php');

try {
   $query = "INSERT INTO `todos` (`title`, `content`, `created_at`, `updated_at`) VALUES ('%s', '%s', NOW(), NOW())";

   $pdo = new PDO(DSN, USER, PASSWORD);
   $result = $pdo->query($query);
} catch(Exception $e) {
   // エラーログ
}
   return $result;

?>

<!DOCTYPE html>
<html lang="ja">
<head> 
   <meta charset="utf-8">
   <title>新規登録</title>
   <link rel="stylesheet" href="./css/styles.css">
</head>
<body>
   <form method="POST" action="./wcreate.php">
      <dl>
         <dt class="kohama">明日へ一言</dt>
         <dd>
            <textarea name="content" cols="60" rows="3"></textarea>
         </dd>
      </dl>
      <button type="submit" name="button">登録する</button>
      <!-- <input type="submit" class="shinki-btn" value="登録"> -->
      <a href="index.php">戻る</a>
   </form>
</body>
</html>