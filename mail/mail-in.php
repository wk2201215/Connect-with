<html>
	<head>
		<meta charset="utf-8" />
	</head>
	<body>
		<form action="mail-out.php" method="post">
	    	    <p>送り先</p><input type="text" name="to">
	    	    <p>件名</p><input type="text" name="title">
	    	    <p>メッセージ</p><textarea name="message" cols="60" rows="10"></textarea>
	    	    <p><input type="submit" name="send" value="送信"></p>
	  	</form>
	</body>
</html>