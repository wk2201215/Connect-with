<?php
session_start(); // Start the session

require 'function/not-access.php';
require 'db/db-connect.php';

$pdo=new PDO($connect,USER,PASS);
// $sql=$pdo->query('INSERT INTO post values (NULL, ?, ?,NULL,?,NULL,NULL,0);');
$sql=$pdo->prepare('INSERT INTO post values (NULL, ?, ?,NULL,?,?,NULL,?,0);');
$sql_a->execute([$_SESSION['account']['account_id'],]);

?>