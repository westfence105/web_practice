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

	function hash_pass(string $pass){
		return hash('sha256',$pass);
	}
?>