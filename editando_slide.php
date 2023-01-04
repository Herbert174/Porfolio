<?php

	require_once('db.class.php');

	$objDb = new database();
	$link = $objDb -> conecta_mysql();

	$novidade1 = $_POST['novidade1'];
	$novidade2 = $_POST['novidade2'];
	$novidade3 = $_POST['novidade3'];
	$mais_vendido = $_POST['mais_vendido'];
	$destaque = $_POST['destaque'];

	$sql = " UPDATE produtos_destaque SET novidade1 = '$novidade1', novidade2 = '$novidade2', novidade3 = '$novidade3', mais_vendido = '$mais_vendido', destaque = '$destaque' ";
	if($resultado_id = mysqli_query($link, $sql))
		{
		header("Location: crud");
		}
?>