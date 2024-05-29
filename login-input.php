<?php session_start(); ?>
<?php require 'default/header.php'; ?>

<link rel="stylesheet" href="css/login.css">

<div class="container">
    <div class="login-form">
        <form action="login-output.php" method="post">
            <h1>ログイン</h1>
            <?php
                unset($_SESSION);
            ?>
            <div class="form-group">
                <label for="mail_address">メールアドレス</label>
                <input type="text" name="mail_address" id="mail_address" required>
            </div>
            <div class="form-group">
                <label for="account_password">パスワード</label>
                <input type="password" name="password" id="account_password" required>
            </div>
            <button type="submit" class="btn">ログイン</button>
            <?php if(isset($_GET['hogeA'])): ?>
                <p class="error"><?php echo $_GET['hogeA']; ?></p>
            <?php endif; ?>
        </form>
        <form action="signup-input.php" method="post">
            <button type="submit" class="btn-secondary">新規登録</button>
        </form>
    </div>
</div>

<?php require 'default/footer.php'; ?>
