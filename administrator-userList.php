<?php session_start(); ?>
<?php require 'default/header.php'; ?>

<div class="search">
<input class="keyword" type="text" name="keyword" placeholder="  キーワード検索  ">
<button class="searchbutton" type="submit" name="user_search" value="ユーザー検索">🔍</button>
<button class="searchbutton" type="submit" name="hashtag" value="ハッシュタグ検索">＃</button>
</div>

<table class="table">
<!-- <?php
    foreach($sql as $row){

    }
?> -->
</table>
<?php require 'default/footer.php'; ?>

<body>
<?php
// テーブルのデータを定義
$products = array(
    array("user name", "restoration", "delete"),
    array("", "", "delete"),
    array("", "", "delete"),
    array("", "", "delete"),
    array("", "", "delete"),
    array("", "", "delete"),
    array("", "", "delete"),
    array("", "", "delete"),
    array("", "", "delete"),
    array("", "", "delete"),
    array("", "", "delete"),
    array("", "", "delete"),
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

