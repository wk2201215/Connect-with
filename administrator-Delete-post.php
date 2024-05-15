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
    array("Product ID", "Product Name", "Price"),
    array(1, "Product A", "$19.99"),
    array(2, "Product B", "$29.99"),
    array(3, "Product C", "$39.99")
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