<?php

	session_start();
	$valortotal = isset($_SESSION['valor']) ? $_SESSION['valor'] : 0;
	//$valortotal_formatado = number_format($valortotal, 2, ',', '.');
	echo $valortotal;

?>