<?php
session_start();
$_SESSION['account']['category_id'] = $_GET['category_id'];
header('Location:view.php?');
exit();
?>