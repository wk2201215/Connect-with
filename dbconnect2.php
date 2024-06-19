<?php
session_start();
$post_id = $_POST['post_id'];
// $gj = $_POST['gj'];

// データベース接続

$host = 'mysql302.phy.lolipop.lan';
$dbname = 'LAA1517442-postingapp24';
$dbuser = 'LAA1517442';
$dbpass = 'post0418';

try {
$dbh = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8mb4", $dbuser,$dbpass, array(PDO::ATTR_EMULATE_PREPARES => false));
} catch (PDOException $e) {
 var_dump($e->getMessage());
 exit;
}

// データ取得 good判定
$sql3 = "SELECT * FROM good WHERE account_id = ? LIMIT 1";
$stmt3 = ($dbh->prepare($sql3));
$stmt3->execute(array($_SESSION['account']['account_id']));
if(isset($stem3)){
    //データ更新 -
    $sql2 = "UPDATE post SET good_count = good_count-1 WHERE post_id=?";
    $stmt2 = ($dbh->prepare($sql2));
    $stmt2->execute(array($post_id));
}else{
    //データ更新 +
    $sql2 = "UPDATE post SET good_count = good_count+1 WHERE post_id=?";
    $stmt2 = ($dbh->prepare($sql2));
    $stmt2->execute(array($post_id));
}

// データ取得 good数
$sql = "SELECT * FROM post WHERE post_id = ?";
$stmt = ($dbh->prepare($sql));
$stmt->execute(array($post_id));


//あらかじめ配列を生成しておき、while文で回します。
$memberList = array();
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
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