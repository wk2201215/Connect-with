<?php session_start(); ?>
<?php require 'db/db-connect.php'; ?>
<?php require 'default/header-top.php'; ?>
<?php require 'default/header-menu.php'; ?>

<?php

echo '<div id="container">';

echo '<div class="header">';
  echo '<a href="javascript:history.back()">&larr;</a>';
echo '</div>';
echo '<div class="content">';
echo '<h1>カテゴリー</h1><br>';
echo '<p>興味のあるカテゴリーを選択してください。</p><br>';
echo '<div class="button-container">';
  $pdo=new PDO($connect,USER,PASS);
  $sql=$pdo->query('select * from category');
  foreach($sql as $row){
    echo $row['category_name'];
    
    echo '<button class=button-container>'.'<a href="category4.php?category_id='.$row['category_id'].'& category_name='.$row['category_name'].'">'.$row['category_name'].'</button>'.'</a>';
  }
echo '</div>';

echo '</div>';

echo '</div>';
?>

<style>

  h1,p {
            text-align: center;
        }
  .button-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
            border: none;
            background: none;
        }
        .button-container a {
            display: inline-block;
            padding: 10px 20px;
            color: #ff0080;
            border: 2px solid #ff0080;
            border-radius: 20px;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s, color 0.3s;
        }
        .button-container a:hover {
            background-color: #ff0080;
            color: #fff;
        }
</style>

<?php require 'default/footer-menu.php'; ?>
<?php require 'default/footer-top.php'; ?>
