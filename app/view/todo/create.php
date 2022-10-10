<?php

require_once('./../../controller/controller.php');

$token = new Token();
$token->create();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $todocontroller = new Todocontroller();
    $todocontroller->todocreate();
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    if (isset($_GET['title'])) {
        $title = $_GET['title'];
    }

    if (isset($_GET['content'])) {
        $content = $_GET['content'];
    }

}

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
    <title>新規登録</title>
    <link rel="stylesheet" href="./../../public/css/styles.css">
</head>
<body>
    <p class="outline">新規登録</p>

    <?php if ($token_error):?>
        <?php foreach ($token_error as $token_err): ?>
            <p class="error-log"><?php echo Utils::h($token_err);?></p>
        <?php endforeach;?>
    <?php endif; ?>

    <form method="POST" action="./create.php">
        <div>
            <p class="title">タイトル</p>
            <input type="text" name="title" class="titleinput" 
            value="<?php echo Utils::h($title);?>" 
            placeholder="タイトルを入力できます">

            <?php if ($title_error):?>
                <?php foreach ($title_error as $title_err): ?>
                    <p class="error-log"><?php echo Utils::h($title_err);?></p>
                <?php endforeach;?>
            <?php endif; ?>
        </div>
        <div>
            <p class="title">詳細</p>
            <input type="text" name="content" class="titleinput" 
            value="<?php echo $content;?>" 
            placeholder="詳細を入力できます">
            
            <?php if ($content_error):?>
                <?php foreach ($content_error as $content_err): ?>
                    <p class="error-log"><?php echo Utils::h($content_err);?></p>
                <?php endforeach;?>
            <?php endif; ?>
        </div>
        <button type="submit" class="register-btn">登録</button>
        <input type="hidden" name="token" value="<?php echo Utils::h($_SESSION['token']); ?>">
    </form>
        
    <a href="./index.php"><button class="return-btn">戻る</button></a>
</body>
</html>