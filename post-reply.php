<?php session_start(); ?>
<?php require 'default/header-top.php'; ?>
<?php require 'default/header-menu.php'; ?>
<div id="container">

<form action="login-output.php" method="post">
    <input type="hidden" name="post_id" value="<?php $_GET['post_id']?>" />
    <h1>post</h1>
        <input type="submit" value="投稿"/>
        <img src="Image-display.php?hogeA='<?php $_SESSION['']?>'" alt="アイコン写真" />
        <label>メールアドレス</label>
        <textarea name="" cols="50" rows="5"></textarea>
        <input type="file" name="file" />
        
</form>

</div>
<?php require 'default/footer-menu.php'; ?>
<?php require 'default/footer-top.php'; ?>
