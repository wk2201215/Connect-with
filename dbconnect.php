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