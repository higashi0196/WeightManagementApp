<?php

require_once('./../../controller/controller.php');

session_start();
$token = new Token();
$token->create();

$todocontroller = new Todocontroller();
$todolists = $todocontroller->todos();
$postcontroller = new Postcontroller();
$postlists = $postcontroller->posts();
$weightcontroller = new Weightcontroller();
$weightlists = $weightcontroller->weights();

$token_errors = $_SESSION['token_errors'];
unset($_SESSION['token_errors']);

?>

<!DOCTYPE html>
<html lang="ja">
<head> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>体重管理アプリ</title>
    <link rel="stylesheet" href="./../../css/styles.css">
</head>
<body>
<main>
    <h1>
        <img src="./../logos/logo3.png" alt="">
        <a>体重管理リスト</a>
        <img src="./../logos/logo3.png" alt="">
    </h1>
   
    <?php foreach ($weightlists as $weightlist): ?>
        <p class="ideal-weight">目標体重 :</p>
        <p class="goal-weight"><?php echo Utils::h($weightlist['goalweights']); ?> kg</p><br>
        <p class="ideal-weight"> 現在の体重 :</p>
        <p class="goal-weight"><?php echo Utils::h($weightlist['nowweights']); ?> kg</p><br>
        <p class="ideal-weight">目標達成まであと :</p>
        <p class="goal-weight"><?php echo Utils::h($weightlist['difference']); ?> kg</p>
        <p class="achieve">見事達成！やったぜ！</p>
        <p class="ideal-day">
        ( <?php echo Utils::h($weightlist['nowdate']); ?> 現在 )</p>
    <?php endforeach; ?>
   
    <div>
        <a href="./../weight/weight.php"><button class="weight-btn">体重記入</button></a>
        <a href="./../file/file.php"><button class="picutre-btn">画像アップロード</button></a>
    </div>

    <?php if($token_errors):?>
        <?php foreach ($token_errors as $token_error): ?>
            <p class="error-log"><?php echo Utils::h($token_error);?></p>
        <?php endforeach;?>
    <?endif;?>

    <div>
        <h2>〜 ボディリメイク ToDoリスト 〜</h2>
        <a href="create.php"><button class="new-btn">新規登録</button></a>
    </div>

    <?php if ($todolists): ?>
    <table>
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">タイトル</th>
                <th scope="col">詳細</th>
                <th scope="col">編集</th>
                <th scope="col">削除</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($todolists as $todo):?>
                <tr data-token="<?= Utils::h($_SESSION['token']); ?>">
                    <td>
                        <input type="checkbox" 
                        data-id="<?php echo Utils::h($todo['id'])?>" 
                        <?= $todo['is_done'] ? 'checked' : ''; ?>>
                    </td>
                    <td class="<?= $todo['is_done'] ? 'done' : ''; ?>">
                        <?php echo Utils::h($todo['title']); ?>
                    </td>
                    <td class="<?= $todo['is_done'] ? 'done' : ''; ?>">
                        <?php echo Utils::h($todo['content']); ?>
                    </td> 
                    <td>
                        <a href="edit.php?id=<?php echo Utils::h($todo['id'])?>">
                        <button class="edit-btn">編集</button></a>
                    </td>  
                    <td>
                        <button class="delete-btn" data-id="<?php echo Utils::h($todo['id'])?>">削除</button>
                    </td> 
                </tr> 
            <?php endforeach; ?>
        </tbody>
    </table> 
    <?php elseif (empty($todolists)): ?>
    <table>
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col">タイトル</th>
                <th scope="col">詳細</th>
                <th scope="col">編集</th>
                <th scope="col">削除</th>
            </tr>
        </thead>
    </table>
        <p class="todo">ToDoが空です</p> 
    <?php endif; ?>

    <div class="postcreate">
        <span>〜 一言メッセージ 〜</span>
        <a href="./../post/post.php"><button class="post-btn">投稿する</button></a>
        <a class="wordbtn" 
        data-id="<?php echo Utils::h($wordtodo['id']); ?>" 
        data-token="<?= Utils::h($_SESSION['token']); ?>">
        <button class="postdlt-btn">削除</button></a>
    </div>

    <div class="message">
        <?php if ($postlists): ?>
            <?php foreach ($postlists as $postlist): ?> 
                <p id="word"><?php echo Utils::h($postlist['content']); ?></p>
        <?php endforeach; ?>
        <?php else : ?>
            <p id="word">一言メッセージを入力できます</p> 
        <?php endif; ?> 
        </div>

</main>

<script type="text/javascript">
    const difference = "<?php echo $weightlist['difference']; ?>";
    const goalweight = "<?php echo $weightlist['goalweights']; ?>";
</script>

<script type="text/javascript" src="./../../js/main.js"></script>
</body>
</html>