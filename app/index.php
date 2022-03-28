<?php

require_once('config.php');

try {
   $pdo = new PDO(DSN, DB_USER, DB_PASS);
   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   // return $pdo;
} catch (PDOException $e) {
   echo $e->getMessage();
   exit;
}

$stmt = $pdo->query("SELECT * FROM todos ORDER BY id DESC");
$lists = $stmt->fetchAll(PDO::FETCH_ASSOC);

// $lists = array();

?>

<!DOCTYPE html>
<html lang="ja">
<head> 
   <meta charset="utf-8">
   <title>体重管理アプリ</title>
   <link rel="stylesheet" href="public/css/styles.css">
</head>
<body>
   <header>
      <h1>目標体重</h1>
   </header>
   <main>
      <h2>今日のToDoリスト</h2>
         <table>
            <thead>
               <tr>
                  <th scope="col">タイトル</th>
                  <th scope="col">目標</th>
               </tr>
            </thead>
            <tbody>
               <?php if($lists): ?>
                  <?php foreach ($lists as $todo): ?>
                     <tr>
                        <!-- <td><input type="checkbox" /></td> -->
                        <td><?php echo $todo['title']?></td>
                        <td><?php echo $todo['content']?></td>
                        <td><a href="" class="editbtn">編集</a></td>
                        <td><a href="" class="deletebtn">削除</a></td>
                     </tr>
                  <?php endforeach; ?>
               <?php else : ?>
                  <td>Todoなし</td>
               <? endif; ?>
            </tbody>
         </table>
      <h2>継続するToDoリスト</h2>
      <h2>明日への一言</h2>
   </main>
</body>
</html> 