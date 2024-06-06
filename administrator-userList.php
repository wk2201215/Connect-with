<?php
session_start(); // Start the session

require 'function/not-access.php';
require 'db/db-connect.php';

// Handle account restoration and deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo = new PDO($connect, USER, PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        if (isset($_POST['restore_account'])) {
            $account_id = $_POST['account_id'];
            $stmt = $pdo->prepare('UPDATE account SET delete_flag = 0 WHERE account_id = ?');
            $stmt->execute([$account_id]);
        }

        if (isset($_POST['delete_account'])) {
            $account_id = $_POST['account_id'];
            $stmt = $pdo->prepare('UPDATE account SET delete_flag = 1 WHERE account_id = ?');
            $stmt->execute([$account_id]);
        }
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
}

// Retrieve all user accounts from the database for display
try {
    $pdo = new PDO($connect, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query('SELECT account_id, account_name, delete_flag FROM account');
    $accounts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
    $accounts = [];
}
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
            <td>
                <?php if ($account['delete_flag'] == 1): ?>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="account_id" value="<?php echo $account['account_id']; ?>">
                    <button type="submit" name="restore_account">restoration</button>
                </form>
                <?php endif; ?>
            </td>
            <td>
                <?php if ($account['delete_flag'] == 0): ?>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="account_id" value="<?php echo $account['account_id']; ?>">
                    <button type="submit" name="delete_account">delete</button>
                </form>
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <button type="button" onclick="location.href='administrator-Delete-post.php'">遷移[post]</button>
</body>
</html>
