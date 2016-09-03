<!DOCTYPE html>
<meta charset="UTF-8">
<html>
<head>
<title>uploaded</title>
</head>
<style type="text/css">
	html {
		font-size: 120%;
	}
</style>
<body>
	<?php
		$filename = $_FILES['upload_file']['name'];
		if( move_uploaded_file( $_FILES['upload_file']['tmp_name'], "./upload/".$filename ) == FALSE ){
			print('<em>Error: Failed to upload.</em><br/>');
			print(' '.$_FILES['upload_file']['error']);
		}
		else {
			print('<em>File "'.$filename.'" was successfully uploaded.</em>');
		}
	?>
</body>
</html>