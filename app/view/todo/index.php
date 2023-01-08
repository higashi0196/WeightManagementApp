<?php

require_once('./../../controller/Controller.php');

$token = new Token();
$token->create();

$todocontroller = new Todocontroller();
$todolists = $todocontroller->todos();

$postcontroller = new Postcontroller();
$postlists = $postcontroller->posts();

$weightcontroller = new Weightcontroller();
$latestweight = $weightcontroller->latestweight();

$token_error = $_SESSION['token_error'];
unset($_SESSION['token_error']);

?>

<!DOCTYPE html>
<html lang="ja">
<head> 
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>体重管理アプリ</title>
    <link rel="stylesheet" href="./../../public/css/styles.css">
</head>
<body>
    <div class="main-title">
        <img src="./../logos/logo3.png" alt="">
        <h1>体重管理リスト</h1>
        <img src="./../logos/logo3.png" alt="">
    </div>

    <div>
        <?php if ($latestweight): ?>
            <?php foreach ($latestweight as $weight): ?>
                <p class="ideal-weight">目標体重 :</p>
                <p class="goal-weight"><?php echo Utils::h($weight['goalweights']); ?> kg</p><br>
                <p class="ideal-weight"> 現在の体重 :</p>
                <p class="goal-weight"><?php echo Utils::h($weight['nowweights']); ?> kg</p><br>
                <p class="ideal-weight">目標達成まであと :</p>
                <p class="goal-weight"><?php echo Utils::h($weight['total']); ?> kg</p>
                <p class="achieve">見事達成 ! Good job !</p>
                <p class="ideal-day">
                ( <?php echo Utils::h($weight['nowdate']); ?> 現在 )</p>
            <?php endforeach; ?>
        <?php elseif (empty($latestweights)): ?>
            <p class="ideal-weight">目標体重 :</p>
            <p class="goal-weight"> -- kg</p><br>
            <p class="ideal-weight"> 現在の体重 :</p>
            <p class="goal-weight"> -- kg</p><br>
            <p class="ideal-weight">目標達成まであと :</p>
            <p class="goal-weight"> -- kg</p>
            <p class="weight-sheet">~ 体重の入力ができます ~</p>
        <?php endif; ?>
    </div> 

    <div class="btns">
        <a href="./../weight/weight.php"><button class="weight-btn">体重記入</button></a>
        <a href="./../weight/weightlists.php"><button class="weight-btn">体重履歴</button></a>
        <a><button class="reset" data-token="<?php echo Utils::h($_SESSION['token']); ?>">体重リセット</button></a>
        <a href="./../file/file.php"><button class="picutre-btn">画像アップロード</button></a>
    </div>

    <?php if ($token_error): ?>
        <?php foreach ($token_error as $token_err): ?>
            <p class="error-log"><?php echo Utils::h($token_err); ?></p>
        <?php endforeach?>
    <?php endif; ?>

    <div class="todo-title">
        <h2>〜 ボディリメイク ToDoリスト 〜</h2>
        <a href="./create.php"><button class="new-btn">新規登録</button></a>
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
                <?php foreach ($todolists as $todo): ?>
                    <tr data-token="<?php echo Utils::h($_SESSION['token']); ?>">
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
        <p class="todo">ToDoを入力できます</p> 
    <?php endif; ?>

    <div class="postcreate">
        <span>〜 一言メッセージ 〜</span>
        <a href="./../post/post.php"><button class="post-btn">投稿する</button></a>
        <a class="wordbtn" data-token="<?php echo Utils::h($_SESSION['token']); ?>">
        <button class="postdlt-btn">削除</button></a>
    </div>

    <div class="message">
        <?php if ($postlists): ?>
            <?php foreach ($postlists as $post): ?> 
                <p class="post"><?php echo Utils::h($post['content']); ?></p>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="post">一言メッセージを入力できます</p> 
        <?php endif; ?> 
    </div>

<script type="text/javascript">
    let total = "<?php echo Utils::h($weight['total']); ?>";
    let goal = "<?php echo Utils::h($weight['goalweights']); ?>";
</script>
<script type="text/javascript" src="./../../public/js/main.js"></script>

</body>
</html>