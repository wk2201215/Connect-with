
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
  if($_SESSION['account']['authority'] == 1){
    require 'default/header-hamburger.php';
  }
  ?>
</div>
<div id="cs">
        :
    </div>
    <div id="popup-wrapper">
      <div id="popup-inside">
        <div id="close">x</div>
        <div id="theme">
          <h2>テーマ変更</h2>
          <button class="color" id="default" data-id="1"></button>
          <button class="color" id="black" data-id="2"></button>
          <button class="color" id="white" data-id="3"></button>
          <button class="color" id="blue" data-id="4"></button>
          <button class="color" id="red" data-id="5"></button>
        </div>
      </div>
    </div>
</header>