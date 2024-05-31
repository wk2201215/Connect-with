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
    align-items: center;
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
    margin-top: 30px;
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
    padding: 8px;
    border: 1px solid #ddd;
    text-align: center;
}

th {
    background-color: #f5f5f5;
}

a {
    color: #007bff;
    text-decoration: none;
    font-size: 18px;
}

.post {
    text-align: left;
    font-size: 15px;
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
    </header>
    <main>
        <div class="search">
        <form action="search.php" method="POST">
            <input class="keyword" type="text" name="keyword" placeholder="  キーワード検索  ">
            <button class="user_button" type="submit" name="user_search" value="ユーザー検索">🔍</button>
            <button class="user_button" type="submit" name="hashtag" value="ハッシュタグ検索">＃</button>
        </form>
        </div>
        <div class="profile">
            <div class="avatar">管</div>
            <div class="info">
<?php
    // ユーザー情報を取得
    $user_id=7;
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
                    <td class="post">アップデートversion3.22.4</td>
                    <td><a href="#">#通知</a></td>
                    <td><a style="color: red" href="#">delete</a></td>
                </tr>
                <tr>
                    <td class="post">アップデートversion3.22.0</td>
                    <td><a href="#">#通知</a></td>
                    <td><a style="color: red" href="#">delete</a></td>
                </tr>
                <tr>
                    <td class="post">アップデートversion3.11.1</td>
                    <td><a href="#">#通知</a></td>
                    <td><a style="color: red" href="#">delete</a></td>
                </tr>
                <tr>
                    <td class="post">アップデートversion3.00</td>
                    <td><a href="#">#通知</a></td>
                    <td><a style="color: red" href="#">delete</a></td>
                </tr>
                <tr>
                    <td class="post">アップデートversion2.62</td>
                    <td><a href="#">#通知</a></td>
                    <td><a style="color: red" href="#">delete</a></td>
                </tr>
                <tr>
                    <td class="post">アップデートversion2.1</td>
                    <td><a href="#">#通知</a></td>
                    <td><a style="color: red" href="#">delete</a></td>
                </tr>
                <tr>
                    <td class="post">アップデートversion2.0</td>
                    <td><a href="#">#通知</a></td>
                    <td><a style="color: red" href="#">delete</a></td>
                </tr>
                <tr>
                    <td class="post">アップデートversion1.2</td>
                    <td><a href="#">#通知</a></td>
                    <td><a style="color: red" href="#">delete</a></td>
                </tr>
                <tr>
                    <td class="post">アップデートversion1.1</td>
                    <td><a href="#">#通知</a></td>
                    <td><a style="color: red" href="#">delete</a></td>
                </tr>
                <tr>
                    <td class="post">アップデートversion1</td>
                    <td><a href="#">#通知</a></td>
                    <td><a style="color: red" href="#">delete</a></td>
                </tr>
            </tbody>
        </table>
    </main>

<?php require 'default/footer.php'; ?>
