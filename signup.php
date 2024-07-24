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
            パスコードを打ち込んでください
            <br>
            <input type="hidden" name="id" id="id" value=<?=$_GET['id']?>>
            <input type="tel" name="pas1" id="pas1" class="pass1" required maxlength="1" onchange="inputCheck()" pattern="[0-9]{1,1}">
            <input type="tel" name="pas2" id="pas2" class="pass2" required maxlength="1" onchange="inputCheck()" pattern="[0-9]{1,1}">
            <input type="tel" name="pas3" id="pas3" class="pass3" required maxlength="1" onchange="inputCheck()" pattern="[0-9]{1,1}">
            <input type="tel" name="pas4" id="pas4" class="pass4" required maxlength="1" onchange="inputCheck()" pattern="[0-9]{1,1}">
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- headerjs -->
<script src="./script/signup.js"></script>
