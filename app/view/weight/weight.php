<?php

require_once('./../../controller/controller.php');

session_start();
$token = new Token();
$token->create();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $weightcontroller = new Weightcontroller();
    $weightcontroller->dietcreate();
    exit;
}

$weightcontroller = new Weightcontroller();
$goallists = $weightcontroller->goals();

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

$token_errors = $_SESSION['token_errors'];
unset($_SESSION['token_errors']);
$weight_errors = $_SESSION['weight_errors'];
unset($_SESSION['weight_errors']);
$body_errors = $_SESSION['body_errors'];
unset($_SESSION['body_errors']);
$today_errors = $_SESSION['today_errors'];
unset($_SESSION['today_errors']);

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

    <form method="POST" action="./weight.php">

    <?php if ($token_errors):?>
        <?php foreach ($token_errors as $token_error): ?>
            <p class="error-log"><?php echo Utils::h($token_error);?></p>
        <?php endforeach;?>
    <?endif;?>

    <p class="bodytitle">目標体重 : <input type="text" name="body" class="weightinput" value="<?php if (isset($body)):?><?php echo Utils::h($body);?><?php else:?><?php echo Utils::h($goallists['goalweights']);?><?php endif;?>"> kg</p>

    <?php if ($body_errors):?>
        <?php foreach ($body_errors as $body_error): ?>
            <p class="error-log"><?php echo Utils::h($body_error);?></p>
        <?php endforeach;?>
    <?endif;?>

    <p class="bodytitle">現在の体重 : <input type="text" name="weight" class="weightinput" value="<?php echo Utils::h($weight); ?>"> kg</p>

    <?php if ($weight_errors):?>
        <?php foreach ($weight_errors as $weight_error): ?>
            <p class="error-log"><?php echo Utils::h($weight_error);?></p>
        <?php endforeach;?>
    <?endif;?>

    <p class="bodytitle">日付 :
    <input type="date" name="today" class="dayinput" value="<?php echo Utils::h($today); ?>"></p>

    <?php if ($today_errors):?>
        <?php foreach ($today_errors as $today_error): ?>
            <p class="error-log"><?php echo Utils::h($today_error);?></p>
        <?php endforeach;?>
    <?endif;?>

    <button type="submit" class="register-btn">記入</button>
    <input type="hidden" name="token" value="<?php echo Utils::h($_SESSION['token']); ?>">
    </form>

    <a href="./../todo/index.php"><button class="return-btn">戻る</button></a>
</body>
</html>