<?php require 'db/db-connect.php';?>
<?php session_start(); ?>
<?php require 'default/header.php'; ?>

<style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-size: 18px;
}

header {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 15px;
    /* background-color: #f5f5f5;
    border-bottom: 1px solid #ddd; */
}

.header-icons {
    display: flex;
}

.icon {
    width: 25px;
    height: 25px;
    background-color: #000;
    margin-right: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    font-size: 16px;
}

.search {
    display: flex;
    align-items: center;
    margin: 0% 10% 0% 10%;
    text-align: center;
    position: relative;
}

.search-container input {
    padding: 10px;
    margin-right: 10px;
    font-size: 18px;
}

main {
    padding: 20px;
}

.profile {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 30px;
}

.avatar {
    width: 60px;
    height: 60px;
    background-color: #ddd;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 32px;
    margin-right: 20px;
}

.info p {
    margin: 0;
    font-size: 18px;
}

.trash-icon {
    margin-left: auto;
    font-size: 32px;
    cursor: pointer;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 15px;
    border: 1px solid #ddd;
    text-align: left;
}

th {
    background-color: #f5f5f5;
}

a {
    color: #007bff;
    text-decoration: none;
    font-size: 18px;
}

a:hover {
    text-decoration: underline;
}

    </style>

<?php
    // ユーザー情報を取得
    // $user_id=1;
    // $pdo=new PDO($connect, USER, PASS);
    // $sql = "SELECT account_name, mail_address FROM account WHERE account_id = $user_id";
    // $result = $pdo->query($sql);

    // foreach($result as $val) {
    //     $user_name = $val['account_name'];
    //     $user_email = $val['mail_address'];
   // }

    //echo 'name: ',$user_name,'<br>';
    // echo 'email address: ',$user_email;

    // if ($result->num_rows > 0) {
    //     // 結果をフェッチ
    //     $user = $result->fetch_assoc();
    //     $user_name = $user['account_name'];
    //     $user_email = $user['mail_address'];
    // } else {
    //     echo "User not found.";
    //     exit;
    // }

    // 接続を閉じる
    // $pdo->close();
?>

<header>
        <div class="header-icons">
            <!-- <div class="icon">■</div>
            <div class="icon">■</div> -->
        </div>
        <div class="search">
        <form action="search.php" method="POST">
            <input class="keyword" type="text" name="keyword" placeholder="  キーワード検索  ">
            <button class="user_button" type="submit" name="user_search" value="ユーザー検索">🔍</button>
            <button class="user_button" type="submit" name="hashtag" value="ハッシュタグ検索">＃</button>
        </div>
    </header>
    <main>
        <div class="profile">
            <div class="avatar">人</div>
            <div class="info">
<?php
    // ユーザー情報を取得
    $user_id=1;
    $pdo=new PDO($connect, USER, PASS);
    $sql = "SELECT account_name, mail_address FROM account WHERE account_id = $user_id";
    $result = $pdo->query($sql);

    foreach($result as $val) {
        $user_name = $val['account_name'];
        $user_email = $val['mail_address'];
    }

    echo 'name: ',$user_name,'<br>';
    echo 'email address: ',$user_email;
?>
            </div>
            <button class="userDelete_button" type="submit" name="garbage_can" value="ユーザー削除">🗑️</button>
        </div>
        <table>
            <thead>
                <tr>
                    <th>post</th>
                    <th>tag</th>
                    <th>delete</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>地震速報</td>
                    <td><a href="#">#ニュース</a></td>
                    <td><a href="#">delete</a></td>
                </tr>
                <tr>
                    <td>わー</td>
                    <td><a href="#">#？？？？</a></td>
                    <td><a href="#">delete</a></td>
                </tr>
                <tr>
                    <td>地震速報</td>
                    <td><a href="#">#ニュース</a></td>
                    <td><a href="#">delete</a></td>
                </tr>
                <tr>
                    <td>わー</td>
                    <td><a href="#">#？？？？</a></td>
                    <td><a href="#">delete</a></td>
                </tr>
                <tr>
                    <td>地震速報</td>
                    <td><a href="#">#ニュース</a></td>
                    <td><a href="#">delete</a></td>
                </tr>
                <tr>
                    <td>わー</td>
                    <td><a href="#">#？？？？</a></td>
                    <td><a href="#">delete</a></td>
                </tr>
            </tbody>
        </table>
    </main>

<?php require 'default/footer.php'; ?>
