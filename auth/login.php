<?php
	require_once 'funcs.php';
	check_login(False);

	if( $_SERVER['REQUEST_METHOD'] == "POST" ){
		if( filter_input( INPUT_POST, 'token') != gen_token() ){
			http_response_code(403);
		}
		else{
			$username = filter_input( INPUT_POST, "username" );
			$password = filter_input( INPUT_POST, "password" );
			try{
				$pdo = new PDO('mysql:host=localhost;dbname=auth_test;','root','');
			}
			catch(PDOException $e){
				header('Content-type: text/plain; charset=UTF-8',true,500);
				exit($e->getMessage());
			}
			$st = $pdo->query("SELECT pass_hash from user_data where username='".$username."'");
			$hash = $st->fetch()['pass_hash'];
			if( hash_pass($password) == $hash ){
				session_regenerate_id(True);
				$_SESSION['user_id'] == $username;
				header('Location: /');
			}
		}
	}

	header('Content-type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<meta charset="UTF-8">
<html>
<head>
<title>TITLE</title>
</head>
<body>
	<form method="POST">
		ユーザー名：<input type="text" name="username"><br/>
		パスワード： <input type="password" name="password"><br/>
		<?php
			print( '<input type="hidden" name="token" value="'.gen_token().'">');
		?>
		<input type="submit" value="Login">
	</form>
</body>
</html>