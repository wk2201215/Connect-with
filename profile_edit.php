<?php
session_start();

require 'db/db-connect.php';

try {
    $pdo = new PDO($connect, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // セッション変数がセットされていることを確認します
    if (isset($_SESSION['account']['account_id'])) {
        $userId = $_SESSION['account']['account_id'];
    } else {
        echo 'セッションが開始されていないか、アカウントIDが見つかりません。';
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $accountName = $_POST['account_name'];
        $mailAddress = $_POST['mail_address'];
        $selfIntroduction = $_POST['self_introduction'];

        $pdo->beginTransaction();

        try {
            // プロフィール画像のアップロード処理
            if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
                $uploadDir = '/home/users/0/mods.jp-aso2201215/web/Connect_with/program/images/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);  // ディレクトリが存在しない場合は作成
                }
                $uploadFile = $uploadDir . basename($_FILES['profile_picture']['name']);

                if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $uploadFile)) {
                    // accountテーブルから現在のphotograph_idを取得
                    $sql = 'SELECT photograph_id FROM account WHERE account_id = ?';
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([$userId]);
                    $user = $stmt->fetch(PDO::FETCH_ASSOC);
                    $currentPhotographId = $user['photograph_id'];

                    if ($currentPhotographId) {
                        // photographテーブルのレコードを更新
                        $sql = 'UPDATE photograph SET photograph_path = ? WHERE photograph_id = ?';
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute([basename($_FILES['profile_picture']['name']), $currentPhotographId]);
                    } else {
                        // photographテーブルに写真情報を挿入
                        $sql = 'INSERT INTO photograph (photograph_path) VALUES (?)';
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute([basename($_FILES['profile_picture']['name'])]);

                        // 挿入した写真のIDを取得
                        $photographId = $pdo->lastInsertId();

                        // accountテーブルを更新
                        $sql = 'UPDATE account SET photograph_id = ? WHERE account_id = ?';
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute([$photographId, $userId]);
                    }
                } else {
                    throw new Exception('ファイルのアップロードに失敗しました。');
                }
            }

            // accountテーブルを更新
            $sql = 'UPDATE account SET account_name = ?, mail_address = ?, self_introduction = ? WHERE account_id = ?';
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$accountName, $mailAddress, $selfIntroduction, $userId]);

            $pdo->commit();
        } catch (Exception $e) {
            $pdo->rollBack();
            throw $e;
        }

        // プロフィールが更新された後、mypage.phpにリダイレクト
        header("Location: mypage.php");
        exit;
    } else {
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
    }
} catch (PDOException $e) {
    ob_start(); // 出力バッファリングを開始
    echo "エラー: " . $e->getMessage();
    ob_end_flush(); // 出力バッファリングを終了してバッファ内容を出力
    exit; // スクリプトの実行を停止
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>プロフィール編集</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-weight: bold;
            text-align: center;
            padding: 20px;
        }
        .profile-picture {
            width: 100px;
            height: 100px;
            background-color: #ccc;
            border-radius: 50%;
            margin: 0 auto;
            background-image: url('images/<?php echo $photographPath; ?>');  /* ここに写真のパスを入れる */
            background-size: cover;
            position: relative;
        }
        .profile-picture input {
            display: none;
        }
        .profile-picture label {
            position: absolute;
            bottom: 0;
            right: 0;
            background: #5cb85c;
            border-radius: 50%;
            padding: 5px;
            cursor: pointer;
        }
        .profile-edit-form {
            max-width: 400px;
            margin: 0 auto;
            text-align: left;
        }
        .profile-edit-form div {
            margin-bottom: 10px;
        }
        .profile-edit-form label {
            display: block;
            margin-bottom: 5px;
        }
        .profile-edit-form input[type="text"],
        .profile-edit-form textarea {
            width: 100%;
            padding: 8px;
            border-radius: 30px;
            border-
            box-sizing: border-box;
        }
        




        .profile-edit-form button a {
            background: #d6adff;
            border-radius: 40px;
            position: relative;
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin: 0 auto;
            max-width: 260px;
            padding: 10px 25px;
            color: #313131;
            transition: 0.3s ease-in-out;
            font-weight: 500;
        }
        .profile-edit-form button a:hover {
            background: #313131;
            color: #FFF;
        }
        .profile-edit-form button a:after {
            content: '';
            width: 5px;
            height: 5px;
            border-top: 3px solid #313131;
            border-right: 3px solid #313131;
            transform: rotate(45deg) translateY(-50%);
            position: absolute;
            top: 50%;
            right: 20px;
            border-radius: 1px;
            transition: 0.3s ease-in-out;
        }
        .profile-edit-form button a:hover:after {
            border-color: #FFF;
        }








    </style>
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function(){
                const output = document.getElementById('profile-picture-preview');
                output.style.backgroundImage = `url(${reader.result})`;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</head>
<body>
    <h1>プロフィール編集</h1>
    <form action="profile_edit.php" method="post" class="profile-edit-form" enctype="multipart/form-data">
        <div class="profile-picture" id="profile-picture-preview">
            <input type="file" id="profile_picture" name="profile_picture" onchange="previewImage(event)">
            <label for="profile_picture">+</label>
        </div>
        <div>
            <label for="account_name">名前</label>
            <input type="text" id="account_name" name="account_name" value="<?php echo $accountName; ?>">
        </div>
        <div>
            <label for="mail_address">メールアドレス</label>
            <input type="text" id="mail_address" name="mail_address" value="<?php echo $mailAddress; ?>">
        </div>
        <div>
            <label for="self_introduction">自己紹介文</label>
            <textarea id="self_introduction" name="self_introduction"><?php echo $selfIntroduction; ?></textarea>
        </div>


        <div class="profile-edit-form button">
	    <a href="#">確定</a>
        </div>


    </form>
</body>
</html>
