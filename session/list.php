<!DOCTYPE html>
<meta charset="UTF-8">
<?php
	session_start();
?>
<html>
<head>
<title>list</title>
<style type="text/css">
	h2 {
		margin-bottom: 	0.5em;
	}
	table {
		margin-top: 	0.5em;
		margin-bottom: 	0.5em;
	}
	td {
		padding-left: 	0.5em;
		padding-right: 	0.5em;
		padding-top: 	0.2em;
		padding-bottom: 0.2em;
		min-width: 5em;
	}
</style>
</head>
<body>
	<h2>商品一覧</h2>
	<div style="margin-left: 2em; margin-top: 0;">
	<table class="list" border="1">
		<?php
			foreach ( $_SESSION['item_list'] as $item ) {
				print("<tr><td>".$item."</td></tr>");
			}
		?>
	</table>
	<a href="index.php">追加登録</a>
	</div>
</body>
</html>