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
                        <td><button todo_id=<?php echo $todo['id']; ?> class="btn" >削除</button></td>

                        <!-- 試し用 -->
                        <td><button id="btn2" class="delete-btn">Click2</button></td>
                        <td><button id="btn3" class="delete-btn">Click3</button></td>
                        <!-- 試し用終わり -->
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
   <!-- <script src="./js/main.js"></script> -->
   <script src="./js/jquery-3.6.0.min.js"></script>
   <script>
   // $(".delete-btn").click(function () {
   //      let todo_id = $(this).data('id');
   //      if (confirm("削除しますがよろしいですか？ id:" + todo_id)) {
   //          $(".delete-btn").prop("disabled", true);
   //          let data = {};
   //          data.todo_id = todo_id;
   //          $.ajax({
   //              url: './delete.php',
   //              type: 'post',
   //              data: data
   //          })
   //      }
   //  });

   const btn = document.querySelector(".btn");
   btn.addEventListener("click", function(){
      // let todo_id = $(this).data('id');
      //   if (confirm("削除しますがよろしいですか？ id:" + todo_id)) {
      //       btn.disabled = true;
      //       let data = {};
      //       data.todo_id = todo_id;
      //       $.ajax({
      //           url: './delete.php',
      //           type: 'post',
      //           data: data
      //       })
      //   }
        if (confirm("削除しますがよろしいですか？")) {
         let todo_id = $(this).data('id');
            btn.disabled = true;
            let data = {};
            data.todo_id = todo_id;
            $.ajax({
                url: './delete.php',
                type: 'post',
                data: data
            })
        }
});


   
      // const button1 = document.getElementById("btn1");
      // button1.addEventListener("click", () => {
      //    if (!confirm('本当に削除しますか?')) {
      //   return;
      // }    
      //    console.log("なんでやねん");
      // });

      // const button2 = document.getElementById("btn2");
      // button2.addEventListener("click", () => {
      //    if (!confirm('Are you sure?')) {
      //   return;
      // }
      //    console.log("まっほー");
      // });

      // const button3 = document.getElementById("btn3");
      // button3.addEventListener("click", () => {
      //    console.log("クリックされました");
      // });
      
   </script>
</body>
</html> 
