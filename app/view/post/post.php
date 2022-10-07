<?php

require_once('./../../controller/controller.php');

$token = new Token();
$token->create();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $postcontroller = new Postcontroller();
    $postcontroller->postcreate();
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['content'])) {
        $content = $_GET['content'];
    }
}

$token_error = $_SESSION['token_error'];
unset($_SESSION['token_error']);
$post_error = $_SESSION['post_error'];
unset($_SESSION['post_error']);

?>

<!DOCTYPE html>
<html lang="ja">
<head> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>明日への一言</title>
    <link rel="stylesheet" href="./../../public/css/styles.css">
</head>
<body>
    <p class="outline">一言メッセージ</p>

    <?php if ($token_error):?>
        <?php foreach ($token_error as $token_err): ?>
            <p class="error-log"><?php echo Utils::h($token_err);?></p>
        <?php endforeach;?>
    <?endif;?>

    <form method="POST" action="./post.php">
        <textarea name="postcontent" placeholder="メッセージをどうぞ"></textarea>
        
        <?php if ($post_error):?>
            <?php foreach ($post_error as $post_err): ?>
                <p class="error-log"><?php echo Utils::h($post_err);?></p>
            <?php endforeach;?>
        <?endif;?>

        <button type="submit" class="post-btn2">投稿する</button>
        <input type="hidden" name="token" value="<?php echo Utils::h($_SESSION['token']); ?>">
    </form>

    <a href="./../todo/index.php"><button class="return-btn">戻る</button></a>
</body>
</html>