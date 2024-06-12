<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>新規登録</title>
    <link rel="stylesheet" href="./css/signup.css">
    <style>

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            overflow: hidden;
        }

        .container {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .signup-form {
            z-index: 1;
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            max-width: 400px;
            width: 100%
        }

        .signup-form h1 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 1.2rem;
        }

        .form-group input {
            width: 90%;
            padding: 12px;
            border: 1px solid #000; /* Ensure the border is a solid color */
            border-color: #fca7d2;
            border-radius: 20px;
            font-size: 1rem;
            background-color: rgba(255, 255, 255, 0.1);
            color: #000; /* Changed text color to black for better visibility */
            transition: 0.3s;
        }

        .form-group input:focus {
            border-color: white;
             /* Remove shadow effect on focus */
        }

        .btn {
            /* background-color: #d6adff; */
            background-color: #fca7d2;
            color: white;
            display: inline-block;
            width: 100%;
            padding: 11px;
            border: 2px solid #fca7d2;
            border-radius: 20px;
            font-size: 1.2rem;
            cursor: pointer;
            margin-top: 10px;
        }

        .btn:hover {
            background-color: white;
            color: #fca7d2;
        }

    </style>
</head>
<body>
    <?php require 'default/header.php'; ?>
        <?php
        $name = isset($_SESSION['account']['account_name']) ? htmlspecialchars($_SESSION['account']['account_name']) : '';
        $address = isset($_SESSION['account']['mail_address']) ? htmlspecialchars($_SESSION['account']['mail_address']) : '';
        // パスワードは表示しないことを推奨
        $password = '';
        ?>
<div class="container">
    <div class="signup-form">
        <form action="signup-output.php" method="post">
            <h1>新規登録</h1>
            <div class="form-group">
                <label for="name">名前</label>
                <input type="text" name="account_name" id="name" value="<?php echo $name; ?>" required>
            </div>
            <div class="form-group">
                <label for="email">メールアドレス</label>
                <input type="email" name="mail_address" id="email" value="<?php echo $address; ?>" required>
            </div>
            <div class="form-group">
                <label for="password">パスワード</label>
                <input type="password" name="account_password" id="password" value="<?php echo $password; ?>" required>
            </div><br>
            <button type="submit" class="btn">新規登録</button>
        </form>
    </div>
</div>
    <?php require 'default/footer.php'; ?>
</body>
</html>
