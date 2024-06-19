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

// データ取得 good判定
$sql3=$pdo->prepare('SELECT * FROM good WHERE post_id = ? AND account_id = ? LIMIT 1');
$sql3->execute([$post_id,$_SESSION['account']['account_id']]);
$resultCount = $sql3->rowCount();


if($resultCount == 1){
    //データ更新 -
    $sql2=$pdo->prepare('UPDATE post SET good_count = good_count-1 WHERE post_id=?');
    $sql2->execute([$post_id]);
    //
    $sql4=$pdo->prepare('DELETE FROM good WHERE post_id = ? AND account_id = ?');
    $sql4->execute([$post_id, $_SESSION['account']['account_id']]);
}else{
    //データ更新 +
    $sql2=$pdo->prepare('UPDATE post SET good_count = good_count+1 WHERE post_id=?');
    $sql2->execute([$post_id]);
    //
    $sql4=$pdo->prepare('INSERT INTO good values (?, ?,DEFAULT)');
    $sql4->execute([$post_id, $_SESSION['account']['account_id']]);
}

// データ取得 good数
$sql=$pdo->prepare('SELECT * FROM post WHERE post_id = ?');
$sql->execute([$post_id]);


//あらかじめ配列を生成しておき、while文で回します。
$memberList = array();
while($row = $sql->fetch(PDO::FETCH_ASSOC)){
 $memberList[]=array(
  'post_id' =>$row['post_id'],
  'account_id'=>$row['account_id'],
  'category_id'=>$row['category_id'],
  'post_time'=>$row['post_time'],
  'post_content'=>$row['post_content'],
  'photograph_id'=>$row['photograph_id'],
  'good_count'=>$row['good_count'],
  'reply_id'=>$row['reply_id'],
  'delete_flag'=>$row['delete_flag']
 );
}
//jsonとして出力
header('Content-type: application/json');
echo json_encode($memberList,JSON_UNESCAPED_UNICODE);