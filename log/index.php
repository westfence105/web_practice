<!DOCTYPE html>
<meta charset="UTF-8">
<html>
<head>
<title>log</title>
<style type="text/css">
	.log{
		padding-left: 1em;
		white-space: pre;
	}
</style>
</head>
<body>
	<?php
		print( date('Y年n月j日 G:i:s') );

		$fp = fopen('./log/access.log','a+');
		flock( $fp, LOCK_EX );
		fputs( $fp, date('Y/m/d G:i:s')."\t".$_SERVER['REMOTE_ADDR']."\t".$_SERVER['HTTP_USER_AGENT']."\n" );
		flock( $fp, LOCK_UN );

		print('<p>');
		print('<h2>Access Log</h2>');

		rewind($fp);
		print('<div class="log">');
		while (!feof($fp)) {
			print( fgets($fp) );
		}
		print('</div>');
		print('</p>');

		fclose($fp);
	?>
</body>
</html>