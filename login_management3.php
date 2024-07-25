<?php require 'db/db-connect.php'; ?>
<?php
session_start();
try {
    $pdo=new PDO($connect,USER,PASS);
} catch (PDOException $e) {
 var_dump($e->getMessage());
 exit;
}
$sql=$pdo->query('SELECT * FROM login_management WHERE login_time > DATE_ADD(NOW(), INTERVAL - 1 MINUTE) AND login_time <= NOW() GROUP BY account_id');
$resultCount = $sql->rowCount();
$memberList = [
    $resultCount,0,0,0,0,0,0,0,0,0,
               0,0,0,0,0,0,0,0,0,0,
               0,0,0,0,0
];

for($i=1; $i<=24; $i++){
    $sql2=$pdo->prepare('SELECT * FROM login_management WHERE login_time > DATE_ADD(NOW(), INTERVAL - ? MINUTE) AND login_time <= DATE_ADD(NOW(), INTERVAL - ? MINUTE) GROUP BY account_id');
    $sql2->execute([$i+1,$i]);
    $resultCount2 = $sql2->rowCount();
    $memberList[$i] = $resultCount2;
}




//jsonとして出力
header('Content-type: application/json');
echo json_encode($memberList,JSON_UNESCAPED_UNICODE);