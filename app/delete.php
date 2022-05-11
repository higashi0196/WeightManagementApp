<?php

require_once('config.php');

$getller = new Todocontroller();
$result = $getller->delete();
$result2 = $getller->postdelete();

$response = array();
if($result) {
    $response['result'] = 'success';
} else {
    $response['result'] = 'fail';
}

echo json_encode([$response]);

header('Location: ' . SITE_URL);

?>

<!-- javascript  -->
<!-- 試し用 -->
<!-- <td><button id="btn2" class="delete-btn">Click2</button></td>
<td><button id="btn3" class="delete-btn">Click3</button></td> -->
<!-- 試し用終わり -->

<!-- const button1 = document.getElementById("btn1");
button1.addEventListener("click", () => {
   if (!confirm('本当に削除しますか?')) {
   return;
}    
   console.log("なんでやねん");
});

const button2 = document.getElementById("btn2");
button2.addEventListener("click", () => {
   if (!confirm('Are you sure?')) {
   return;
}
   console.log("まっほー");
});

const button3 = document.getElementById("btn3");
button3.addEventListener("click", () => {
   console.log("クリックされました");
}); -->

<!DOCTYPE html>
<html lang="ja">
<head> 
   <meta charset="utf-8">
   <title>編集画面</title>
   <link rel="stylesheet" href="./css/styles.css">
</head>
<body>
   <a class="edit-feeld">削除画面</a>
</body>
</html>