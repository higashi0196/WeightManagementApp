<?php

require_once('config.php');

$pdo = Database::get();
$getller = new Todocontroller();
$lists = $getller->index();
$wordlists = $getller->index2();

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
      <h1>目標体重</h1>
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
                     
                     <!-- jquery用 -->
                     <td><div class="delete-btn" data-id=<?php echo $todo['id']; ?>>
                     <button >jquery</button></div></td>
                     <!-- jquery用おわり -->

                        <!-- javascript用 -->
                     <td><div class="btn5"  data-id=<?php echo $todo['id']; ?>><button>javascript</button></div></td>
                     <!-- javascript用 おわり-->

                  </tr>
               <?php endforeach; ?>
            <?php else : ?>
               <td>Todoなし</td>
            <?php endif; ?>
         </tbody>
      </table>

      <!-- <a class="miyako">継続するToDoリスト</a> -->

      <a class="miyako">明日への一言</a>
      <a href="post.php" class="ishigaki">投稿画面</a>  

   </main>

   <!-- <script src="./js/main.js"></script> -->
   <script src="./js/jquery-3.6.0.min.js"></script>
   <script>

   const btn5 = document.querySelectorAll('.btn5');
   for (let i = 0; i < btn5.length; i++) 
   btn5[i].addEventListener('click', () => {
      let todo_id = $(btn5).data('id');
      if (!confirm('本当に削除する？ id:' + todo_id)) {
         btn5.disabled = false;
         return;
      }
      let data = {};
      data.todo_id = todo_id;
      XMLRequestDefaultHandler = function() {
      var xml = new xmlRequest();
      xml.open("POST", "http://localhost:8000/delete.php", true);
      xml.onreadystatechange = function() {
         if (xml.readyState === 4 || xml.status === 200) {
            console.log("通信中！");
         } else {
            console.log("通信失敗");
         }
      };
         xml.open('POST', './delete.php',"data", true);
         xml.send("data");
      }
         console.log("通信完了");
   });

   $(".delete-btn").click(function () {
      let todo_id = $(this).data('id');
      if (confirm("削除しますがよろしいですか？ id:" + todo_id)) {
         $(".delete-btn").prop("disabled", true);
         let data = {};
         data.todo_id = todo_id;
         $.ajax({
            url: './delete.php',
            type: 'post',
            data: data
         }).then(
            function (data) {
               let json = JSON.parse(data);
               console.log("success", json);
               if (json.result == 'success') {
                  window.location.href = "./index.php";
               } else {
                  console.log("failed to delete.");
                  alert("failed to delete.");
                  $(".delete-btn").prop("disabled", false);
               }
               },
               function () {
                  console.log("fail");
                  alert("fail");
                  $(".delete-btn").prop("disabled", false);
                }
            );
        }
    });
   </script>
</body>
</html> 
