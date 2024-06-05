<?php
session_start(); // Start the session

require 'function/not-access.php';
require 'db/db-connect.php';

// Retrieve all deleted posts from the database for display
try {
    $pdo = new PDO($connect, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query('SELECT * FROM post WHERE delete_flag = 1');
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
    $posts = [];
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Deleted Posts</title>
</head>
<body>
    <div class="search">
        <input class="keyword" type="text" name="keyword" placeholder="  キーワード検索  ">
        <button class="searchbutton" type="submit" name="user_search" value="ユーザー検索">🔍</button>
        <button class="searchbutton" type="submit" name="hashtag" value="ハッシュタグ検索">＃</button>
    </div>

    <table border="1">
        <tr>
            <th>post content</th><th>restore</th>
        </tr>
        <?php foreach ($posts as $post): ?>
        <tr>
            <td><?php echo htmlspecialchars($post['post_content'], ENT_QUOTES, 'UTF-8'); ?></td>
            <td>
                <form method="POST" action="restore_post.php">
                    <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($post['post_id'], ENT_QUOTES, 'UTF-8'); ?>">
                    <button type="submit">restore</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
