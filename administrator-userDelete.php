<?php session_start(); ?>
<?php require 'default/header.php'; ?>

<div class="search">
<input class="keyword" type="text" name="keyword" placeholder="  キーワード検索  ">
<button class="user_button" type="submit" name="user_search" value="ユーザー検索">🔍</button>
<button class="user_button" type="submit" name="hashtag" value="ハッシュタグ検索">＃</button>
<button class="user_button" type="submit" name="garbage_can" src="./images/🗑️.png" value="ユーザー削除">🗑️</button>
</div>

<body>
<?php
// テーブルのデータを定義
$products = array(
    array("Post", "User Name", "Delete"),
    array(1, "", ""),
    array(2, "", ""),
    array(3, "", ""),
    array(4, "", ""),
    array(5, "", ""),
    array(6, "", ""),
    array(7, "", ""),
    array(8, "", ""),
    array(9, "", ""),
    array(10, "", ""),
);
// テーブルの開始タグを出力
echo "<table border='1'>";

// テーブルの各行を出力
foreach ($products as $row) {
    echo "<tr>";
    foreach ($row as $cell) {
        echo "<td>$cell</td>";
    }
    echo "</tr>";
}

// テーブルの終了タグを出力
echo "</table>";
?>
</body>

<?php
    unset($_SESSION['account']);
    $pdo=new PDO($connect, USER, PASS);
    $sql=$pdo->prepare('select * from account where mail-address=?');
    $sql->execute([$_POST['mail-address']]);
?>

<input type="image" name="garbage_can" src="./images/🗑️.png"  alt="ユーザー削除" value="ユーザー削除">

<?php require 'default/footer.php'; ?>