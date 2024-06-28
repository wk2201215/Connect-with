<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Post Management</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<?php
foreach($sql as $row){
    echo '<div class="toukou">';
    $sql_a = $pdo->prepare('SELECT * FROM account INNER JOIN photograph ON account.photograph_id = photograph.photograph_id WHERE account_id = ?');
    $sql_a->execute([$row['account_id']]);
    $item1 = $sql_a->fetch();
    
    echo '<div class="account-info" data-id="'.$row['account_id'].'">';
    echo '<img src="Image-display.php?hogeA='.$item1['photograph_path'].'" alt="アカウント写真" class="fixed-size-img" />';
    echo '<div class="account-name">'.$item1['account_name'].'</div>';
    echo '<div class="post-time">'.$row['post_time'].'</div>';
    echo '</div>';
    
    echo '<div class="view" data-id="'.$row['post_id'].'">';
    echo '<div class="post-content">'.$row['post_content'].'</div>';
    if(isset($row['photograph_id'])){
        $sql_p = $pdo->prepare('SELECT * FROM photograph where photograph_id = ?');
        $sql_p->execute([$row['photograph_id']]);
        $item2 = $sql_p->fetch();
        echo '<img src="Image-display.php?hogeA='.$item2['photograph_path'].'" alt="投稿写真" class="post-img" />';
    }
    echo '</div>';

    echo '<div class="result" id="'.$row['post_id'].'">';
    echo '<p>good数：'.$row['good_count'].'</p>';
    echo '</div>';
    $sql_g=$pdo->prepare('SELECT * FROM good WHERE post_id = ? AND account_id = ? LIMIT 1');
    $sql_g->execute([$row['post_id'],$_SESSION['account']['account_id']]);
    $resultCount = $sql_g->rowCount();
    if($resultCount == 1){
        echo '<button class="ajax" id="'.$row['post_id'].'" data-id="'.$row['post_id'].'" data-g="1"><i class="fas fa-thumbs-up"></i></button>';
    }else{
        echo '<button class="ajax" id="'.$row['post_id'].'" data-id="'.$row['post_id'].'" data-g="0"><i class="far fa-thumbs-up"></i></button>';
    }
    echo '<input class="reply" type="button" value="返信" data-id="'.$row['post_id'].'" data-cn="'.$row['category_name'].'" data-ci="'.$row['category_id'].'"/>';

    if($row['account_id'] == $_SESSION['account']['account_id']){
        echo '<button class="delete" id="'.$row['post_id'].'" data-id="'.$row['post_id'].'">削除</button>';
    }
    // echo '</div>';

    echo '<HR>';
    echo '</div>';
}
?>
