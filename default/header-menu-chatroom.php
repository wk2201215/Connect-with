<header>
<div>
    
    <?php
    if($item['one_on_one'] == 0){
        echo $item['chatroom_name1'];
    }else if($_SESSION['account']['account_id'] < $item['one_on_one']){
        echo $item['chatroom_name2'];
    }else{
        echo $item['chatroom_name1'];
    }
    ?>
</div>  
</header>