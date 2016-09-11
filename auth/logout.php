<?php
	session_start();
	unset($_SESSION['username']);
?>
<!DOCTYPE html>
<meta charset="UTF-8">
<html>
<head>
<title>ログアウト</title>
</head>
<body>
	<div style="margin: 1ex 2em">
		ログアウトしました。<br/>
		<a href="./">トップに戻る</a>
	</div>
</body>
</html>