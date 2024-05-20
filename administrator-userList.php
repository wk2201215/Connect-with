<?php
    const SERVER = 'mysql302.phy.lolipop.lan';
    const DBNAME = 'LAA1517442';
    const USER = 'LAA1517442';
    const PASS = 'post0418';

    $connect = 'mysql:host='. SERVER . ';dbname='. DBNAME . ';charset=utf8';
?>


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

<body>
<?php
unset($_SESSION['account']);
$pdo=new PDO($connect, USER, PASS);
$sql=$pdo->prepare('select * from account where mail_address=?');
$sql->execute([$_POST['mail_address']]);
foreach($sql as $row) {
    if(password_verify($_POST['password'],$row['account_password'])){
        $_SESSION['account']=[
            'account_id'=>$row['account_id'],
            'mail_address'=>$row['mail_address'],
            'account_password'=>$_POST['account_password'],
            'account_name'=>$row['account_name'],
            'photograph_id'=>$row['photograph_id'],
            'self-introduction'=>$row['self-introduction'],
            'authority'=>$row['authority'],
            'delete_flag'=>$row['delete_flag']
        ];
    }
}
// テーブルのデータを定義
$account = array(
    array("user name", "restoration", "delete"),
    array("", "", "delete"),
    array("", "", "delete"),
    array("", "", "delete"),
    array("", "", "delete"),
    array("", "", "delete"),
    array("", "", "delete"),
    array("", "", "delete"),
    array("", "", "delete"),
    array("", "", "delete"),
    array("", "", "delete"),
    array("", "", "delete"),
);

// テーブルの開始タグを出力
echo "<table border='1'>";

// テーブルの各行を出力
foreach ($account as $row) {
    echo "<tr>";
    foreach ($row as $cell) {
        echo "<td>$cell</td>";
    }
    echo "</tr>";
}

// テーブルの終了タグを出力
echo "</table>";
?>

</body>

