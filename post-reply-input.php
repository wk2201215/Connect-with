<?php session_start(); ?>
<?php require 'default/header-top.php'; ?>
<?php require 'default/header-menu.php'; ?>
<div id="container">

<form action="post-reply-output.php" method="post">
    <input type="hidden" name="post_id" value="<?php $_GET['post_id']?>" />
    <?php if(isset($_GET['post_id'])) :?>
        <?='<input type="submit" value="POST"/>'?>
    <?php else:?>
        <?='<input type="submit" value="REPLY"/>'?>
    <?php endif;?>
        
        <!-- <input type="submit" value=""/> -->
        
        <?= '<img src="Image-display.php?hogeA='.$_SESSION['photograph_path'].'" alt="投稿写真" />'?>
        <label>内容</label>
        <textarea name="" cols="50" rows="5"></textarea>
        <input type="file" name="file" />
        
        <select name="category">
          <option value="apple">りんご</option>
          <option value="orange">みかん</option>
          <option value="grape">ブドウ</option>
        </select>
        
</form>

</div>
<?php require 'default/footer-menu.php'; ?>
<?php require 'default/footer-top.php'; ?>
