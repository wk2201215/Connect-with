<?php require 'function/not-access.php'; ?>
<?php require 'db/db-connect.php';?>
<?php

unset($_SESSION['account']);
$pdo=new PDO($connect, USER, PASS);
$sql=$pdo->prepare('select * from account where account_name=?');
$sql->execute([$_POST['account_name']]);
foreach($sql as $row) {
        $_SESSION['account']=[
            'account_name'=>$row['account_name']
        ];
}
?>






<div class="search">
<input class="keyword" type="text" name="keyword" placeholder="  キーワード検索  ">
<button class="searchbutton" type="submit" name="user_search" value="ユーザー検索">🔍</button>
<button class="searchbutton" type="submit" name="hashtag" value="ハッシュタグ検索">＃</button>
</div>

<table border="1">
  <tr>
    <th>user name</th><th>restoration</th><th>delete</th>
  </tr>
  <tr>
    <td></td><td><button>restoration</button></td><td><button>delete</button></td>
  </tr>
  <tr>
    <td></td><td><button>restoration</button></td><td><button>delete</button></td>
  </tr>
</table>