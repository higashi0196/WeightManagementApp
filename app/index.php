<?php

require_once('config.php');

$pdo = Database::get();
$getller = new Todocontroller();
$lists = $getller->index();
// $todo = $$getller->edit();

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
      <div>
         <a class="miyako">今日のToDoリスト</a>
         <a action="./create.php" method="POST"></a>
         <a href="create.php" class="ishigaki">新規登録</a>  
      </div>
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
                        <td><?php echo $todo['title']; ?></td>
                        <td><?php echo $todo['content']; ?></td>
                        <td><a href="edit.php?todo_id=<?php echo $todo['id']?>" class="editbtn">編集</a></td>
                        <td><a href="" class="deletebtn">削除</a></td>
                     </tr>
                  <?php endforeach; ?>
               <?php else : ?>
                  <td>Todoなし</td>
               <?php endif; ?>
            </tbody>
         </table>
      <a class="miyako">継続するToDoリスト</a>
      <h2>明日への一言</h2>
   </main>
</body>
</html> 
