<?php require 'db/db-connect.php'; ?>
<?php
session_start();
$post_id = $_POST['post_id'];
try {
    $pdo=new PDO($connect,USER,PASS);
} catch (PDOException $e) {
 var_dump($e->getMessage());
 exit;
}
//delete_post
$sql=$pdo->prepare('UPDATE post SET delete_flag = 1 WHERE post_id = ? AND account_id = ?');
$sql->execute([$post_id, $_SESSION['account']['account_id']]);

$memberList = 'deletePost';
//jsonとして出力
header('Content-type: application/json');
echo json_encode($memberList,JSON_UNESCAPED_UNICODE);