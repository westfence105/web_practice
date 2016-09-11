<?php
	function check_login(bool $require = True ){
		@session_start();
		if( ( ! empty($_SESSION['username']) ) != $require ){
			if( $require == True ){
				header('Location: ./login');
				exit();
			}
			else {
				header('Location: ./');
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

	function validate_token($token){
		if( $token != gen_token() ){
			print_error_page( 403, '403 Forbidden', 'Invalid token detected.' );
			exit;
		}
	}

	function hash_pass(string $pass){
		return hash('sha256',$pass);
	}

	function print_error_page(int $code,string $title,string $message=''){
		http_response_code($code);
		print('<!DOCTYPE html>');
		print('<html>');
		print('<header><title>'.$title.'</title></header>');
		print('<body>');
		print('<div style="font-size: 140%; margin-left: 3ex;">');
		print('<h1><b>'.$title.'</b></h1>');
		print('<div style="font-style: oblique; font-weight: 100">');
		print($message);
		print('</div>');
		print('</div>');
		print('</body>');
		print('</html>');
		exit;
	}

	class Log {
		private $m_filename;
		private $fp;

		function __construct(string $filename){
			$this->m_filename = $filename;
			if( ! empty( $this->m_filename ) ){
				$this->fp = fopen( $this->m_filename, 'a' );
			}
		}

		function __destruct(){
			fclose($this->fp);
		}

		function log(string $msg,bool $with_time=True){
			flock( $this->fp, LOCK_EX );
			if( $with_time ){
				fputs( $this->fp, date('Y/m/d G:i:s')."\t" );
			}
			fputs( $this->fp, $msg."\n" );
			flock( $this->fp, LOCK_UN );
		}
	}
?>