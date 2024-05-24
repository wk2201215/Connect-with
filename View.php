<?php require 'db/db-connect.php'; ?>
<?php require 'default/header-top.php'; ?>
<?php require 'default/header-menu.php'; ?>

<?php
$pdo=new PDO($connect,USER,PASS);
$sql=$pdo->query('select * from post');
echo '<div id="container">';
foreach($sql as $row){
    $sql_a=$pdo->prepare('SELECT * FROM account INNER JOIN photograph ON account.photograph_id = photograph.photograph_id where account_id = ?');
    $sql_a->execute([$row['account_id']]);
    // パスから画像データを取得
    $item1=$sql_a->fetchAll();
    var_dump($item1);
    $filePath1 = 'images/'.$item1['photograph_path'];
    $data1 = file_get_contents($filePath1);
    // header関数でコンテンツの形式が画像であると宣言
    header('Content-type: image/jpg');
    //データを出力
    echo $data1;
    echo '<br>';
    echo $row['account_id'];
    echo '<br>';
    echo $row['post_time'];
    echo '<br>';
    echo $row['post_content'];
    echo '<br>';
    $sql_p=$pdo->prepare('SELECT * FROM photograph where photograph_id = ?');
    $sql_p->execute([$row['photograph_id']]);
    $item2=$sql_p->fetchAll();
    $filePath2 = 'images/'.$item2['photograph_path'];
    $data2 = file_get_contents($filePath2);
    header('Content-type: image/jpg');
    echo $data2;
    echo '<br>';
}
?>

<?php require 'default/footer-menu.php'; ?>
<?php require 'default/footer-top.php'; ?>
