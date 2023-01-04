<?php

	$valortotal_bruto = 0;

	session_start();
	$valor_produto = (float)$_SESSION['valor'];
	if(isset($_SESSION['preco_frete']))
		{
		$valor_frete = (float)$_SESSION['preco_frete'];	
		}else $valor_frete = 0;

	(float)$valortotal_bruto = $valor_produto + $valor_frete;
	$valortotal = number_format($valortotal_bruto, 2, ',', '.');

	echo "Total: R$ $valortotal";

?>