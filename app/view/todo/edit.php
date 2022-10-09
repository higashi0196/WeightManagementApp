<?php

require_once('./../../controller/controller.php');
// error_reporting(E_ALL & ~E_NOTICE);

$token = new Token();
$token->create();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $todocontroller = new Todocontroller();
    $todocontroller->todoupdate();
    exit;
}

$todocontroller = new Todocontroller();
$editdata =  $todocontroller->edit();
$todo = $editdata['todo'];
$param = $editdata['param'];

$token_error = $_SESSION['token_error'];
unset($_SESSION['token_error']);
$title_error = $_SESSION['title_error'];
unset($_SESSION['title_error']);
$content_error = $_SESSION['content_error'];
unset($_SESSION['content_error']);

?>

<!DOCTYPE html>
<html lang="ja">
<head> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>編集画面</title>
    <link rel="stylesheet" href="./../../public/css/styles.css">
</head>
<body>
    <p class="outline">編集画面</p>

    <?php if ($token_error):?>
        <?php foreach ($token_error as $token_err): ?>
            <p class="error-log"><?php echo Utils::h($token_err);?></p>
        <?php endforeach;?>
    <?php endif; ?>

    <form method="POST" action="./edit.php">
        <div>
            <p class="title">タイトル</p>
            <input type="text" name="title" class="titleinput" value="<?php if (isset($param['title'])):?><?php echo Utils::h($param['title']);?><?php else:?><?php echo Utils::h($todo['title']);?><?php endif;?>">

            <?php if ($title_error):?>
                <?php foreach ($title_error as $title_err): ?>
                    <p class="error-log"><?php echo Utils::h($title_err);?></p>
                <?php endforeach;?>
            <?php endif; ?>
        </div>

        <div>
            <p class="title">詳細</p>
            <input type="text" name="content" class="titleinput" value="<?php if (isset($param['content'])):?><?php echo Utils::h($param['content']);?><?php else:?><?php echo Utils::h($todo['content']);?><?php endif;?>">

            <?php if ($content_error):?>
                <?php foreach ($content_error as $content_err): ?>
                    <p class="error-log"><?php echo Utils::h($content_err);?></p>
                <?php endforeach;?>
            <?php endif; ?>

        </div>
        
        <button type="submit" class="register-btn">更新</button>
        <input type="hidden" name="id" value="<?php echo Utils::h($todo['id']);?>">
        <input type="hidden" name="token" value="<?php echo Utils::h($_SESSION['token']); ?>">
    </form>

    <a href="./index.php"><button class="return-btn">戻る</button></a>
</body>
</html>