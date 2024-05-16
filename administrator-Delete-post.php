<?php session_start(); ?>
<?php require 'default/header.php'; ?>

<?php
echo '<form action="post-delete.php" method="post">';
echo '<input type="text" name="keyword">';
echo '<input type="submit" value="🔍">';
echo '<input type="submit" value="＃">';
?>

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