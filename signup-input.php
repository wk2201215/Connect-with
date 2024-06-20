<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>新規登録</title>
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
        <form action="signup-tentative.php" method="post">
            <div class="form-group">
                <label for="name">名前</label>
                <input type="text" name="account_name" id="name" value="<?php echo $name; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">メールアドレス</label>
                <input type="email" name="mail_address" id="email" value="<?php echo $address; ?>" required>
            </div>
            <div class="form-group">
                <label for="password">パスワード</label>
                <input type="password" name="account_password" id="password" value="<?php echo $password; ?>" required>
            </div><br>
            <button type="submit" class="btn">新規登録</button>
        </form>
    </div>
</div>
    <?php require 'default/footer.php'; ?>
</body>
</html>
