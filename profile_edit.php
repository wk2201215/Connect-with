<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>プロフィール編集画面</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8e9f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            padding: 10px;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        .profile-pic {
            position: relative;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background-color: #d3d3d3;
            margin: 0 auto 20px;
            overflow: hidden;
        }
        .profile-pic img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .profile-pic input {
            display: none;
        }
        .profile-pic label {
            position: absolute;
            bottom: 5px;
            right: 5px;
            background-color: #dff3f4;
            border-radius: 50%;
            padding: 5px;
            cursor: pointer;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group input, .form-group textarea {
            width: calc(100% - 20px);
            padding: 8px;
            margin: 0 auto;
            display: block;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-group textarea {
            height: 80px;
            resize: none;
        }
        .submit-btn {
            background-color: #ff6fb4;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 15px;
            cursor: pointer;
            float: right;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="profile-pic">
        <img id="profile-image" src="" alt="プロフィール画像">
        <input type="file" id="image-upload" accept="image/*">
        <label for="image-upload">＋</label>
    </div><br>
    <div class="form-group">
        <input type="text" id="name" placeholder="名前">
    </div>
    <div class="form-group">
        <input type="email" id="email" placeholder="メールアドレス">
    </div>
    <div class="form-group">
        <textarea id="bio" placeholder="自己紹介文"></textarea>
    </div><br>
    <button class="submit-btn">確定</button>
</div>

<script>
    const imageUpload = document.getElementById('image-upload');
    const profileImage = document.getElementById('profile-image');

    imageUpload.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                profileImage.src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });
</script>

<!-- ↓↓ PHP ↓↓
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = htmlspecialchars($_POST['account_name']);
        $email = htmlspecialchars($_POST['email_address']);
        $bio = htmlspecialchars($_POST['bio']);
        echo "<div class='container'>";
        echo "<h2>入力された情報:</h2>";
        echo "<p><strong>名前:</strong> $name</p>";
        echo "<p><strong>メールアドレス:</strong> $email</p>";
        echo "<p><strong>自己紹介文:</strong> $bio</p>";
        echo "</div>";
    } else {
?>
<div class="container">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="profile-pic">
            <img id="profile-image" src="" alt="プロフィール画像">
            <input type="file" id="image-upload" accept="image/*">
            <label for="image-upload">＋</label>
        </div><br>
        <div class="form-group">
            <input type="text" name="name" id="name" placeholder="名前" required>
        </div>
        <div class="form-group">
            <input type="email" name="email" id="email" placeholder="メールアドレス" required>
        </div>
        <div class="form-group">
            <textarea name="bio" id="bio" placeholder="自己紹介文" required></textarea>
        </div><br>
        <button type="submit" class="submit-btn">確定</button>
    </form>
</div>

<script>
    const imageUpload = document.getElementById('image-upload');
    const profileImage = document.getElementById('profile-image');

    imageUpload.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                profileImage.src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });
</script>
<?php
    }
?> -->

</body>
</html>