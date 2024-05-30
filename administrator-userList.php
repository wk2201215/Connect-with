<?php
session_start(); // Start the session

require 'function/not-access.php';
require 'db/db-connect.php';

unset($_SESSION['account']);

// Check if account_name is set in POST request
if (isset($_POST['account_name']) && !empty($_POST['account_name'])) {
    try {
        // Establish a PDO connection
        $pdo = new PDO($connect, USER, PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare and execute the SQL query
        $sql = $pdo->prepare('SELECT * FROM account WHERE account_name = ?');
        $sql->execute([$_POST['account_name']]);
        
        // Fetch the result
        $row = $sql->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            // Set the session account if a row is found
            $_SESSION['account'] = [
                'account_name' => $row['account_name']
            ];
        } else {
            echo "No account found with the provided account name.";
        }
    } catch (PDOException $e) {
        // Handle potential errors
        echo "Database error: " . $e->getMessage();
    }
} else {
    echo "Account name is not provided.";
}

// Retrieve all user accounts from the database for display
try {
    $pdo = new PDO($connect, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query('SELECT account_name FROM account');
    $accounts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
    $accounts = [];
}
?>




<?php require 'db/db-connect.php';?>
<?php
// 接続をチェック
if ($conn->connect_error) {
    die("接続に失敗しました: " . $conn->connect_error);
}

// POSTリクエストから送信されたデータを取得
$id = $_POST['account_id']; // 更新対象のレコードのID
$newValue = $_POST['new_value']; // 新しい値

// データを更新するSQLクエリを作成
$sql = "UPDATE account SET account_id = '$newValue' WHERE id = $id";

// クエリを実行して結果を確認
if ($conn->query($sql) === TRUE) {
    echo "レコードが正常に更新されました";
} else {
    echo "エラー: " . $sql . "<br>" . $conn->error;
}

// データベース接続を閉じる
$conn->close();
?>







<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>User Accounts</title>
</head>
<body>
    <div class="search">
        <input class="keyword" type="text" name="keyword" placeholder="  キーワード検索  ">
        <button class="searchbutton" type="submit" name="user_search" value="ユーザー検索">🔍</button>
        <button class="searchbutton" type="submit" name="hashtag" value="ハッシュタグ検索">＃</button>
    </div>

    <table border="1">
        <tr>
            <th>user name</th><th>restoration</th><th>delete</th>
        </tr>
        <?php foreach ($accounts as $account): ?>
        <tr>
            <td><?php echo htmlspecialchars($account['account_name'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td><button>restoration</button></td>
            <td><button>delete</button></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
