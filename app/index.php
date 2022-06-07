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
         <a href="weight.php" class="ishigaki"><button>体重記入</button></a>
      </div>
   
      <?php foreach ($bodylists as $bodylist): ?>
         <span style="margin-left:30px" >目標体重 : 
         <input type="text" value=" <?php echo $bodylist['goalweights']; ?>"> kg</span></br>
         <span style="margin-left:30px"> 現在の体重 : 
         <input type="text" value=" <?php echo $bodylist['nowweights']; ?>"> kg</span><br>
         <span style="margin:0 0 0 30px">目標達成まであと
         <a id="remaining"><?php echo $bodylist['difference']; ?></a> 
         <a id="unit">kg</a></span><br>
         <span style="margin:0 0 0 30px">(<?php echo $bodylist['nowdate']; ?> 現在)</span><br>
      <?php endforeach; ?>
      
      <div>
         <a class="miyako">ToDoリスト</a>
         <a action="./create.php" method="POST"></a>
         <a href="create.php" class="ishigaki"><button>新規登録</button></a>  
      </div>

      <table>
         <thead>
            <tr>
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
                     <td id="aaa"><?php echo $todo['title']; ?></td>
                     <td id="bbb"><?php echo $todo['content']; ?></td> 

                     <td><a href="edit.php?todo_id=<?php echo $todo['id']?>" class="editbtn"><button>編集</button></a></td>
                     <!-- jquery用 -->
                     <td><div class="delete-done" data-id="<?php echo $todo['id']; ?>">
                     <button>jquery</button></div></td>
                     <!-- jquery用おわり -->

                     <!-- javascript用 -->
                     <td><div id="button"  data-id="<?php echo $todo['id']; ?>"><button>javascript</button></div></td>
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

      <div class="aaa" data-id="<?php echo $wordtodo['id']; ?>">
      <button style="margin-left:30px">削除</button></div>
   </main>

   <!-- <script src="./js/main.js"></script> -->
   <script src="./js/jquery-3.6.0.min.js"></script>
   <script>
      
      const remaining = document.getElementById("remaining");
      const unit = document.getElementById("unit");
      const goal = <?php echo $bodylist['difference']; ?>;
     
      if (goal <= 0 ) {
         remaining.textContent =  goal + ' kg';
         remaining.classList.add('remaining');
         unit.textContent = '見事達成! やったぜ!' ;
         unit.classList.add('unit');
         console.log("0kg以下,達成");
      } else if (goal <= 0.5) {
         remaining.textContent = goal  + ' kg';
         unit.textContent = 'あともう少し頑張ろう!' ;
         unit.classList.add('unit2');
         console.log("0〜0.5kgの間、もう少し");
      } else {
         console.log("0.5kg以上、まだまだ");
      }

      let button = document.getElementById('button');  
      button.addEventListener('click', function() {
         let todo_id = button.dataset.id
         let data = {};
         data.todo_id = todo_id;
         console.log(todo_id);
         fetch('./delete.php', {
         method: 'POST',
         body: JSON.stringify(todo_id),
         headers: { 'Content-Type': 'application/json' },
         })
      });
      
      $(".delete-done").click(function () {
         if(confirm("本当に削除する？")) {
            $(".delete-done").prop("disabled", true);
            let todo_id = $(this).data('id');
            let data = {};
            data.todo_id = todo_id;
            console.log(todo_id);
            $.ajax({
               url: './delete.php',
               type: 'post',
               data: data
            }).then(
               function (data) {
                  let json = JSON.parse(data);
                  console.log("success", json);
                  if(json.result ==  'success') {
                     window.location.href = "./index.php";
                  } else {
                     alert("通信失敗");
                     console.log("通信失敗");
                     $(".delete-btn").prop("disabled", false);
                  }
               },
               function () {
                  console.log("fail");
                  alert("fail");
                  $(".delete-done").prop("disabled", false);
               }
            );
         }
      });

      // let button = document.getElementById('button');  
      // button.addEventListener('click', function() {
      //    let xhr = new XMLHttpRequest();
      //    let todo_id = button.dataset.id
      //    let data = {};
      //    data.todo_id = todo_id;
      //    console.log(todo_id);
      //    xhr.open("POST", "./delete.php", true);
      //    xhr.setRequestHeader("Content-Type", "application/json");
      //    xhr.send(data);
      //    xhr.onreadystatechange = function() {
      //       if (xhr.readyState === 4 && xhr.status === 200) {
      //          let json = JSON.stringify(data);
      //          console.log("おはよ");
      //          console.log("success", json);
      //          if(json.result ==  'success') {
      //             window.location.href = "./delete.php";
      //             return;
      //          } else {
      //             console.log("通信失敗");
      //          }
      //          }
      //       }
      //    });
      
      $(".aaa").click(function () {
      let todo_id = $(this).data('id');
      if (confirm("本当に削除する？")) {
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
    });


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
