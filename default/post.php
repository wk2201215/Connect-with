<?php
foreach($sql as $row){
    echo '<div class="toukou">';
    $sql_a = $pdo->prepare('SELECT * FROM account INNER JOIN photograph ON account.photograph_id = photograph.photograph_id WHERE account_id = ?');
    $sql_a->execute([$row['account_id']]);
    $item1 = $sql_a->fetch();
    
    echo '<div class="account-info">';
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
    echo '<button class="ajax" data-id="'.$row['post_id'].'">ボタン</button>';
    
    echo '<input class="reply" type="button" value="返信" data-id="'.$row['post_id'].'" data-cn="'.$row['category_name'].'" data-ci="'.$row['category_id'].'"/>';
    
    echo '<HR>';
    echo '</div>';
}
?>
