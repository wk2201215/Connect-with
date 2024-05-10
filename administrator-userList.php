<?php session_start(); ?>
<?php require 'default/header.php'; ?>

<div class="search">
<input class="keyword" type="text" name="keyword" placeholder="  キーワード検索  ">
<button class="searchbutton" type="submit" name="user_search" value="ユーザー検索">🔍</button>
<button class="searchbutton" type="submit" name="hashtag" value="ハッシュタグ検索">＃</button>
</div>


<table class="table">
<!-- <?php
    foreach($sql as $row){

    }
?> -->
</table>


<?php require 'default/footer.php'; ?>