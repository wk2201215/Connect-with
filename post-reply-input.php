<?php session_start(); ?>
<?php require 'function/not-access.php'; ?>
<?php require 'db/db-connect.php'; ?>
<?php require 'default/header-top.php'; ?>

<div id="container">

<form action="post-reply-output.php" method="post" enctype="multipart/form-data">
   
    
    <?php if(isset($_GET['post_id'])) :?>
        <?='<input type="submit" value="REPLY"/>'?>
        
        <input type="hidden" name="post_id" value="<?=$_GET['post_id']?>" />
        <input type="hidden" name="category_id" value="<?=$_GET['category_id']?>" />
    <?php else:?>
        <?='<input type="submit" value="POST"/>'?>
        
        <select name="category">
        <?php
        $pdo=new PDO($connect,USER,PASS);
        $sql=$pdo->query('SELECT * FROM category');
        foreach($sql as $row){
            echo '<option value="'.$row['category_id'].'">'.$row['category_name'].'</option>';
        }
        ?>
        </select>
    <?php endif;?>
        
        <!-- <input type="submit" value=""/> -->
        
        <?= '<img src="Image-display.php?hogeA='.$_SESSION['account']['photograph_path'].'" alt="投稿写真" class="icon-image"/>'?>
        

        
        <textarea name="post_content" cols="50" rows="5" required></textarea>
        <input type="file" name="image" />
</form>

</div>
<?php require 'default/footer-menu.php'; ?>
<?php require 'default/footer-top.php'; ?>
