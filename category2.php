<?php require 'db/db-connect.php'; ?>
<?php require 'default/header-top.php'; ?>
<?php require 'default/header-menu.php'; ?>

<?php
$pdo=new PDO($connect,USER,PASS);
$sql=$pdo->query('select * from category');
echo '<div id="container">';
foreach($sql as $row){
    echo $row['category_name'];
    echo '<br>';
}
?>

<?php require 'default/footer-menu.php'; ?>
<?php require 'default/footer-top.php'; ?>
