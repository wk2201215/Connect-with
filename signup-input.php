<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>新規登録</title>
    <link rel="stylesheet" href="./css/signup.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 165vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #FFFFFF;
            /* padding: 40px; Padding size increased */
            border-radius: 10px;
        }
        input[type="text"], input[type="password"] {
            width: 400px; /* Width size increased */
            padding: 15px; /* Padding size increased */
            margin: 15px 0; /* Margin size increased */
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 20px; /* Font size increased */
        }
        input[type="submit"] {
            width: 200px; /* Width size increased */
            padding: 15px; /* Padding size increased */
            margin: 30px 0; /* Margin size increased */
            background-color: #ffcccc;
            border: none;
            border-radius: 5px;
            font-size: 22px; /* Font size increased */
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #ff9999;
        }
        p {
            font-size: 36px; /* Font size increased */
            margin: 20px 0; /* Margin size increased */
        }
        label {
            font-size: 24px; /* Font size increased */
            margin-top: 10px; /* Margin added */
        }
    </style>
</head>
<body>
    <?php require 'default/header.php'; ?>
    <form action="signup-output.php" method="post">
        <?php
        $name = isset($_SESSION['account']['account_name']) ? htmlspecialchars($_SESSION['account']['account_name']) : '';
        $address = isset($_SESSION['account']['mail_address']) ? htmlspecialchars($_SESSION['account']['mail_address']) : '';
        // パスワードは表示しないことを推奨
        $password = '';
        ?>
        <p>新規登録</p>
        <label for="name">名前</label>
        <input type="text" name="account_name" id="name" value="<?php echo $name; ?>">
        
        <label for="email">メールアドレス</label>
        <input type="text" name="mail_address" id="email" value="<?php echo $address; ?>">
        
        <label for="password">パスワード</label>
        <input type="password" name="account_password" id="password" value="<?php echo $password; ?>">
        
        <input type="submit" value="新規登録">
    </form>
    <?php require 'default/footer.php'; ?>
</body>
</html>
