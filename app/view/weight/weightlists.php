<?php

require_once('./../../controller/Controller.php');

$weightcontroller = new Weightcontroller();
$weightlists = $weightcontroller->weightlists();

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
                <?php foreach ($weightlists as $list): ?>
                    <tr>
                        <td><?php echo Utils::h($list['goalweights']); ?></td>
                        <td><?php echo Utils::h($list['nowweights']); ?></td>
                        <td><?php echo Utils::h($list['total']); ?></td>
                        <td><?php echo Utils::h($list['nowdate']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php elseif (empty($weightlists)): ?>
        <p class="no-lists">
            履歴がございません<br>
            体重を記入すると表示されます
        </p>
    <?php endif; ?> 

    <a href="./../todo/index.php"><button class="return-btn">戻る</button></a>
</body>
</html>