<?php
session_start();

require_once('config.php');

$pdo = Database::get();
$getller = new Todocontroller();
$lists = $getller->index();
$wordlists = $getller->index2();
$bodylists = $getller->index3();

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
         <a class="miyako">画像アップ</a>
         <a href="picture.php" class="ishigaki"><button>移動</button></a>  
      </div>

      <div>
         <a class="miyako">ToDoリスト</a>
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
               <?php foreach ($lists as $todo):?>
                  <tr>
                     <td><?php echo $todo['title']; ?></td>
                     <td><?php echo $todo['content']; ?></td> 
                     <td><a href="edit.php?todo_id=<?php echo $todo['id']?>" class="editbtn"><button>編集</button></a></td>       
                     <td class="deletebtn" data-id="<?php echo $todo['id']?>"><button>削除</button></td>
                  </tr> 
               <?php endforeach; ?>
            <?php else : ?>
               <td>Todoなし</td>
            <?php endif; ?>
         </tbody>
      </table> 

      <div>
         <a class="miyako">明日への一言</a>
         <a href="post.php" class="ishigaki"><button>投稿する</button></a>
         <a class="wordbtn" data-id="<?php echo $wordtodo['id']; ?>">
         <button>削除</button></a>
      </div>

      <div class="miyako">
      <?php if ($wordlists): ?>
         <?php foreach ($wordlists as $wordlist): ?> 
            <p id="word"><?php echo $wordlist['content']; ?></p>
         <?php endforeach; ?>
      <?php else : ?>
         <p>非同期通信成功!</p> 
      <?php endif; ?> 
      </div>
   </main>

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
            word.textContent = '非同期通信成功!';
            console.log(json);
         })
         .catch(error => {
            console.log("非同期通信が失敗しました");
         })
      });
      
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

   </script>
</body>
</html>