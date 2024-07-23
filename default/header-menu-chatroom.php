<header>
<div>
    <a onclick="history.back()" id="back">←</a>
    <?php
    if($_GET['flag'] == 1){
        if($_SESSION['account']['account_id'] < $item['account_id']){
            echo $item['chatroom_name1'];
        }else{
            echo $item['chatroom_name1'];
        }
    }else{
        echo $item['chatroom_name1'];
    }
    ?>
</div>  
</header>