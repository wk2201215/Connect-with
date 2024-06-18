<?php
foreach($sql as $row){
    // var_dump($_SESSION['account']);
    echo '<div class="toukou">';
    $sql_a=$pdo->prepare('SELECT * FROM account INNER JOIN photograph ON account.photograph_id = photograph.photograph_id WHERE account_id = ?');
    $sql_a->execute([$row['account_id']]);
    // var_dump($sql_a);
    // パスから画像データを取得
    $item1=$sql_a->fetch();
    // var_dump($item1);
    // $filePath1 = 'images/'.$item1['photograph_path'];
    // echo '<img src="Image-display.php?hogeA='.$filePath1.'" alt="アカウント写真" />';
    echo '<img src="Image-display.php?hogeA='.$item1['photograph_path'].'" alt="アカウント写真" />';
    echo '<br>';
    echo $item1['account_name'];
    echo '<br>';
    echo '<div class="view" data-id="'.$row['post_id'].'">';
    echo $row['post_time'];
    echo '<br>';
    echo $row['post_content'];
    echo '<br>';
    echo $row['category_name'];
    echo '<br>';
    if(isset($row['photograph_id'])){
        $sql_p=$pdo->prepare('SELECT * FROM photograph where photograph_id = ?');
        $sql_p->execute([$row['photograph_id']]);
        $item2=$sql_p->fetch();
        // $filePath2 = 'images/'.$item2['photograph_path'];
        // echo '<img src="Image-display.php?hogeA='.$filePath2.'" alt="投稿写真" />';
        echo '<img src="Image-display.php?hogeA='.$item2['photograph_path'].'" alt="投稿写真" />';
        echo '<br>';
    }
    echo '</div>';

    echo '<div class="result" id="'.$row['post_id'].'">';
    echo '<p>good数：'.$row['good_count'].'</p>';
    echo '</div>';
    echo '<button class="ajax" id="'.$row['post_id'].'" data-id="'.$row['post_id'].'">ボタン</button>';
    // echo $row['good_count'];
    
    // echo '<p class="reply" data-id="'.$row['post_id'].'/>';
    // echo '<p class="reply" data-id="'.$row['post_id'].'>botan</p>';
    echo '<input class="reply" type="button" value="返信" data-id="'.$row['post_id'].'" data-cn="'.$row['category_name'].'" data-ci="'.$row['category_id'].'"/>';
    
    echo '<HR>';
    echo '</div>';
}
?>