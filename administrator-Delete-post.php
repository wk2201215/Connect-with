<?php require 'function/not-access.php'; ?>
<?php require 'db/db-connect.php';?>


<?php
echo '<form action="post-delete.php" method="post">';
echo '<input type="text" name="keyword">';
echo '<input type="submit" value="🔍">';
echo '<input type="submit" value="＃">';
?>


<table border="1">
  <tr>
    <th>post</th><th>username</th><th>delete</th>
  </tr>
  <tr>
    <td></td><td><button>user1</button></td><td><button>delete</button></td>
  </tr>
  <tr>
    <td></td><td><button>user2</button></td><td><button>delete</button></td>
  </tr>

  <?php
    $pdo=new PDO($account, USER, PASS);
    foreach($pdo->query('select * from account where') as $row){
        echo '<tr>';
        echo '<td>',$row[''],'</td>';
        echo '<td>',$row[''],'</td>';
        echo '<td>';
</table>





