<?php require 'db/db-connect.php'; ?>
<?php
session_start();
try {
    $pdo=new PDO($connect,USER,PASS);
} catch (PDOException $e) {
 var_dump($e->getMessage());
 exit;
}

$sql=$pdo->prepare('UPDATE account SET theme_id = ? WHERE account_id=?');
$sql->execute([$_POST['theme_id'], $_SESSION['account']['account_id']]);

$sql2=$pdo->prepare('SELECT * FROM theme WHERE theme_id = ?');
$sql2->execute([$_POST['theme_id']]);
$item = $sql2->fetch();

$_SESSION['account']['theme_id'] = $_POST['theme_id'];


//jsonとして出力
header('Content-type: application/json');
echo json_encode($item,JSON_UNESCAPED_UNICODE);