<?php session_start(); ?>
<?php require 'default/header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/administrator-Delete-user.css">
    <title>Document</title>
</head>
<body>
    
</body>
</html>

<div class="search">
<input class="keyword" type="text" name="keyword" placeholder="  キーワード検索  ">
<button class="searchbutton" type="submit" name="user_search" value="ユーザー検索" style="width:22px;height:22px">🔍</button>
<button class="searchbutton" type="submit" name="hashtag" value="ハッシュタグ検索" style="width:22px;height:22px">＃</button>
</div>

<table border="1">
  <tr>
    <th>post</th><th>restoration</th><th>delete</th>
  </tr>
  <tr>
    <td></td><td><button>restoration</button></td><td><button>delete</button></td>
  </tr>
  <tr>
    <td></td><td><button>restoration</button></td><td><button>delete</button></td>
  </tr>
</table>