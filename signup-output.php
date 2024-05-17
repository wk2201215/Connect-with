<?php
session_start();

require 'db/db-connect.php';
require 'default/header.php';

try {
    $pdo = new PDO($connect, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec('SET foreign_key_checks = 0');

    // 入力されたメールアドレスが既に存在するかチェック
    $sql_check = $pdo->prepare('SELECT * FROM account WHERE mail_address = ?');
    $sql_check->execute([$_POST['mail_address']]);
    $existing_account = $sql_check->fetch(PDO::FETCH_ASSOC);

    if (!$existing_account) {
        if (isset($_SESSION['account'])) {
            $id = $_SESSION['account']['account_id'];

            // パスワードをハッシュ化
            $hashed_password = password_hash($_POST['account_password'], PASSWORD_DEFAULT);

            $sql = $pdo->prepare('UPDATE account SET account_name=?, mail_address=?, account_password=? WHERE id=?');
            $sql->execute([
                $_POST['account_name'], $_POST['mail_address'], $hashed_password, $id
            ]);
            $_SESSION['account'] = [
                'account_id' => $id,
                'account_name' => $_POST['account_name'],
                'mail_address' => $_POST['mail_address'],
                'account_password' => $hashed_password
            ];
            echo 'お客様の情報を更新しました。';
        } else {
            // パスワードをハッシュ化
            $hashed_password = password_hash($_POST['account_password'], PASSWORD_DEFAULT);

            $sql = $pdo->prepare('INSERT INTO account (account_name, mail_address, account_password) VALUES (?, ?, ?)');
            $sql->execute([
                $_POST['account_name'], $_POST['mail_address'], $hashed_password
            ]);

            echo 'お客様情報を登録しました。';
        }
    } else {
        echo 'そのメールアドレスは既に登録されています。別のメールアドレスを使用してください。';
    }
} catch (PDOException $e) {
    echo "エラー: " . $e->getMessage();
}

require 'default/footer.php';
?>
