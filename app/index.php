<?php
session_start();

require_once(__DIR__ .'/config.php');

$pdo = Database::get();
$getller = new Todocontroller();
$todolists = $getller->todos();
$wordlists = $getller->words();
$bodylists = $getller->bodies();

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
      <p class="ideal-weight">目標体重 :</p>
      <p class="goal-weight"><?php echo Utils::h($bodylist['goalweights']); ?> kg</p></br>
      <p class="ideal-weight"> 現在の体重 :</p>
      <p class="goal-weight"><?php echo Utils::h($bodylist['nowweights']); ?> kg</p><br>
      <p class="ideal-weight">目標達成まであと :</p>
      <p class="goal-weight"><?php echo Utils::h($bodylist['difference']); ?> kg</p>
      <p class="achieve">見事達成！やったぜ！</p>
      <p class="ideal-day">(<?php echo Utils::h($bodylist['nowdate']); ?> 現在)</p>
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
         <?php if ($todolists): ?>
            <?php foreach ($todolists as $todo):?>
               <tr>
                  <td><?php echo Utils::h($todo['title']); ?></td>
                  <td><?php echo Utils::h($todo['content']); ?></td> 
                  <td><a href="edit.php?id=<?php echo $todo['id']?>"><button class="edit-btn">編集</button></a></td>       
                  <td class="deletebtn" data-id="<?php echo $todo['id']?>"><button class="delete-btn">削除</button></td>
               </tr> 
            <?php endforeach; ?>
         <?php else : ?>
            <td>Todoなし</td>
            <td>Todoなし</td>
            <td>Todoなし</td>
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
         <!-- <textarea id="word"><?php echo Utils::h($wordlist['content']); ?></textarea> -->
         <p id="word"><?php echo Utils::h($wordlist['content']); ?></p>
      <?php endforeach; ?>
   <?php else : ?>
      <p id="word">明日への一言を入力できます</p> 
   <?php endif; ?> 
   </div>

</div>

   <script>
      
      // todoリスト編 fetch非同期通信
      const deletebtns = document.querySelectorAll('.deletebtn');
      deletebtns.forEach(deletebtn => {
         deletebtn.addEventListener('click', () => {
            if (!confirm('削除しますか?')) {
               return;
            }
         fetch('./delete.php', {
            method: 'POST',
            body: new URLSearchParams({
            id: deletebtn.dataset.id,
         }),
         }).then(response => {
            return response.json();
         }).then(json => {
            console.log(json);
         })
         .catch(error => {
            console.log("削除に失敗しました");
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
            word.textContent = '明日への一言を入力できます';
            word.classList.add('word');
            console.log(json);
         })
         .catch(error => {
            console.log("削除に失敗しました");
         })
      });
      
      const difference = <?php echo $bodylist['difference']; ?>;
      const goalweight = <?php echo $bodylist['goalweights']; ?>;
      const achieve = document.querySelector('.achieve');
      const achieve2 = document.querySelector('.achieve2');
     
      if (difference <= 0) {
         achieve.style.display = 'block';
         console.log("0kg以下,達成");
      } else if (difference < goalweight * 0.01) {
         achieve.style.display = 'block';
         achieve.classList.add('achieve2');
         achieve.textContent ='あともう少し頑張ろう!';
         console.log("もう少し,頑張ろう");
      } else {
         achieve.style.display = 'none';
         console.log("まだまだやな");
      }

   </script>
</body>
</html>