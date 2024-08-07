<?php
ob_start(); // 出力バッファリングを開始
session_start();

require 'db/db-connect.php';
require 'default/header.php';

//確認
$pdo2=new PDO($connect,USER,PASS);
$sql3=$pdo2->prepare('SELECT * FROM account_tentative WHERE id = ? AND pas1=? AND pas2=? AND pas3=? AND pas4=? LIMIT 1');
$sql3->execute([$_POST['id'], $_POST['pas1'],$_POST['pas2'],$_POST['pas3'],$_POST['pas4']]);
$item_pas = $sql3->rowCount();

$sql2=$pdo2->prepare('SELECT * FROM account_tentative WHERE id = ? LIMIT 1');
$sql2->execute([$_POST['id']]);
$resultCount = $sql2->rowCount();

$sql_id=$pdo2->prepare('SELECT * FROM account_tentative WHERE id = ? LIMIT 1');
$sql_id->execute([$_POST['id']]);
$item_id=$sql_id->fetch();

if($resultCount == 1){
    if($item_pas==1){
    try {
        $pdo = new PDO($connect, USER, PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec('SET foreign_key_checks = 0');
    
        // 入力されたメールアドレスが既に存在するかチェック
        $sql_check = $pdo->prepare('SELECT * FROM account WHERE mail_address = ?');
        $sql_check->execute([$item_id['mail_address']]);
        $existing_account = $sql_check->fetch(PDO::FETCH_ASSOC);
    
        if (!$existing_account) {
            // パスワードをハッシュ化
            $hashed_password = password_hash($item_id['account_password'], PASSWORD_DEFAULT);
    
            $sql = $pdo->prepare('INSERT INTO account (account_name, mail_address, account_password) VALUES (?, ?, ?)');
            $sql->execute([
                $item_id['account_name'], $item_id['mail_address'], $hashed_password
            ]);
            $sql3=$pdo->prepare('DELETE FROM account_tentative WHERE account_name = ? AND account_password = ? AND mail_address = ? LIMIT 1');
            $sql3->execute([$item_id['account_name'], $item_id['account_password'], $item_id['mail_address']]);
            //セッション登録
            $sql6 = $pdo->prepare('SELECT * FROM account WHERE mail_address = ?');
            $sql6->execute([$item_id['mail_address']]);
            foreach($sql6 as $row){
                $_SESSION['account'] = [
                    'account_id' => $row['account_id'],
                    'mail_address' => $row['mail_address'],
                    'account_password' => $row['account_password'],
                    'account_name' => $row['account_name'],
                    'photograph_id' => $row['photograph_id'],
                    'self_introduction' => $row['self_introduction'],
                    'category_id' => $row['category_id'],
                    'theme_id' => $row['theme_id'],
                    'authority' => $row['authority'],
                    'delete_flag' => $row['delete_flag']
                ];
            }
            $sql4 = $pdo->prepare('SELECT * FROM photograph WHERE photograph_id = ?');
            $sql4->execute([$_SESSION['account']['photograph_id']]);
            $path=$sql4->fetch();
            $_SESSION['account']['photograph_path'] = $path['photograph_path'];
            $sql5 = $pdo->prepare('SELECT * FROM category WHERE category_id = ?');
            $sql5->execute([$_SESSION['account']['category_id']]);
            $path=$sql5->fetch();
            $_SESSION['account']['category_name'] = $path['category_name'];
            //chatroom作成
            $sql_room=$pdo->prepare('INSERT INTO chatroom (chatroom_name1, chatroom_name2, number_people, one_on_one) VALUES (?, ?, ?, ?)');
            $sql_room->execute([$_SESSION['account']['account_name'], $_SESSION['account']['account_name'], 2, $_SESSION['account']['account_id']]);
            $inserted_id = $pdo->lastInsertId();
            $sql_member=$pdo->prepare('INSERT INTO chatmember (chatroom_id, account_id, invitation_id) VALUES (?, ?, ?)');
            $sql_member->execute([$inserted_id, $_SESSION['account']['account_id'], $_SESSION['account']['account_id']]);
            $sql_m=$pdo->prepare('INSERT INTO chatmessage (chatroom_id, chat_text, account_id) VALUES (?, ?, ?)');
            $sql_m->execute([$inserted_id, '新しくチャットルームを作りました', $_SESSION['account']['account_id']]);
            $sql_m2=$pdo->prepare('INSERT INTO chatmessage (chatroom_id, chat_text, account_id) VALUES (?, ?, ?)');
            $sql_m2->execute([$inserted_id, 'こちらは個人のチャットルームです', $_SESSION['account']['account_id']]);
            // 登録完了後、top.phpにリダイレクト
            header('Location: category3.php');
            exit();
        } else {
            // 既にメールアドレスが登録されている場合、エラーメッセージを表示し、リダイレクト
            header('Location: error.php?message=そのメールアドレスは既に登録されています。別のメールアドレスを使用してください。');
            exit();
        }
    } catch (PDOException $e) {
        echo "エラー: " . $e->getMessage();
    }
    }else{
        header('Location: error.php?message=パスワードが違います');
        exit();
    }
}else{
    header('Location: error.php?message=正常に仮登録がされませんでした');
    exit();
}

require 'default/footer.php';

ob_end_flush(); // 出力バッファの内容を出力し、バッファを終了
?>
