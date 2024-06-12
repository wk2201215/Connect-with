<?php
session_start();
require 'db/db-connect.php';
require 'default/header.php';

$pdo = new PDO($connect, USER, PASS);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$user_id = $_GET['account_id']; // Example user ID for fetching user details

// Fetch user information
$sql = "SELECT account_name, mail_address, photograph_id FROM account WHERE account_id = :user_id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['user_id' => $user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "User not found.";
    exit;
}

// Fetch user posts
$sql_posts = "SELECT post_id, category_id, post_time, post_content, photograph_id, good_count, reply_id, delete_flag FROM post WHERE account_id = :user_id";
$stmt_posts = $pdo->prepare($sql_posts);
$stmt_posts->execute(['user_id' => $user_id]);
$posts = $stmt_posts->fetchAll(PDO::FETCH_ASSOC);

// Handle post restoration and deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (isset($_POST['restore_post'])) {
            $post_id = $_POST['post_id'];
            $stmt = $pdo->prepare('UPDATE post SET delete_flag = 0 WHERE post_id = ?');
            $stmt->execute([$post_id]);
        }

        if (isset($_POST['delete_post'])) {
            $post_id = $_POST['post_id'];
            $stmt = $pdo->prepare('UPDATE post SET delete_flag = 1 WHERE post_id = ?');
            $stmt->execute([$post_id]);
        }
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>User Account</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-size: 18px;
            background-color: #FDBAF6;
        }
        .container {
            margin: 20px auto;
            padding: 20px;
            max-width: 800px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #ddd;
        }
        .profile {
            display: flex;
            align-items: center;
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
        }
        .trash-icon {
            font-size: 32px;
            cursor: pointer;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
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
        .actions button {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .actions .restore {
            background-color: #28a745;
            color: #fff;
        }
        .actions .delete {
            background-color: #dc3545;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="profile">
                <div class="avatar">
                    <img src="path/to/profile/image/<?php echo htmlspecialchars($user['photograph_id'], ENT_QUOTES, 'UTF-8'); ?>.jpg" alt="Profile Picture" width="60" height="60">
                </div>
                <div class="info">
                    <p><strong>名前:</strong> <?php echo htmlspecialchars($user['account_name'], ENT_QUOTES, 'UTF-8'); ?></p>
                    <p><strong>メールアドレス:</strong> <?php echo htmlspecialchars($user['mail_address'], ENT_QUOTES, 'UTF-8'); ?></p>
                </div>
            </div>
            <a href="administrator-userList.php">戻る↩</a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>投稿内容</th>
                    <th>タグ</th>
                    <th>投稿時間</th>
                    <th>いいね数</th>
                    <th>アクション</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($posts as $post): ?>
                <tr>
                    <td class="post"><?php echo htmlspecialchars($post['post_content'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($post['category_id'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($post['post_time'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td><?php echo htmlspecialchars($post['good_count'], ENT_QUOTES, 'UTF-8'); ?></td>
                    <td class="actions">
                        <?php if ($post['delete_flag'] == 1): ?>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="post_id" value="<?php echo $post['post_id']; ?>">
                            <button type="submit" name="restore_post" class="restore">復元</button>
                        </form>
                        <?php endif; ?>
                        <?php if ($post['delete_flag'] == 0): ?>
                        <form method="POST" style="display:inline;">
                            <input type="hidden" name="post_id" value="<?php echo $post['post_id']; ?>">
                            <button type="submit" name="delete_post" class="delete">削除</button>
                        </form>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php require 'default/footer.php'; ?>
