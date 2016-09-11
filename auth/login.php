<?php
	require_once 'funcs.php';
	check_login(False);

	if( filter_input( INPUT_SERVER, 'REQUEST_METHOD' ) == "POST" ){
		try{
			validate_token( filter_input( INPUT_POST, 'token') );

			$username = filter_input( INPUT_POST, "username" );
			$password = filter_input( INPUT_POST, "password" );
			if( empty($username) ){
				throw new Exception("ユーザー名が空白です。");
			}

			$dbname = 'mysql:host='.getenv('DB_HOST').';dbname=auth_test;';
			$driver_options =
				[
					PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
					PDO::ATTR_EMULATE_PREPARES => False
				];
			$pdo = new PDO( $dbname , getenv('DB_USERNAME'), getenv('DB_PASSWORD'), $driver_options );
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$stmt = $pdo->prepare("SELECT pass_hash from auth_data where username = ?");
			$stmt->execute([ $username ]);
			$hash = $stmt->fetch()['pass_hash'];
			if( password_verify( $password, $hash ) ){
				session_regenerate_id(True);
				$_SESSION['username'] = $username;
				header('Location: ./');
				exit;
			}
			else{
				throw new Exception("ユーザー名かパスワードが間違っています。");
			}
		}
		catch( PDOException $e ){
			$log = new Log('log/pdo_error.log');
			$log->log( $e->getMessage() );
			print_error_page( 500, '500 Internal Server Error', 'Error while accessing database.' );
		}
		catch( Exception $e ){
			$error = $e->getMessage();
		}
	}

	header('Content-type: text/html; charset=UTF-8');
?>
<!DOCTYPE html>
<meta charset="UTF-8">
<html>
<head>
<title>ログイン</title>
</head>
<body>
	<form method="POST">
		ユーザー名：<input type="text" name="username"><br/>
		パスワード： <input type="password" name="password"><br/>
		<?php
			if( ! empty($error) ){
				print('<div style="color: red; margin-top: 1ex; margin-bottom: 1ex; font-style: bold;">');
				print($error.'</div>');
			}
		?>
		<input type="button" onclick="submit();" value="ログイン">
		<input type="hidden" name="token" value="<?php print(gen_token()) ?>">
	</form>
	<div style="font-size: 90%; margin: 1ex .5em">
		<a href="register">新規登録</a><br/>
		<a href="./">トップへ戻る</a><br/>
	</div>
</body>
</html>