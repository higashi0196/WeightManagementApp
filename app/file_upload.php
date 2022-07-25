<?php

require_once('config.php');

$file = $_FILES['img'];
$filename = basename($file['name']);
$tmp_path = $file['tmp_name'];
$fil_err = $file['error'];
$filesize = $file['size'];
$upload_dir = './images/';
$save_filename = date('YmdHis') . $filename;
$save_path = $upload_dir.$save_filename;


// ファイルサイズが1MB未満か？
if($filesize > 1048576 || $file_err == 2) {
   echo 'ファイルは1MB未満でお願いします。';
}

// 拡張は画像形式か？
$allow_ext = array('jpg','jpeg','png');
$file_ext = pathinfo($filename, PATHINFO_EXTENSION);

if(!in_array(strtolower($file_ext), $allow_ext)) {
   echo '画像ファイルを添付してください。';
}

// ファイルがあるかどうか？
if (is_uploaded_file($tmp_path)) {
   if(move_uploaded_file($tmp_path, $save_path)) {
      echo $filename . 'を'. $upload_dir. ' アップしました。';
      $result = filesave($filename, $save_path);

      if ($result) {
         echo 'データベースの保存に成功！';
      } else {
         echo 'データベースの保存に失敗';
      }

   } else {
      echo 'ファイルが保存できませんでした。';
   }
} else {
   echo 'ファイルが選択されていません。';
};

// var_dump($file);
?>

<a href="./file.php">戻る</a>