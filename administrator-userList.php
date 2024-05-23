<?php require 'function/not-access.php'; ?>
<?php require 'db/db-connect.php';?>


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


  <?php
    $pdo=new PDO($account, USER, PASS);
    foreach($pdo->query('select * from account where') as $row){
        echo '<tr>';
        echo '<td>',$row[''],'</td>';
        echo '<td>',$row[''],'</td>';
        echo '<td>';
</table>