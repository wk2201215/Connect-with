<?php require 'db/db-connect.php'; ?>
<?php require 'default/header-top.php'; ?>
<?php require 'default/header-menu.php'; ?>

<?php
$pdo=new PDO($connect,USER,PASS);
$sql=$pdo->query('select * from post INNER JOIN account ON post.account_id = account.account_id');
echo '<div id="container">';
foreach($sql as $row){
    // パスから画像データを取得
    $filePath = 'images/'.$row['photograph_path'];
    $data = file_get_contents($filePath);
    // header関数でコンテンツの形式が画像であると宣言
    header('Content-type: image/jpg');
    //データを出力
    echo $data;
    echo '<br>';
}
?>

<?php require 'default/footer-menu.php'; ?>
<?php require 'default/footer-top.php'; ?>
