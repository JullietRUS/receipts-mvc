<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/ReceiptController.php');

$List = new ReceiptController(10);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Receipts book</title>
	<link rel="stylesheet" href="assets/style.css">
</head>
<body>
<?php  $List->view(); ?>
</body>
</html>


