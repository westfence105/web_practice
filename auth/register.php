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
			elseif ( strlen($username) > 16 ) {
				throw new Exception("ユーザー名が長すぎます。16文字以下にしてください。");
			}
			elseif ( empty($password) ) {
				throw new Exception("パスワードが空白です。");
			}

			$dbname = 'mysql:host='.getenv('DB_HOST').';dbname=auth_test;';
			$driver_options =
				[
					PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
					PDO::ATTR_EMULATE_PREPARES => False
				];
			$pdo = new PDO( $dbname , getenv('DB_USERNAME'), getenv('DB_PASSWORD'), $driver_options );
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$stmt_chk = $pdo->prepare('SELECT COUNT(*) FROM auth_data WHERE username = ?');
			$stmt_chk->execute([$username]);
			if( $stmt_chk->fetchColumn() != 0 ){
				throw new Exception('ユーザー名がすでに存在しています。');
			}

			$stmt_add = $pdo->prepare('INSERT INTO auth_data (username,pass_hash) VALUES (?,?)');
			if( ! $stmt_add->execute([ $username, password_hash( $password, PASSWORD_DEFAULT )] ) ){
				throw new Exception('登録に失敗しました。');
			}
			else{
				print('<form name="login" action="login" method="POST">');
				print('<input type="hidden" name="username" value="'.$username.'">');
				print('<input type="hidden" name="password" value="'.$password.'">');
				print('<input type="hidden" name="token" value="'.gen_token().'">');
				print('</form>');
				print('<script type="text/javascript">login.submit();</script>');
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
?>
<!DOCTYPE html>
<meta charset="UTF-8">
<html>
<head>
<title>登録</title>
</head>
<body>
	<form method="POST">
		ユーザー名<input type="text" name="username"><br/>
		パスワード<input type="password" name="password"><br/>
		<?php
			if( ! empty($error) ){
				print("<br/>".'<font color="red">'.$error.'</font>');
			}
		?>
		<input type="submit" value="登録">
		<input type="hidden" name="token" value="<?php print(gen_token()) ?>">
	</form>
</body>
</html>