<?php
ob_start(); // 出力バッファリングを開始
session_start();

require 'db/db-connect.php';
require 'default/header.php';

//確認
$pdo2=new PDO($connect,USER,PASS);
$sql2=$pdo2->prepare('SELECT * FROM account_tentative WHERE account_name = ? AND account_password = ? AND mail_address = ? LIMIT 1');
$sql2->execute([$_POST['account_name'], $_POST['account_password'], $_POST['mail_address'],]);
$resultCount = $sql2->rowCount();
if($resultCount == 1){
    try {
        $pdo = new PDO($connect, USER, PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec('SET foreign_key_checks = 0');
    
        // 入力されたメールアドレスが既に存在するかチェック
        $sql_check = $pdo->prepare('SELECT * FROM account WHERE mail_address = ?');
        $sql_check->execute([$_POST['mail_address']]);
        $existing_account = $sql_check->fetch(PDO::FETCH_ASSOC);
    
        if (!$existing_account) {
            // パスワードをハッシュ化
            $hashed_password = password_hash($_POST['account_password'], PASSWORD_DEFAULT);
    
            $sql = $pdo->prepare('INSERT INTO account (account_name, mail_address, account_password) VALUES (?, ?, ?)');
            $sql->execute([
                $_POST['account_name'], $_POST['mail_address'], $hashed_password
            ]);
    
            // 登録完了後、top.phpにリダイレクト
            header('Location: category.php');
            exit();
        } else {
            // 既にメールアドレスが登録されている場合、エラーメッセージを表示し、リダイレクト
            header('Location: error.php?message=そのメールアドレスは既に登録されています。別のメールアドレスを使用してください。');
            exit();
        }
    } catch (PDOException $e) {
        echo "エラー: " . $e->getMessage();
    }
}

require 'default/footer.php';

ob_end_flush(); // 出力バッファの内容を出力し、バッファを終了
?>
