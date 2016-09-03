<!DOCTYPE html>
<meta charset="UTF-8">
<?php
	$time = $_COOKIE["time_count"];
	if( isset($time) ){
		$time++;
	}
	else{
		$time = 0;
	}
	setcookie('time_count',$time);
?>
<html>
<head>
<title>cookie</title>
</head>
<body>
	<?php
		print('アクセス回数： '.$time)
	?>
</body>
</html>