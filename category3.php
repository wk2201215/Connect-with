<?php require 'db/db-connect.php'; ?>
<?php require 'default/header-top.php'; ?>
<?php require 'default/header-menu.php'; ?>

<?php

echo '<div id="container">';

echo '<div class="header">';
  echo '<a href="javascript:history.back()">&larr;</a>';
echo '</div>';
echo '<div class="content">';
echo '<h1>カテゴリー</h1>'
echo '<p>興味のあるカテゴリーを選択してください。</p>'
echo '<div class="button-container">';
  $pdo=new PDO($connect,USER,PASS);
  $sql=$pdo->query('select * from category');
  foreach($sql as $row){
    echo $row['category_name'];
    echo '<br>';
  }
    <a href="#">音楽</a>
    <a href="#">ゲーム</a>
    <a href="#">映画</a>
    <a href="#">学校</a>
    <a href="#">スポーツ</a>
    <a href="#">ファッション</a>
    <a href="#">食べ物</a>
    <a href="#">エンタメ</a>
</div>
<br><br><br><br><br><br><br><br><br><br>
</div>';

echo '</div>';
?>
<?php require 'default/footer-menu.php'; ?>
<?php require 'default/footer-top.php'; ?>
