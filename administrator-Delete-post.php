<?php session_start(); ?>
<?php require 'default/header.php'; ?>

<?php
echo '<form action="post-delete.php" method="post">';
echo '<input type="text" name="keyword">';
echo '<input type="submit" value="🔍">';
echo '<input type="submit" value="＃">';
?>

<table border="1">
  <tr>
    <th>username</th><th>restoration</th><th>delete</th>
  </tr>
  <tr>
    <td></td><td><button>restoration</button></td><td><button>delete</button></td>
  </tr>
  <tr>
    <td></td><td><button>restoration</button></td><td><button>delete</button></td>
  </tr>
</table>





