<?php
define('DSN', 'mysql:host=db;dbname=todoapp;charset=utf8mb4');
define('DB_USER', 'root');
define('DB_PASS', 'Nakanaka3535!');
define('DB_DATABASE', 'todoapp');

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

$stmt = $pdo->query("SELECT * FROM todos ORDER BY id DESC");
$lists = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="ja">
<head> 
   <meta charset="utf-8">
   <title>体重管理アプリ</title>
   <link rel="stylesheet" href="css/styles.css">
</head>
<body>
   <header>
      <h1>目標体重</h1>
      <p>a</p>
   </header>
   <main>
      <h2>今日のToDoリスト</h2>
         <ul>
            <?php foreach ($lists as $todo): ?>
            <li>
               <input type="checkbox">
            </li>
            <?php endforeach; ?>
               
         </ul>
      <h2>継続するToDoリスト</h2>
      <h2>明日への一言</h2>
   </main>
</body>
</html> 