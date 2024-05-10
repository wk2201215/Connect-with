<?php session_start(); ?>

<?php require 'db/db-connect.php'; ?>
<?php require 'default/header.php'; ?>
<?php
$pdo=new PDO($connect,USER,PASS);
if (isset($_SESSION['account'])){
    $id=$_SESSION['account'];
    $sql=$pdo->prepare('select * from accaunt where id !=? and login=?');
    $sql->execute([$id, $_POST['login']]);
    } else {
        $sql=$pdo->prepare('select * from caccaunt where login=?');
        $sql->execute([$_POST['login']]);
    }
    if (empty($sql->fetchAll())) {
        if (isset($_SESSION['account'])) {
            $sql=$pdo->prepare('update account set name=?, address=?,'. 'password=? where id=?');
            $sql->execute([
                $_POST['name'], $_POST['address'], $_POST['password'], $id]);
            $_SESSION['account']=[
                'id'=>$id, 'name'=>$_POST['name'],
                'address'=>$_POST['address'],
                'password'=>$_POST['password']];
            echo 'お客様の情報を更新しました。';
        }else{
            $sql=$pdo->prepare('insert into account values(null,?,?,?,?)');
            $sql->execute([
                $_POST['name'], $_POST['address'], $_POST['password']]);
                echo 'お客様情報を登録しました。';
            }
        }else{
            echo 'ログイン名が既に使用されていますので、変更してください。';
        }
    ?>
<?php require './footer.php'; ?>