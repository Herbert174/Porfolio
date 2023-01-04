<?php
	session_start();//Habilita o uso das super globais $_SESSION

	$pagina = $_SESSION['id_produto'];

	if(!isset($_SESSION['usuario']))//Verifica se o usuario passou pela autenticação de login, caso não redireciona ele para o pagina do produto
		{
		header('Location: consulta_produto.php?produto='.$pagina);
		}

	require_once('db.class.php');//Habilita funções de conexão com o banco de dados

	$texto_comentario = $_POST['texto_comentario'];
	$id_usuario = $_SESSION['id_usuario'];
	$id_produto = $_SESSION['id_produto'];

	if($texto_comentario != '' && $id_usuario != '')//Verifica se alguma mensagem foi enviada
		{
		$objDb = new database();//instancia a classe
		$link = $objDb -> conecta_mysql();//executa função de conexão com o MySQL

		$sql = " INSERT INTO comentarios(id_usuario, comentario, id_produto) values('$id_usuario', '$texto_comentario', '$id_produto') ";

		mysqli_query($link, $sql);
		}
?>