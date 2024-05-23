<?php require 'db/db-connect.php';?>
<?php session_start(); ?>
<?php require 'default/header.php'; ?>

<style>
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    background-color: #f5f5f5;
    border-bottom: 1px solid #ddd;
}

.header-icons {
    display: flex;
}

.icon {
    width: 20px;
    height: 20px;
    background-color: #000;
    margin-right: 5px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
}

.search-container {
    display: flex;
    align-items: center;
}

.search-container input {
    padding: 5px;
    margin-right: 5px;
}

main {
    padding: 20px;
}

.profile {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
}

.avatar {
    width: 50px;
    height: 50px;
    background-color: #ddd;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    margin-right: 15px;
}

.info p {
    margin: 0;
}

.trash-icon {
    margin-left: auto;
    font-size: 24px;
    cursor: pointer;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 10px;
    border: 1px solid #ddd;
    text-align: left;
}

th {
    background-color: #f5f5f5;
}

a {
    color: #007bff;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

    </style>

<div class="search">
<input class="keyword" type="text" name="keyword" placeholder="  キーワード検索  ">
<form action="search.php" method="POST">
<button class="user_button" type="submit" name="user_search" value="ユーザー検索">🔍</button>
<button class="user_button" type="submit" name="hashtag" value="ハッシュタグ検索">＃</button>
<!-- <button class="user_button" type="submit" name="garbage_can" src="./images/🗑️.png" value="ユーザー削除">🗑️</button> -->
</div>

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
            <div class="icon">■</div>
            <div class="icon">■</div>
        </div>
        <div class="search-container">
            <input type="text" placeholder="Search...">
            <button>🔍</button>
            <button>#</button>
        </div>
    </header>
    <main>
        <div class="profile">
            <div class="avatar">人</div>
            <div class="info">
                <p>name: ヒト</p>
                <p>email address: 〇〇〇@s.asojuku.ac.jp</p>
            </div>
            <div class="trash-icon">🗑️</div>
        </div>
        <table>
            <thead>
                <tr>
                    <th>post</th>
                    <th>tag</th>
                    <th>restoration/delete</th>
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

<button class="user_button" type="submit" name="garbage_can" value="ユーザー削除">🗑️</button>

<?php require 'default/footer.php'; ?>
