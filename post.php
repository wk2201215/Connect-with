<?php require 'function/not-access.php'; ?>
<?php require 'default/header-top-post.php'; ?>
<?php require 'default/header-menu.php'; ?>

<form action="login-output.php" method="post">
    <h1>post</h1>
        <label>メールアドレス</label>
        <input type="text" name="mail_address" id="mail_address" required>
            </div>
            <button type="submit" class="btn">ログイン</button>
            <?php if(isset($_GET['hogeA'])): ?>
                <p class="error"><?php echo $_GET['hogeA']; ?></p>
            <?php endif; ?>
</form>

<?php require 'default/footer-menu.php'; ?>
<?php require 'default/footer-top.php'; ?>
