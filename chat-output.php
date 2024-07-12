<?php session_start(); ?>
<?php require 'db/db-connect.php'; ?>
<?php
$pdo=new PDO($connect,USER,PASS);
//imag
$image = uniqid(mt_rand(), true);//ファイル名をユニーク化
$image .= '.' . substr(strrchr($_FILES['image']['name'], '.'), 1);//アップロードされたファイルの拡張子を取得
$file = "images/$image";
$sql2 = "INSERT INTO photograph(photograph_path) VALUES (:image)";
$stmt = $pdo->prepare($sql2);
$stmt->bindValue(':image', $image, PDO::PARAM_STR);
//初期アイコン
$item2['photograph_id'] = 0;
if (!empty($_FILES['image']['name'])) {//ファイルが選択されていれば$imageにファイル名を代入
move_uploaded_file($_FILES['image']['tmp_name'], './images/' . $image);//imagesディレクトリにファイル保存
    if (exif_imagetype($file)) {//画像ファイルかのチェック
        $message = '画像をアップロードしました';
        $stmt->execute();
        $sql3=$pdo->query('SELECT photograph_id FROM photograph ORDER BY photograph_id DESC
        LIMIT 1');
        $item2=$sql3->fetch();
    } else {
        $message = '画像ファイルではありません';
        header('Location:chat-input.php');
        exit();
    } 
}

// foreach($_POST['mail'] as $row){
//     $sql=$pdo->prepare('SELECT * FROM account WHERE mail_address = ?');
//     $sql->execute([$row]);
//     $item=$sql->fetchAll();
// }
if($_POST['to']==='on'){
    $sql=$pdo->prepare('SELECT * FROM account WHERE mail_address = ? LIMIT 1');
    $sql->execute([$_POST['mail'][0]]);
    $item=$sql->fetch();
    // $itemcount=$sql->rowCount();
    // if($itemcount == 0){
    if(!isset($item['account_id'])){
        $message='招待しようとしたメールアドレスの相手はいません';
        header('Location:chat-input.php?to=1&message='.$message);
        exit();
    }
    $sql_check=$pdo->prepare('SELECT * FROM chatmember INNER JOIN chatroom ON chatmember.chatroom_id = chatroom.chatroom_id WHERE account_id = ? AND one_on_one = ? LIMIT 1');
    $sql_check->execute([$_SESSION['account']['account_id'], $_SESSION['account']['account_id']]);
    $resultCount = $sql_check->rowCount();

    $sql_check2=$pdo->prepare('SELECT * FROM chatmember_invitation INNER JOIN chatroom ON chatmember_invitation.chatroom_id = chatroom.chatroom_id WHERE account_id = ? AND one_on_one = ? AND invitation_id = ? LIMIT 1');
    $sql_check2->execute([$item['account_id'], $_SESSION['account']['account_id'], $_SESSION['account']['account_id']]);
    $resultCount2 = $sql_check2->rowCount();

    if($resultCount == 1 || $resultCount2 == 1){
        $message='すでに招待しています';
        header('Location:chat-input.php?to=1&message='.$message);
        exit();
    }
    $sql_input=$pdo->prepare('INSERT INTO chatroom (chatroom_name1, chatroom_name2, number_people, photograph_id, one_on_one) VALUES (?, ?, ?, ?, ?)');
    if($_SESSION['account']['account_id'] < $item['account_id']){
        $sql_input->execute([$_SESSION['account']['account_name'], $item['account_name'], 2, $item2['photograph_id'], $_SESSION['account']['account_id']]);
    }else{
        $sql_input->execute([$item['account_name'], $_SESSION['account']['account_name'], 2, $item2['photograph_id'], $_SESSION['account']['account_id']]);
    }
}else{
    $sql_input=$pdo->prepare('INSERT INTO chatroom (chatroom_name1, chatroom_name2, number_people, photograph_id, one_on_one) VALUES (?, ?, ?, ?, DEFAULT)');
    $sql_input->execute([$_POST['chatroom_name'], $_SESSION['account']['account_id'], count($_POST['mail']), $item2['photograph_id']]);
}

$inserted_id = $pdo->lastInsertId();

$sql_m=$pdo->prepare('INSERT INTO chatmessage (chatroom_id, chat_text, account_id) VALUES (?, ?, ?)');
$sql_m->execute([$inserted_id, '新しくチャットルームを作りました', 0]);

$sql_input3=$pdo->prepare('INSERT INTO chatmember (chatroom_id, account_id) VALUES (?, ?)');
$sql_input3->execute([$inserted_id, $_SESSION['account']['account_id']]);

// $member = [
//     $item['account_id']
// ];
$message = '';
//memberテーブル
foreach($_POST['mail'] as $row){
    $sql_id=$pdo->prepare('SELECT * FROM account WHERE mail_address = ? LIMIT 1');
    $sql_id->execute([$row]);
    $item3=$sql_id->fetch();
    if(!isset($item3['account_id'])){
        $message='招待しようとしたメールアドレスの相手はいません2';
        header('Location:chat-input.php?to=1&message='.$message);
        exit();
    }
    $sql_input2=$pdo->prepare('INSERT INTO chatmember_invitation  (chatroom_id, account_id, invitation_id) VALUES (?, ?, ?)');
    $sql_input2->execute([$inserted_id, $item3['account_id'], $_SESSION['account']['account_id']]);
    $message .= $item3['account_name']."、";
}
$message = rtrim($message, "、");
$message .= 'を招待しました';

$sql_m2=$pdo->prepare('INSERT INTO chatmessage (chatroom_id, chat_text, account_id) VALUES (?, ?, ?)');
$sql_m2->execute([$inserted_id, $message, 0]);

header('Location:chat-top.php');
exit();
?>