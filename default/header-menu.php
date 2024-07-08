
<header>
<div>
        <?=$_SESSION['account']['category_name']?>
        <!-- <input class="post" type="button" value="投稿"/> -->
</div>  
<div class="wrapper">
    <!-- <a href="#" class="fix-btn">問い合わせはこちら</a> -->
    <!-- <input class="fix-btn" type="button" value="＋" width="100" height="100"/> -->
    <input class="fix-btn" type="image" style="bottom: 40px;" src="./images/post_button.png" alt="投稿">
  <!-- <div class="box">&nbsp;</div> -->
  <?php
  if($_SESSION['authority'] == 1){
    require 'default/header-hamburger.php';
  }
  ?>
</div>
</header>