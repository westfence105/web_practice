<!DOCTYPE html>
<meta charset="UTF-8">
<?php
	session_start();
?>
<html>
<head>
<title>regist</title>
</head>
<body>
	<?php
		$item = $_POST['item_name'];
		$_SESSION['item_list'][] = $item;
		print("<pre>次の商品を追加しました：\t".$item."</pre><br/>");
	?>
	<a href="list.php">商品一覧へ</a>
</body>
</html>