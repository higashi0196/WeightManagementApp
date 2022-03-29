<?php

require_once('functions.php');

$pdo = pdo_connect();

$lists = takelists($pdo);

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
                        <td><? echo $todo->title; ?></td>
                        <td><? echo $todo->content; ?></td>
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