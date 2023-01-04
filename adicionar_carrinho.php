<?php 

	session_start();

	require_once('db.class.php');

	$usuario      = $_SESSION['id_usuario'];
	$id_produto   = $_SESSION['id_produto'];
	$qntd_produto = $_POST['qntd'];
	$cor          = isset($_POST['cor']) ? $_POST['cor'] : 0;
	$tamanho      = isset($_POST['tamanho']) ? $_POST['tamanho'] : 0;

	if($qntd_produto <= 0 || null)
		{
		$qntd_produto = 1;
		}

	if(!isset($usuario))
		{
		header('Location: consulta_produto.php?produto='.$id_produto);
		}

	$sql = " INSERT INTO carrinho_de_compras(id, id_produto, qntd_produto, cor, tamanho) values('$usuario', '$id_produto', '$qntd_produto', '$cor', '$tamanho') ";

	$objDb = new database();//Instância a classe
	$link = $objDb -> conecta_mysql();//Executa função de conexão com o MySQL

	$resultado = mysqli_query($link, $sql);

	if($resultado)
		{
		header('Location: consulta_produto.php?produto='.$id_produto);
		}else{
			 echo "Erro ao tentar inserir item ao carrinho";
		     }

?>