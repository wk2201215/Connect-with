<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>管理者用メール送信</title>
    <link rel="stylesheet" href="./css/signup.css">

    <div class="video-background">
    <video autoplay muted loop id="background-video">
        <source src="movie/Connect With_signup2.mp4" type="video/mp4">
        お使いのブラウザは動画タグに対応していません。
    </video>
    </div>
</head>
<body>
    <?php require 'default/header.php'; ?>
        <?php
        $name = isset($_SESSION['account']['account_name']) ? htmlspecialchars($_SESSION['account']['account_name']) : '';
        $address = isset($_SESSION['account']['mail_address']) ? htmlspecialchars($_SESSION['account']['mail_address']) : '';
        // パスワードは表示しないことを推奨
        $password = '';
        ?>
<div class="container">
    <div class="signup-form">
        <form action="confirmation-signup-tentative.php" method="post">
            <div class="form-group">
                <label for="email">メールアドレス</label>
                <input type="email" name="mail_address" id="email" value="<?php echo $address; ?>" required>
            </div>
            <button type="submit" class="btn1">送信</button>
        </form>
        <form action="administrator-signup-input.php" method="get">
            <button type="submit" class="btn2">管理者用新規登録</button>
        </form>
    </div>
</div>
    <?php require 'default/footer.php'; ?>
</body>
</html>
