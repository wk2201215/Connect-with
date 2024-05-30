<?php require 'db/db-connect.php'; ?>
<?php session_start(); ?>
<?php require 'default/header-top.php'; ?>
<?php require 'default/header-menu.php'; ?>
<?php
$pdo=new PDO($connect,USER,PASS);
$sql=$pdo->query('select * from post');
echo '<div id="container">';
foreach($sql as $row){
    // var_dump($_SESSION['account']);
    $sql_a=$pdo->prepare('SELECT * FROM account INNER JOIN photograph ON account.photograph_id = photograph.photograph_id WHERE account_id = ?');
    $sql_a->execute([$row['account_id']]);
    // var_dump($sql_a);
    // パスから画像データを取得
    $item1=$sql_a->fetch();
    // var_dump($item1);
    $filePath1 = 'images/'.$item1['photograph_path'];
    echo '<img src="Image display.php?hogeA='.$filePath1.'" alt="アカウント写真" />';
    echo '<br>';
    echo $item1['account_name'];
    echo '<br>';
    echo '<div id="hoge">';
    echo $row['post_time'];
    echo '<br>';
    echo $row['post_content'];
    echo '<br>';
    // var_dump($row);
    if(isset($row['photograph_id'])){
        $sql_p=$pdo->prepare('SELECT * FROM photograph where photograph_id = ?');
        $sql_p->execute([$row['photograph_id']]);
        $item2=$sql_p->fetch();
        $filePath2 = 'images/'.$item2['photograph_path'];
        echo '<img src="Image display.php?hogeA='.$filePath2.'" alt="投稿写真" />';
        echo '<br>';
    }
    echo '</div>';
}
?>

<?php require 'default/footer-menu.php'; ?>
<?php require 'default/footer-top.php'; ?>
