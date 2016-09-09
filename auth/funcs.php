<?php
	function check_login(bool $require = True ){
		if( isset($_SESSION['user_id']) != $require ){
			if( $require == True ){
				header('Location: /login');
				exit();
			}
			else {
				header('Location: /');
				exit();
			}
		}
		else if( $require == True ){
			session_regenerate_id(True);
		}
	}

	function gen_token(){
		return hash('sha256',session_id());
	}

	function check_token($token){
		return $token == gen_token();
	}

	function hash_pass(string $pass){
		return hash('sha256',$pass);
	}

	function print_error_page($title,$message=''){
		print('<!DOCTYPE html>');
		print('<html>');
		print('<header><title>403 Forbidden</title></header>');
		print('<body>');
		print('<div style="font-style: italic; font-size: 150%; margin-left: 3ex;">');
		print('<h2><strong>403 Forbidden</strong></h2>');
		print('Invalid token detected.');
		print('</div>');
		print('</body>');
		print('</html>');
	}
?>