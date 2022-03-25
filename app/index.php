<?php
define('DB_DATABASE', 'todoapp');
define('DB_USER', 'root');
define('DB_PASS', 'Nakanaka3535!');
define('DSN', 'mysql:host=db;dbname=todoapp;charset=utf8mb4');

try {
   $pdo = new PDO(
     DSN,
     DB_USER,
     DB_PASS
   );
   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
      echo $e->getMessage();
      exit;
}
?>

<!DOCTYPE html>
<html lang="ja">
   <head> 
      <meta charset="utf-8">
      <title>体重管理アプリ</title>
      <h1>目標体重</h1>
   </head>
   <body>
      <h2>今日のToDoリスト</h2>
      <h2>継続するToDoリスト</h2>
      <h2>明日への一言</h2>
   </body>
</html> 