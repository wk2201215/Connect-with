<?php session_start(); ?>
<?php require 'default/header-top.php'; ?>
<?php require 'default/header-menu.php'; ?>
<div id="container">

<form action="login-output.php" method="post">
    <input type="hidden" name="post_id" value="<?php $_GET['post_id']?>" />
    <?php if(isset($_GET['post_id'])) :?>
        <?='post'?>
    <?php else:?>
        <?='reply'?>
    <?php endif;?>
        
        <input type="submit" value=""/>
        <img src="Image-display.php?hogeA='<?php $_SESSION['photograph_path']?>'" alt="アイコン写真" />
        <label>メールアドレス</label>
        <textarea name="" cols="50" rows="5"></textarea>
        <input type="file" name="file" />
        
</form>

</div>
<?php require 'default/footer-menu.php'; ?>
<?php require 'default/footer-top.php'; ?>
