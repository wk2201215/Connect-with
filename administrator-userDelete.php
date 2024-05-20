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
    $sql = "SELECT account_name, mail_address FROM accounts WHERE account_id = $user_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // 結果をフェッチ
        $user = $result->fetch_assoc();
        $user_name = $user['account_name'];
        $user_email = $user['mail_address'];
    } else {
        echo "User not found.";
        exit;
    }

    // 接続を閉じる
    $conn->close();
    ?>
    // unset($_SESSION['account']);
    // $pdo=new PDO($connect, USER, PASS);
    // $sql=$pdo->prepare('select * from account where account_name=?');
    // $sql->execute([$_POST['account_name']]);
    // foreach($sql as $row) {

    //     var_dump($row);
    //     exit;
        // if($_POST['id'],$row['account_id']){
        //     $_SESSION['account'] = [
        //         'account_name'=>$row['account_name'],
        //         'mail_address'=>$row['mail_address']
        //     ];
        
        // }

    // }
    // echo '<label><p1 style="font-size:20px;"></p1></label>name<br>';
    // echo 
    // echo '<label><p1 style="font-size:20px;"></p1></label>email address<br>';
    // echo 
?>

<button class="user_button" type="submit" name="garbage_can" value="ユーザー削除">🗑️</button>

<?php require 'default/footer.php'; ?>


