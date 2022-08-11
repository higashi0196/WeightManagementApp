'use strict';

{
   var js_array = '<?php echo $difference; ?>'
   var js_array2 = '<?php echo $goalweights; ?>'
   let achieve = document.querySelector('.achieve');
   let achieve2 = document.querySelector('.achieve2');
   
   if (js_array <= 0) {
      achieve.style.display = 'block';
      console.log("0kg以下,達成");
   } else if (js_array < js_array2 * 0.01) {
      achieve.style.display = 'block';
      achieve.classList.add('achieve2');
      achieve.textContent ='あともう少し頑張ろう!';
      console.log("もう少し,頑張ろう");
   } else {
      achieve.style.display = 'none';
      console.log("まだまだやな");
   }

}