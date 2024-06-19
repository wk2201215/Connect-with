<?php
session_start(); // Start the session

require 'function/not-access.php';
require 'db/db-connect.php';

// Handle post restoration and deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo = new PDO($connect, USER, PASS);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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

// Retrieve all posts from the database for display
try {
    $pdo = new PDO($connect, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->query('SELECT * FROM post');
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Post Management</title>
</head>
<body>
    <h1>Post Management</h1>
    <table border="1">
        <tr>
            <th>Post ID</th>
            <th>Account ID</th>
            <th>Category ID</th>
            <th>Post Time</th>
            <th>Content</th>
            <th>Photograph ID</th>
            <th>Good Count</th>
            <th>Reply ID</th>
            <th>Delete Flag</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($posts as $post): ?>
            <tr>
                <td><?= htmlspecialchars($post['post_id']) ?></td>
                <td><?= htmlspecialchars($post['account_id']) ?></td>
                <td><?= htmlspecialchars($post['category_id']) ?></td>
                <td><?= htmlspecialchars($post['post_time']) ?></td>
                <td><?= htmlspecialchars($post['post_content']) ?></td>
                <td><?php
                        if(isset($post['photograph_id'])){
                          echo htmlspecialchars($post['photograph_id']);
                        }else{
                          echo 'NULL';
                        }
                      
                      ?></td>
                <td><?= htmlspecialchars($post['good_count']) ?></td>
                <td><?php if(isset($post['reply_id'])):?>
                      <?=htmlspecialchars($post['reply_id'])?>
                    <?php else:?>
                      <?='NULL'?>
                    <?php endif;?>
                </td>
                <td><?= htmlspecialchars($post['delete_flag']) ?></td>
                <td>
                    <?php if ($post['delete_flag'] == 0): ?>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="post_id" value="<?= htmlspecialchars($post['post_id']) ?>">
                            <button type="submit" name="delete_post">Delete</button>
                        </form>
                    <?php else: ?>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="post_id" value="<?= htmlspecialchars($post['post_id']) ?>">
                            <button type="submit" name="restore_post">Restore</button>
                        </form>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <div class="center-button">
        <button type="button" onclick="location.href='administrator-userList.php'">遷移[post]</button>
    </div>
</body>
</html>
