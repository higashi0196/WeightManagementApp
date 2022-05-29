<?php

require_once('config.php');

$pdo = Database::get();
$getller = new Todocontroller();
$lists = $getller->index();
$wordlists = $getller->index2();
$bodylists = $getller->index3();
// $completes = $getller->completestatus();
// $json = json_encode($employeeData);
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

      <h1>体重管理リスト</h1>

      <div class="miyako">
         <a action="./weight.php" method="POST"></a>
         <a href="weight.php" class="ishigaki">体重記入</a>
      </div>
   
      <?php foreach ($bodylists as $bodylist): ?>
         <span style="margin-left:30px" >目標体重 : 
         <input type="text" value=" <?php echo $bodylist['goalweights']; ?>"> kg</span></br>
         <span style="margin-left:30px"> 現在の体重 : 
         <?php echo $bodylist['nowweights']; ?> kg</span><br>
         <!-- <span style="margin-left:30px"> 現在の体重 : 
         <input type="text" value=" <?php echo $bodylist['nowweights']; ?>"> kg</span><br> -->
         <span style="margin:0 0 0 30px">目標達成まであと
         <?php echo $bodylist['difference']; ?>
         kg</span><br>
         <span style="margin:0 0 0 30px">(<?php echo $bodylist['nowdate']; ?> 現在)</span>
      <?php endforeach; ?>

      <div>
         <a class="miyako">ToDoリスト</a>
         <a action="./create.php" method="POST"></a>
         <a href="create.php" class="ishigaki">新規登録</a>  
      </div>

      <table>
         <thead>
            <tr>
               <th scope="col"></th>
               <th scope="col">タイトル</th>
               <th scope="col">目標</th>
               <th scope="col"></th>
               <th scope="col"></th>
            </tr>
         </thead>
         <tbody>
            <?php if ($lists): ?>
               <?php foreach ($lists as $todo): ?>
                  <tr>
                     <!-- <td><input type="checkbox" class="todo-checkbox" data-id="<?php echo $todo['id']; ?> " <?php if($todo['status']):?>checked<?php endif;?>></td>
                     <td><?php echo $todo['title']; ?></td>
                     <td><?php echo $todo['content']; ?></td> -->

                     <td><input type="checkbox" id="done"></td>
                     <td id="aaa"><?php echo $todo['title']; ?></td>
                     <td id="bbb"><?php echo $todo['content']; ?></td> 

                     <td><a href="edit.php?todo_id=<?php echo $todo['id']?>" class="editbtn">編集</a></td>
                     <!-- jquery用 -->
                     <td><div class="delete-btn" data-id="<?php echo $todo['id']; ?>">
                     <button>jquery</button></div></td>
                     <!-- jquery用おわり -->

                     <!-- javascript用 -->
                     <td><div class="btn5"  data-id="<?php echo $todo['id']; ?>"><button>javascript</button></div></td>
                     <!-- javascript用 おわり-->

               <?php endforeach; ?>
            <?php else : ?>
               <td>Todoなし</td>
            <?php endif; ?>
         </tbody>
      </table>
      
      <div>
         <a class="miyako">明日への一言</a>
         <a href="post.php" class="ishigaki"><button>投稿する</button></a>
      </div>
      
      <?php if ($wordlists): ?>
         <?php foreach ($wordlists as $wordtodo): ?>
            <textarea cols="50" rows="2" style="margin-left:30px">
   <?php echo $wordtodo['content']; ?>
            </textarea>      
         <?php endforeach; ?>
      <?php else : ?>
         <textarea cols="50" rows="2" style="margin-left:30px">
   <?php echo 'todoなし' ?>
         </textarea> 
       <?php endif; ?>     
         <div class="aaa" data-id=<?php echo $wordtodo['id']; ?>>
         <button style="margin-left:30px">削除</button></div>
         
      <div id="finish" class="modal_overlay">
         <div class="modal">
            <p>good job! 見事達成!</p>
         </div>
         <span class="modalclose">x</span>
      </div>
         
   </main>

   <!-- <script src="./js/main.js"></script> -->
   <script src="./js/jquery-3.6.0.min.js"></script>
   <script>
      
      const finish = document.getElementById('finish');
      const modalclose = document.getElementsByClassName('modalclose')[0];
      const goal = <?php echo $bodylist['difference']; ?>;
      const goal2 = <?php echo $bodylist['nowweights']; ?> ;
     
      if (goal <= 0) {
      finish.style.display = 'block';
      console.log("0kg以下,達成");
      console.log(goal2);
      } else if (goal <= 0.5) {
         console.log("0〜0.5kgの間、もう少し");
      } else {
         console.log("0.5kg以上、まだまだ");
      } 
      
      modalclose.addEventListener('click', () => {
         finish.style.display = 'none';
         console.log("xクリック");
      });

      addEventListener('click', (e) => {
         if (e.target == finish) {
         finish.style.display = 'none';
         console.log("x以外クリック");
         }
      });
      
      const btn5 = document.querySelectorAll('.btn5');
      for (let i = 0; i < btn5.length; i++) {
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
      }

      $(".aaa").click(function () {
      let todo_id = $(this).data('id');
      if (confirm("本当に削除する？ id:" + todo_id)) {
         $(".aaa").prop("disabled", true);
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
                  $(".aaa").prop("disabled", false);
               }
               },
               function () {
                  console.log("fail");
                  alert("fail");
                  $(".aaa").prop("disabled", false);
                }
            );
        }
      //   location.reload();
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

   // const done = document.querySelectorAll("input[type='checkbox']");
   //    const aaa = document.getElementById("aaa");
   //    const bbb = document.getElementById("bbb");

   //    for (let i = 0; i < done.length; i++) {
   //       done[i].addEventListener('change', () => {
   //       aaa.classList.toggle('my-color');
   //       bbb.classList.toggle('my-color');
   //       });
   //    }
   // const aaa = document.querySelectorAll('td')[1]
   // const bbb = document.querySelectorAll('td')[2]
   // const aaa = document.getElementsByTagName('td')[1]
   // const bbb = document.getElementsByTagName('td')[2]

      // const aaa = document.getElementById('.aaa');
      // aaa.addEventListener('click', () => {
         
      // });

      // const btn5 = document.querySelectorAll('.btn5');
      // btn5.forEach(span => {
      //    span.addEventListener('click', () => {
      //       let todo_id = $(btn5).data('id');
      //       if (!confirm('本当に削除する？ id:' + todo_id)) {
      //          btn5.disabled = false;
      //          return;
      //       }
      //       fetch('index.php', {
      //          method: 'POST',
      //          body: new URLSearchParams({
      //             id: span.dataset.id,
      //          }),
      //       });
      //       span.remove();
      //    });
      // });

   </script>
</body>
</html> 
