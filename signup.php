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
        <form action="signup-output.php" method="post">
            <input type="hidden" name="id" id="id" value=<?=$_GET['id']?>>
            <input type="number" name="pas1" id="pas1" required>
            <input type="number" name="pas2" id="pas2" required>
            <input type="number" name="pas3" id="pas3" required>
            <input type="number" name="pas4" id="pas4" required>
            <button type="submit" class="btn1">新規登録</button>
        </form>
        <form action="login-input.php" method="get">
            <button type="submit" class="btn2">ログイン画面</button>
        </form>
    </div>
</div>
    <?php require 'default/footer.php'; ?>
</body>
</html>
