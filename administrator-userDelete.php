<?php require 'db/db-connect.php';?>
<?php session_start(); ?>
<?php require 'default/header.php'; ?>

<div class="search">
<input class="keyword" type="text" name="keyword" placeholder="  キーワード検索  ">
<button class="user_button" type="submit" name="user_search" value="ユーザー検索">🔍</button>
<button class="user_button" type="submit" name="hashtag" value="ハッシュタグ検索">＃</button>
<!-- <button class="user_button" type="submit" name="garbage_can" src="./images/🗑️.png" value="ユーザー削除">🗑️</button> -->
</div>

<?php
    // ユーザー情報を取得
    $user_id=1;
    $pdo=new PDO($connect, USER, PASS);
    $sql = "SELECT account_name, mail_address FROM account WHERE account_id = $user_id";
    $result = $pdo->query($sql);

    foreach($result as $val) {
        $user_name = $val['account_name'];
        $user_email = $val['mail_address'];
    }

    echo 'name: ',$user_name,'<br>';
    echo 'email address: ',$user_email;

    // if ($result->num_rows > 0) {
    //     // 結果をフェッチ
    //     $user = $result->fetch_assoc();
    //     $user_name = $user['account_name'];
    //     $user_email = $user['mail_address'];
    // } else {
    //     echo "User not found.";
    //     exit;
    // }

    // 接続を閉じる
    // $pdo->close();
    ?>

<button class="user_button" type="submit" name="garbage_can" value="ユーザー削除">🗑️</button>

<?php require 'default/footer.php'; ?>
