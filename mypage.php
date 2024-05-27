<?php
session_start();

require 'db/db-connect.php';

try {
    $pdo = new PDO($connect, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_SESSION['account']['account_id'])) {
        $userId = $_SESSION['account']['account_id'];
    } else {
        echo 'セッションが開始されていないか、アカウントIDが見つかりません。';
        exit;
    }

    $sql = 'SELECT mail_address, photograph_id, account_name, self_introduction FROM account WHERE account_id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$userId]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        $mailAddress = htmlspecialchars($user['mail_address']);
        $photographId = htmlspecialchars($user['photograph_id']);
        $accountName = htmlspecialchars($user['account_name']);
        $selfIntroduction = htmlspecialchars($user['self_introduction']);
    } else {
        echo 'ユーザー情報が見つかりません。';
        exit;
    }
} catch (PDOException $e) {
    echo "エラー: " . $e->getMessage();
    exit;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>プロフィールレイアウト</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 20px;
        }
        .profile-username {
            font-size: 20px;
            margin-bottom: 10px;
        }
        .profile-picture {
            width: 100px;
            height: 100px;
            background-color: #ccc;
            border-radius: 50%;
            margin: 0 auto;
            background-image: url('path/to/images/<?php echo $photographId; ?>');
            background-size: cover;
        }
        .profile-edit {
            display: inline-block;
            margin-top: 10px;
            padding: 5px 10px;
            border: 1px solid #ff69b4;
            border-radius: 20px;
            color: #ff69b4;
            text-decoration: none;
            font-size: 14px;
        }
        .profile-edit:hover {
            background-color: #ff69b4;
            color: white;
        }
        .profile-name, .profile-details {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="profile-username">@<?php echo $mailAddress; ?></div>
    <div class="profile-picture"></div>
    <a href="profile_edit.php" class="profile-edit">プロフィール編集</a>
    <div class="profile-name"><?php echo $accountName; ?></div>
    <div class="profile-details"><?php echo $selfIntroduction; ?></div>
</body>
</html>
