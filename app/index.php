<?php

// require_once('functions.php');
// require_once('config.php');

$dsn = 'mysql:host=mysql;dbname=todolists;charset=utf8mb4';
$user = 'root';
$password = 'Nanahigashi10!';

$pdo = new PDO($dsn, $user, $password);
$stmt = $pdo->query("SELECT * FROM todos ORDER BY id DESC");

$lists = $stmt->fetchAll(PDO::FETCH_ASSOC);
// var_dump($lists);

// $pdo = pdo_connect();
// $lists = takelists($pdo);

// return $lists;
?>

<!DOCTYPE html>
<html lang="ja">
<head> 
   <meta charset="utf-8">
   <title>体重管理アプリ</title>
   <link rel="stylesheet" href="./css/styles.css">
</head>
<body>
   <main>
      <header>
         <h1>目標体重</h1>
      </header>
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
                           <td><? echo $todo['title']; ?></td>
                           <td><? echo $todo['content']; ?></td>
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
