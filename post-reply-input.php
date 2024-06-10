<?php require 'db/db-connect.php'; ?>
<?php session_start(); ?>
<?php require 'default/header-top.php'; ?>
<?php require 'default/header-menu.php'; ?>
<div id="container">

<form action="post-reply-output.php" method="post">
    <input type="hidden" name="post_id" value="<?php $_GET['post_id']?>" />
    <?php if(isset($_GET['post_id'])) :?>
        <?='<input type="submit" value="REPLY"/>'?>
    <?php else:?>
        <?='<input type="submit" value="POST"/>'?>
    <?php endif;?>
        
        <!-- <input type="submit" value=""/> -->
        
        <?= '<img src="Image-display.php?hogeA='.$_SESSION['photograph_path'].'" alt="投稿写真" />'?>
        <label>内容</label>
        <textarea name="" cols="50" rows="5"></textarea>
        <input type="file" name="file" />

        <select name="category">
        <?php
        $pdo=new PDO($connect,USER,PASS);
        $sql=$pdo->query('SELECT * FROM category');
        foreach($sql as $row){
            echo '<option value="'.$row['category_id'].'">'.$row['category_name'].'</option>';
        }
        ?>
        </select>
</form>

</div>
<?php require 'default/footer-menu.php'; ?>
<?php require 'default/footer-top.php'; ?>
