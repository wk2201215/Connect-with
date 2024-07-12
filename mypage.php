<?php
session_start();

require 'db/db-connect.php';
require 'default/header-top.php'; 


try {
    $pdo = new PDO($connect, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if($_GET['my']==1){
        // セッション変数がセットされていることを確認します
        if (isset($_SESSION['account']['account_id'])) {
            $userId = $_SESSION['account']['account_id'];
        } else {
            echo 'セッションが開始されていないか、アカウントIDが見つかりません。';
            exit;
        }  
    }else{
        $userId = $_GET['account_id'];
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

    // photograph_pathを取得
    $sql = 'SELECT photograph_path FROM photograph WHERE photograph_id = ?';
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$photographId]);
    $photograph = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($photograph) {
        $photographPath = htmlspecialchars($photograph['photograph_path']);
    } else {
        $photographPath = 'default.png';  // デフォルト画像のパス
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
    <title>マイページ</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 20px;
            background-image: url('./images/sky3.png'); 
            background-attachment: fixed;
            background-size: cover;
            background-position: center;
            
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
            background-image: url('images/<?php echo $photographPath; ?>');  /* ここに写真のパスを入れる */
            background-size: cover;
        }
        .profile-edit {
            display: inline-block;
            margin-top: 10px;
            padding: 5px 10px;
            /* border: 2px solid #d6adff; */
            /* border: 2px solid #ba55d3; */
            /* border: 2px solid rgb(171,135,241); */
            border: 2px solid rgb(137,26,226);
            border-radius: 20px;
            color: rgb(137,26,226);
            text-decoration: none;
            font-size: 14px;
        }
        .profile-edit:hover {
            background-color: rgb(171,135,241);
            color: white;
        }
        .profile-name, .profile-details {
            margin-top: 10px;
        }
        .big{
            zoom:1.3;
        }
        .h3-left{
            padding-right:220px;
        }
    </style>
</head>
<body>
    <div id="container">
    <div class="big">

    <div class="profile-username"><?php echo $mailAddress; ?></div>
    <div class="profile-picture"></div>
    <?php if($_GET['my']==1) : ?>
        <a href="profile_edit.php" class="profile-edit">プロフィール編集</a>
    <?php endif; ?>
    <div class="profile-name"><?php echo $accountName; ?></div>
    <div class="profile-details"><?php echo $selfIntroduction; ?></div>

    </div>
    <h3 class="h3-left">~投稿一覧~</h3>
<?php
$sql=$pdo->prepare('SELECT * FROM post INNER JOIN category ON post.category_id = category.category_id WHERE delete_flag=0 AND account_id = ? ORDER BY post_id DESC');
$sql->execute([
    $userId
]);

require 'default/post.php';
echo '</div>';
?>


</body>
</html>

<?php require 'default/footer-menu.php'; ?>
<?php require 'default/footer-top.php'; ?>
