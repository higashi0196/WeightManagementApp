<?php

require_once('./../../controller/controller.php');
// error_reporting(E_ALL & ~E_NOTICE);

$token = new Token();
$token->create();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $filecontroller = new Filecontroller();
    $filecontroller->filecreate();
    exit;
}

$filecontroller = new Filecontroller();
$filelists = $filecontroller->files(); 

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['comment'])) {
        $comment = $_GET['comment'];
    }
}

$token_error = $_SESSION['token_error'];
unset($_SESSION['token_error']);
$filesize_error = $_SESSION['filesize_error'];
unset($_SESSION['filesize_error']);
$comment_error = $_SESSION['comment_error'];
unset($_SESSION['comment_error']);
$filemodel_error = $_SESSION['filemodel_error'];
unset($_SESSION['filemodel_error']);
$file_error = $_SESSION['file_error'];
unset($_SESSION['file_error']);

?>

<!DOCTYPE html>
<html lang="ja">
<head> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>画像アップロード</title>
    <link rel="stylesheet" href="./../../public/css/styles.css">
</head>
<body>
    <p class="outline">画像アップロード</p>

    <?php if ($token_error):?> 
        <?php foreach ($token_error as $token_err): ?>
            <p class="error-log"><?php echo Utils::h($token_err);?></p>
        <?php endforeach;?>
    <?php endif; ?>

    <form action="./file.php" method="POST" enctype="multipart/form-data">
        <input type="file" name="img" class="fileinput">

        <?php if ($file_error):?>
            <?php foreach ($file_error as $file_err): ?>
                <p class="error-log"><?php echo Utils::h($file_err);?></p>
            <?php endforeach;?>
        <?php endif; ?>

        <?php if ($filemodel_error):?>
            <?php foreach ($filemodel_error as $filemodel_err): ?>
                <p class="error-log"><?php echo Utils::h($filemodel_err);?></p>
            <?php endforeach;?>
        <?php endif; ?>

        <?php if ($filesize_error):?>
            <?php foreach ($filesize_error as $filesize_err): ?>
                <p class="error-log"><?php echo Utils::h($filesize_err);?></p>
            <?php endforeach;?>
        <?php endif; ?>

        <div>
            <p class="memo">〜 一言メモ 〜</p>
            <textarea name="comment" class="comment"><?php echo Utils::h($comment);?></textarea>
        </div>

        <?php if ($comment_error):?>
            <?php foreach ($comment_error as $comment_err): ?>
                <p class="error-log"><?php echo Utils::h($comment_err);?></p>
            <?php endforeach;?>
        <?php endif; ?>

        <button type="submit" class="file-btn">アップロード</button>
        <input type="hidden" name="MAX_FILE_SIZE" value="1048576">
        <input type="hidden" name="token" value="<?php echo Utils::h($_SESSION['token']); ?>">
    </form>

    <a href="./../todo/index.php"><button class="return-btn">戻る</button></a>
    <ol>
        <?php foreach ($filelists as $filelist): ?>
            <li data-token="<?= Utils::h($_SESSION['token']); ?>">
                <img src="<?php echo Utils::h($filelist['file_path']); ?>" alt="">
                <div>
                    <p class="list-memo"> 〜〜  一言メモ 〜〜 </p>
                    <p class="list-comment"><?php echo Utils::h($filelist['comment']); ?></p>
                    <button class="filedelete-btn" data-id="<?php echo Utils::h($filelist['id']); ?>">削除</button>
                </div>
            </li>
        <?php endforeach; ?>
    </ol>

    <script type="text/javascript" src="./../../public/js/file.js"></script>
</body>
</html>