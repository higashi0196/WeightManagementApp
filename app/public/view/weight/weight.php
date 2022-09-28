<?php

require_once('./../../../controller/controller.php');

session_start();
$token = new Token();
$token->create();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $weightcontroller = new Weightcontroller();
    $weightcontroller->dietcreate();
    exit;
}

$weightcontroller = new Weightcontroller();
$goallists = $weightcontroller->goalweights();

if($_SERVER['REQUEST_METHOD'] === 'GET') {

    if(isset($_GET['body'])) {
        $body = $_GET['body'];
    }

    if(isset($_GET['weight'])) {
        $weight = $_GET['weight'];
    }

    if(isset($_GET['today'])) {
        $today = $_GET['today'];
    }
}

$token_error = $_SESSION['token_error'];
unset($_SESSION['token_error']);
$weight_error = $_SESSION['weight_error'];
unset($_SESSION['weight_error']);
$body_error = $_SESSION['body_error'];
unset($_SESSION['body_error']);
$today_error = $_SESSION['today_error'];
unset($_SESSION['today_error']);

?>

<!DOCTYPE html>
<html lang="ja">
<head> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>新規登録</title>
    <link rel="stylesheet" href="./../../css/styles.css">
</head>
<body>
    <p class="outline">体重記録</p>

    <?php if ($token_error):?>
        <?php foreach ($token_error as $token_err): ?>
            <p class="error-log"><?php echo Utils::h($token_err);?></p>
        <?php endforeach;?>
    <?endif;?>

    <form method="POST" action="./weight.php">
        <p class="bodytitle">目標体重 : <input type="text" name="body" class="weightinput" value="<?php if (isset($body)):?><?php echo Utils::h($body);?><?php else:?><?php echo Utils::h($goallists['goalweights']);?><?php endif;?>"> kg</p>

        <?php if ($body_error):?>
            <?php foreach ($body_error as $body_err): ?>
                <p class="error-log"><?php echo Utils::h($body_err);?></p>
            <?php endforeach;?>
        <?endif;?>

        <p class="bodytitle">現在の体重 : <input type="text" name="weight" class="weightinput" value="<?php echo Utils::h($weight); ?>"> kg</p>

        <?php if ($weight_error):?>
            <?php foreach ($weight_error as $weight_err): ?>
                <p class="error-log"><?php echo Utils::h($weight_err);?></p>
            <?php endforeach;?>
        <?endif;?>

        <p class="bodytitle">日付 :
        <input type="date" name="today" class="dayinput" value="<?php echo Utils::h($today); ?>"></p>

        <?php if ($today_error):?>
            <?php foreach ($today_error as $today_err): ?>
                <p class="error-log"><?php echo Utils::h($today_err);?></p>
            <?php endforeach;?>
        <?endif;?>

        <button type="submit" class="register-btn">記入</button>
        <input type="hidden" name="token" value="<?php echo Utils::h($_SESSION['token']); ?>">
    </form>

    <a href="./../todo/index.php"><button class="return-btn">戻る</button></a>
</body>
</html>