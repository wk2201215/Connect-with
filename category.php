<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>カテゴリー選択</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #fff;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #fefefe;
        }
        .container {
            width: 100%;
            max-width: 400px;
            border: 1px solid #f2f2f2;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .header {
            background-color: #ffddf0;
            padding: 15px;
            display: flex;
            align-items: center;
            position: fixed;
            top: 0;
            width: 100%;
            max-width: 375px;
            z-index: 1000;
        }
        .header a {
            text-decoration: none;
            color: black;
            font-size: 24px;
            margin-right: auto;
        }
        .content {
            padding: 20px;
            text-align: center;
        }
        .content h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }
        .content p {
            margin-bottom: 20px;
            color: #333;
        }
        .button-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
        }
        .button-container a {
            display: inline-block;
            padding: 10px 20px;
            color: #ff0080;
            border: 2px solid #ff0080;
            border-radius: 20px;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s, color 0.3s;
        }
        .button-container a:hover {
            background-color: #ff0080;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <a href="javascript:history.back()">&larr;</a>
        </div>
        <div class="content">
            <h1>カテゴリー</h1>
            <p>興味のあるカテゴリーを選択してください。</p>
            <div class="button-container">
                <a href="#">音楽</a>
                <a href="#">ゲーム</a>
                <a href="#">映画</a>
                <a href="#">学校</a>
                <a href="#">スポーツ</a>
                <a href="#">ファッション</a>
                <a href="#">食べ物</a>
                <a href="#">エンタメ</a>
            </div>
            <br><br><br><br><br><br><br><br><br><br>
        </div>
    </div>
</body>
</html>