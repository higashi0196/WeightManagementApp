<?php

require_once('./../../controller/Controller.php');

$token = new Token();
$token->create();

$weightcontroller = new Weightcontroller();
$weightlists = $weightcontroller->weightlists();
$lists = $weightcontroller->gapAllweights();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>体重履歴</title>
    <link rel="stylesheet" href="./../../public/css/styles.css">
</head>
<body>
    <p class="outline">体重履歴</p>

    <!-- <div class="list"> -->
        <?php if ($weightlists): ?>
            <table class="list">
                <thead>
                    <tr>
                        <th scope="col">目標体重</th>
                        <th scope="col">現在の体重</th>
                        <th scope="col">差</th>
                        <th scope="col">日付</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($weightlists as $weight): ?>
                        <tr>
                            <td><?php echo Utils::h($weight['goalweights']); ?></td>
                            <td><?php echo Utils::h($weight['nowweights']); ?></td>
                            <td><?php foreach ($lists as $list): ?>
                                <?php echo Utils::h($list); ?>
                            <?php endforeach; ?></td>
                            <td><?php echo Utils::h($weight['nowdate']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php elseif (empty($weightlists)): ?>
            <table>
                <thead>
                    <tr>
                        <th scope="col">目標体重</th>
                        <th scope="col">現在の体重</th>
                        <th scope="col">差</th>
                        <th scope="col">日付</th>
                    </tr>
                </thead>
            </table>
            <p class="weight-save">~ 体重を入力できます ~</p>
        <?php endif; ?> 
    <!-- </div> -->

    <a href="./../todo/index.php"><button class="return-btn">戻る</button></a>
</body>
</html>