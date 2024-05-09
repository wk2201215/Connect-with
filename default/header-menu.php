<nav class="navbar is-block is-fixed-top has-shadow" role="navigation">
    <div class="navbar-brand" style="height:100%;width:100%;">
        <form action="top.php" method="post" class="navbar-item is-expanded pr-0 pl-5" style="width: 85vw">
            <div class="field has-addons" style="width: 100%">
                <div class="control" style="width: 70%">
                    <input class="input" type="text" name="keyword" placeholder="キーワード検索">
                </div>
                <div class="control" style="width: 30%">
                    <button type="submit" class="button is-info" style="width: 100%"><i class="fa fa-search" aria-hidden="true"></i>検索</button>
                </div>
            </div>
        </form>
        <div class="navbar-item is-expanded" style="width: 15vw">
            <div class="dropdown is-right" id="filter">
                <div class="dropdown-trigger">
                    <button class="button" aria-haspopup="true" aria-controls="dropdown-menu6" style="border-color:transparent;" onclick="onfilter()">
                        <span class="is-size-4">
                            <i class="fa fa-filter" aria-hidden="true"></i>
                        </span>
                    </button>
                </div>
            <div class="dropdown-menu" id="dropdown-menu" role="menu" style="max-height: 70vh;overflow: scroll;">
                <div class="dropdown-content">
                    <ul class="dropdown-item">
                    <?php
                        $pdo=new PDO($connect, USER, PASS);
                        echo '値段範囲検索';
                        echo '<li><a href="top.php?priceA=0&priceB=1000">～￥1,000</a></li>';
                        echo '<li><a href="top.php?priceA=1000&priceB=3000">￥1,000～￥3,000</a></li>';
                        echo '<li><a href="top.php?priceA=3000&priceB=6000">￥3,000～￥6,000</a></li>';
                        echo '<li><a href="top.php?priceA=6000&priceB=9000">￥6,000～￥9,000</a></li>';
                        echo '<li><a href="top.php?priceA=9000&priceB=max">￥9,000～</a></li>';
                        echo 'カテゴリ検索';
                        foreach($pdo->query('select * from Categories') as $row){
                            echo '<li><a href="top.php?category_id=',$row['category_id'],'">',$row['category_name'],'</a></li>';
                        }
                    ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
<div id="app">
<section class="hero main">