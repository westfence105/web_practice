<?php
	require_once 'funcs.php';
	session_start();
?>
<!DOCTYPE html>
<meta charset="UTF-8">
<html>
<head>
<title>TITLE</title>
</head>
<body>
	<?php
		if( ! empty($_SESSION['username']) ){
			print("'".$_SESSION['username']."'としてログインしています。<br/>");
			print('<a href="logout">ログアウト</a>');
		}
		else{
			print("ログインしていません。<br/>");
			print('<a href="login">ログイン</a>');
			print('<a href="register">新規登録</a>');
		}
	?>
</body>
</html>