<?php
$id = $_POST['id'];

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
// データ取得
$sql = "SELECT * FROM post WHERE post_id = ?";
$stmt = ($dbh->prepare($sql));
$stmt->execute(array($id));

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