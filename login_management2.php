<?php require 'db/db-connect.php'; ?>
<?php
$pdo=new PDO($connect,USER,PASS);
$sql2=$pdo->query('SELECT * FROM account WHERE login_flag = 1');
foreach($sql2 as $row){
    $sql=$pdo->prepare('INSERT INTO login_management (account_id, login_time) VALUES (?, NOW())');
    $sql->execute([$row['account_id']]);
}
?>