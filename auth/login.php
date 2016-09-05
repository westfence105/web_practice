<?php
	require_once 'funcs.php';
	check_login(False);

	try{
		$pdo = new PDO('mysql:host=localhost;dbname=auth_test;','root','');
	}
	catch(PDOException $e){
		header('Content-type: text/plain; charset=UTF-8',true,500);
		exit($e->getMessage());
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
	
</body>
</html>