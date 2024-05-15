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
    array("POST", "User Name", "Delete"),
    array(1, "User Name", ""),
    array(2, "User Name", ""),
    array(3, "User Name", ""),
    array(4, "User Name", ""),
    array(5, "User Name", ""),
    array(6, "User Name", ""),
    array(7, "User Name", ""),
    array(8, "User Name", ""),
    array(9, "User Name", ""),
    array(10, "User Name", ""),
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