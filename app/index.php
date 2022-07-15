<?php
session_start();

require_once(__DIR__ .'/config.php');

$pdo = Database::get();
$getller = new Todocontroller();
$lists = $getller->index();
$wordlists = $getller->index2();
$bodylists = $getller->index3();

// <script>alert("Hello!");</script>

?>

<!DOCTYPE html>
<html lang="ja">
<head> 
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <title>体重管理アプリ</title>
   <link rel="stylesheet" href="./css/styles.css">
</head>
<body>
<div class="all">

   <h1>
      <img src="./images/logo3.png" alt="" class="logo">
      体重管理リスト
      <img src="./images/logo3.png" class="logo">
   </h1>

   <?php foreach ($bodylists as $bodylist): ?>
      <span class="ideal-weight">目標体重 : </span>
      <span class="goal-weight"><?php echo Utils::h($bodylist['goalweights']); ?> kg</span></br>
      <span class="ideal-weight"> 現在の体重 :  </span>
      <span class="goal-weight"><?php echo Utils::h($bodylist['nowweights']); ?> kg</span><br>
      <span class="ideal-weight">目標達成まであと </span>
      <a id="remaining"><?php echo Utils::h($bodylist['difference']); ?></a> 
      <a id="unit">kg</a><br class="br">
      <span class="ideal-day">(<?php echo Utils::h($bodylist['nowdate']); ?> 現在)</span>
   <?php endforeach; ?>
   
   <div>
      <a href="weight.php"><button class="weight-btn">体重記入</button></a>
      <!-- <a href="picture.php"><button class="picutre-btn">画像アップ移動</button></a> -->
   </div>
   
   <div>
      <h2>〜 ToDoリスト 〜</h2>
      <a href="create.php"><button class="new-btn">新規登録</button></a>
   </div>

   <table>
      <thead>
         <tr>
            <th scope="col">タイトル</th>
            <th scope="col">目標</th>
            <th scope="col">更新</th>
            <th scope="col">削除</th>
         </tr>
      </thead>
      <tbody>
         <?php if ($lists): ?>
            <?php foreach ($lists as $todo):?>
               <tr>
                  <td><?php echo Utils::h($todo['title']); ?></td>
                  <td><?php echo Utils::h($todo['content']); ?></td> 
                  <td><a href="edit.php?todo_id=<?php echo $todo['id']?>"><button class="edit-btn">編集</button></a></td>       
                  <td class="deletebtn" data-id="<?php echo $todo['id']?>"><button class="delete-btn">削除</button></td>
               </tr> 
            <?php endforeach; ?>
         <?php else : ?>
            <td>Todoなし</td>
            <td>Todoなし</td>
            <td></td>
            <td></td>
         <?php endif; ?>
      </tbody>
   </table> 

   <div class="postcreate">
      <span> 〜 明日への一言 〜</span>
      <a href="post.php"><button class="post-btn">投稿する</button></a>
      <a class="wordbtn" data-id="<?php echo Utils::h($wordtodo['id']); ?>">
      <button class="postdlt-btn">削除</button></a>
   </div>

   <div class="message">
   <?php if ($wordlists): ?>
      <?php foreach ($wordlists as $wordlist): ?> 
         <p id="word"><?php echo Utils::h($wordlist['content']); ?></p>
      <?php endforeach; ?>
   <?php else : ?>
      <p id="word">明日への一言が入力できます</p> 
   <?php endif; ?> 
   </div>

</div>

   <!-- <script src="./js/main.js"></script> -->
   <script src="./js/jquery-3.6.0.min.js"></script>
   <script>
      
      // todoリスト編 fetch非同期通信
      const deletebtns = document.querySelectorAll('.deletebtn');
      deletebtns.forEach(deletebtn => {
         deletebtn.addEventListener('click', () => {
            if (!confirm('削除する?')) {
               return;
            }
         fetch('./delete.php', {
            method: 'POST',
            body: new URLSearchParams({
            todo_id: deletebtn.dataset.id,
         }),
         }).then(response => {
            return response.json();
         }).then(json => {
            console.log(json);
         })
         .catch(error => {
            console.log("失敗しました");
         })
            deletebtn.parentNode.remove();
         });
      });

      // 明日への一言編 fetch非同期通信
      const word = document.getElementById("word");
      const wordbtn = document.querySelector('.wordbtn');
      wordbtn.addEventListener('click', () => {
         if (!confirm('削除する?')) {
            return;
         }
         fetch('./postdelete.php', {
            method: 'POST',
         }).then(response => {
            return response.json();
         })
         .then(json => {
            word.textContent = '明日への一言が入力できます';
            word.classList.add('word');
            console.log(json);
         })
         .catch(error => {
            console.log("非同期通信が失敗しました");
         })
      });
      
      const remaining = document.getElementById("remaining");
      const unit = document.getElementById("unit");
      const difference = <?php echo $bodylist['difference']; ?>;
      const goalweight = <?php echo $bodylist['goalweights']; ?>;
     
      if (difference <= 0 ) {
         remaining.textContent =  difference + ' kg';
         remaining.classList.add('remaining');
         unit.textContent = '見事達成! やったぜ!' ;
         unit.classList.add('unit');
         console.log("0kg以下,達成");
      } else if (0 < difference && difference < goalweight * 0.01) {
         remaining.textContent = difference + ' kg';
         unit.textContent = 'あともう少し頑張ろう!' ;
         unit.classList.add('unit2');
         console.log("もう少し,頑張ろう");
      } else {
         console.log("まだまだやな");
      }

      // todoリスト編 ajax非同期通信
      // $(document).on('click', '.deletebtn', function() {
      //    if (!confirm("削除しますがよろしいですか？")) {
      //    return;
      //    }
      //    $(this).parents('tr').remove();
      // });

      // $(".deletebtn").click(function () {
      //    let todo_id = $(this).data('id');
      //    let data = {};
      //    data.todo_id = todo_id;
      //    $.ajax({
      //       url: './delete.php',
      //       type: 'post',
      //       data: data
      //    }).done(function(data) {
      //       let json = JSON.parse(data);
      //       console.log(json);
      //    }).fail(function(data){
      //       console.log("非同期通信 失敗");
      //    })
      // });

      // 明日への一言編 ajax非同期通信
      // const word = document.getElementById("word");
      // $(".wordbtn").click(function () {
      //    if (!confirm("削除しますか？")) {
      //    return;
      //    }
      //    let post_id = $(this).data('id');
      //    let data = {};
      //    data.post_id = post_id;
      //    $.ajax({
      //       url: './postdelete.php',
      //       type: 'post',
      //       data: data
      //    }).done(function(data){             
      //       let json = JSON.parse(data);
      //       word.textContent = '非同期通信成功!';
      //       console.log(json);
      //    }).fail(function(data){
      //       console.log("非同期通信 失敗");
      //    })
      // });

   </script>
</body>
</html>