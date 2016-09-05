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
?>