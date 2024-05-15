<?php session_start(); ?>
<?php require 'default/header.php'; ?>

<div class="search">
<input class="keyword" type="text" name="keyword" placeholder="  キーワード検索  ">
<button class="user_button" type="submit" name="user_search" value="ユーザー検索">🔍</button>
<button class="user_button" type="submit" name="hashtag" value="ハッシュタグ検索">＃</button>
<button class="user_button" type="submit" name="garbage_can" src="./images/🗑️.png" value="ユーザー削除">🗑️</button>
</div>

<?php
    unset($_SESSION['account']);
    $pdo=new PDO($connect, USER, PASS);
    $sql=$pdo->prepare('select * from account where mail-address=?');
    $sql->execute([$_POST['mail-address']]);
?>

<input type="image" name="garbage_can" src="./images/🗑️.png"  alt="ユーザー削除" value="ユーザー削除">

<?php require 'default/footer.php'; ?>