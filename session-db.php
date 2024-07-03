<?php require 'db/db-connect.php'; ?>
<?php
session_start();
try {
    $pdo=new PDO($connect,USER,PASS);
} catch (PDOException $e) {
 var_dump($e->getMessage());
 exit;
}
//delete_post
if(isset($_SESSION['account']['account_id'])){
    $sql=$pdo->prepare('UPDATE account SET login_flag = 1 WHERE account_id = ?');
    $sql->execute([$_SESSION['account']['account_id']]);
    $memberList = 'ログイン';
}else{
    $sql=$pdo->prepare('UPDATE account SET login_flag = 0 WHERE account_id = ?');
    $sql->execute([$_SESSION['account']['account_id']]);
    $memberList = 'ログアウト';
}


//jsonとして出力
header('Content-type: application/json');
echo json_encode($memberList,JSON_UNESCAPED_UNICODE);