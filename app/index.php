<?php

require_once('config.php');

$pdo = Database::get();
$getller = new Todocontroller();
$lists = $getller->index();

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
               <?php if ($lists): ?>
                  <?php foreach ($lists as $todo): ?>
                     <tr>
                        <!-- <td><input type="checkbox"></td> -->
                        <td><?php echo $todo['title']; ?></td>
                        <td><?php echo $todo['content']; ?></td>
                        <td><a href="edit.php?todo_id=<?php echo $todo['id']?>" class="editbtn">編集</a></td>

                        <td><button id="btn1" todo_id=<?php echo $todo['id'];?>>削除</button></td>

                        <!-- <td><button id="btn2" class="delete-btn">Click</button></td> -->
                        <td><input type="submit" id="btn2" class="delet" value="Click"></td>

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
   <script src="./js/main.js"></script>
   <script>
      const button1 = document.getElementById("btn1");
      button1.addEventListener("click", () => {
      console.log("クリックされました");
      });

      const button2 = document.getElementById("btn2");
      button2.addEventListener("click", event => {
         console.log("クリックされました");
      });

   </script>
</body>
</html> 
