<?php

	require_once('db.class.php');

	$objDb = new database();
	$link = $objDb -> conecta_mysql();

	$id = $_GET['id'];

	if($id)
		{
		$sql = " DELETE FROM usuarios WHERE id = '$id' ";
		mysqli_query($link, $sql);
		}

	header("Location: crud.php");

?>