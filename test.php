<?php require 'db/db-connect.php'; ?>
<?php
session_start();
// $post_id = $_POST['post_id'];
$post_id = 33;
try {
    $pdo=new PDO($connect,USER,PASS);
} catch (PDOException $e) {
 var_dump($e->getMessage());
 exit;
}

// データ取得 good判定
$sql3=$pdo->prepare('SELECT * FROM good WHERE post_id = ? AND account_id = ? LIMIT 1');
// $sql3->execute([$post_id,$_SESSION['account']['account_id']]);
$sql3->execute([33,17]);
$resultCount = $sql3->rowCount();

var_dump($sql3);
echo "<br>";
echo "empty". empty($sql3)."<br>";
echo "is_null".is_null($sql3)."<br>";
echo "isset".isset($sql3)."<br>";

if($resultCount == 1){
    //データ更新 -
    // $sql2=$pdo->prepare('UPDATE post SET good_count = good_count-1 WHERE post_id=?');
    // $sql2->execute([$post_id]);
    // //
    // $sql4=$pdo->prepare('DELETE FROM good WHERE post_id = ? AND account_id = ?');
    // $sql4->execute([$post_id, $_SESSION['account']['account_id']]);
    echo 'yes';
}else{
    echo 'no';
    // //データ更新 +
    // $sql2=$pdo->prepare('UPDATE post SET good_count = good_count+1 WHERE post_id=?');
    // $sql2->execute([$post_id]);
    // //
    // $sql4=$pdo->prepare('INSERT INTO good values (?, ?,DEFAULT)');
    // $sql4->execute([$post_id, $_SESSION['account']['account_id']]);
}


