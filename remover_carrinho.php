<?php  

	session_start();

	require_once('db.class.php');

	$usuario     = $_SESSION['id_usuario'];
	$produto_id  = $_GET['produto_id'];

	$sql = " DELETE FROM carrinho_de_compras WHERE id_produto = '$produto_id' ";

	$objDb = new database();//Instância a classe
	$link = $objDb -> conecta_mysql();//Executa função de conexão com o MySQL

	$resultado = mysqli_query($link, $sql);

	if($resultado)
		{
		header('Location: consulta_produto.php?produto='.$produto_id);
		}else{
			 echo "Erro ao tentar remover item ao carrinho";
		     }

?>