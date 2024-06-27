<?php
session_start(); // Start the session

require 'function/not-access.php';
require 'db/db-connect.php';

$pdo=new PDO($connect,USER,PASS);
// $sql=$pdo->query('INSERT INTO post values (NULL, ?, ?,NULL,?,NULL,NULL,0);');
$image = uniqid(mt_rand(), true);//ファイル名をユニーク化
$image .= '.' . substr(strrchr($_FILES['image']['name'], '.'), 1);//アップロードされたファイルの拡張子を取得
$file = "images/$image";
$sql2 = "INSERT INTO photograph(photograph_path) VALUES (:image)";
$stmt = $pdo->prepare($sql2);
$stmt->bindValue(':image', $image, PDO::PARAM_STR);
if (!empty($_FILES['image']['name'])) {//ファイルが選択されていれば$imageにファイル名を代入
move_uploaded_file($_FILES['image']['tmp_name'], './images/' . $image);//imagesディレクトリにファイル保存
    if (exif_imagetype($file)) {//画像ファイルかのチェック
        $message = '画像をアップロードしました';
        $stmt->execute();
        $sql3=$pdo->query('SELECT photograph_id FROM photograph ORDER BY photograph_id DESC
        LIMIT 1');
        $item=$sql3->fetch();
    } else {
        $message = '画像ファイルではありません';
        header('Location:post-reply-input.php?post_id='+$_POST['post_id']+'&category_id='+$_POST['category_id']+'&message='+$message);
        exit();
    }
    // var_dump($item);
    if(isset($_POST['post_id'])){
        $sql=$pdo->prepare('INSERT INTO post values (NULL, ?, ?,DEFAULT,?,?,DEFAULT,?,0)');
        $sql->execute([
            $_SESSION['account']['account_id'],
            $_POST['category_id'],
            $_POST['post_content'],
            $item['photograph_id'],
            $_POST['post_id']
        ]);
    }else{
        $sql=$pdo->prepare('INSERT INTO post values (NULL, ?, ?,DEFAULT,?,?,DEFAULT,NULL,0)');
        $sql->execute([
            $_SESSION['account']['account_id'],
            $_POST['category'],
            $_POST['post_content'],
            $item['photograph_id']
        ]);
    }
    
}else{
    if(isset($_POST['post_id'])){
        // var_dump($_POST);
        // var_dump($_SESSION);
        $sql=$pdo->prepare('INSERT INTO post values (NULL, ?, ?,DEFAULT,?,NULL,DEFAULT,?,0)');
        $sql->execute([
            $_SESSION['account']['account_id'],
            $_POST['category_id'],
            $_POST['post_content'],
            $_POST['post_id']
        ]);
    }else{
        $sql=$pdo->prepare('INSERT INTO post values (NULL, ?, ?,DEFAULT,?,NULL,DEFAULT,NULL,0)');
        $sql->execute([
            $_SESSION['account']['account_id'],
            $_POST['category'],
            $_POST['post_content']
        ]);
    }
    
}



if(isset($_POST['post_id'])){
    header('Location:reply.php? post_id='.$_POST['post_id']);
    exit();
}else{
    header('Location:view.php?');
    exit();
}

