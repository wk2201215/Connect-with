<?php require 'db/db-connect.php'; ?>
<?php
$pdo=new PDO($connect,USER,PASS);
$sql=$pdo->query('UPDATE account SET login_flag = 0
WHERE login_time < NOW()');
?>