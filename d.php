<?php require 'db/db-connect.php'; ?>
<?php
$pdo=new PDO($connect,USER,PASS);
$sql=$pdo->query('DELETE FROM account_tentative
WHERE delete_at < NOW()');
?>