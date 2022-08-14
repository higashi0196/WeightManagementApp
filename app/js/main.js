'use strict';

{

   // let difference = "<?php echo $weightlist['difference']; ?>";
   // let goalweight = "<?php echo $weightlist['goalweights']; ?>";
   // let difference = "<?php echo $weightlist['difference']; ?>";
   // let goalweight = "<?php echo $weightlist['goalweights']; ?>";
   var achieve = document.querySelector('.achieve');
   var achieve2 = document.querySelector('.achieve2');
   
   if (difference <= 0) {
      achieve.style.display = 'block';
      console.log("0kg以下,達成");
   } else if (difference < goalweight * 0.01) {
      achieve.style.display = 'block';
      achieve.classList.add('achieve2');
      achieve.textContent ='あともう少し頑張ろう!';
      console.log("もう少し,頑張ろう");
   }  else {
      achieve.style.display = 'none';
      console.log("まだまだやな");
   }


   // todoリスト 削除ボタン非同期通信
   const deletebtns = document.querySelectorAll('.delete-btn');
   deletebtns.forEach(btn => {
      btn.addEventListener('click', () => {
         if (!confirm('削除しますか?')) {
            return;
         }
      fetch('./delete.php', {
         method: 'POST',
         body: new URLSearchParams({
         id: btn.dataset.id,
      }),
      }).then(response => {
         return response.json();
      }).then(json => {
         console.log(json);
      })
      .catch(error => {
         window.location.href = './../../view/error/404.php';
         console.log("削除に失敗しました");
      })
         btn.closest('tr').remove();
      });
   });
}