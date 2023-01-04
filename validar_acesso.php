<?php  

	session_start();//Habilita o acesso as superglobais SESSION

	require_once('db.class.php');//Habilita funções do db.class.php

	$usuario = $_POST['usuario'];
	$senha = md5($_POST['senha']);

	//Codigo enviado para o banco de dados, responsavel por comparar se os usuario e senha enviados pelo usuario são cadastrado no sistema
	$sql = " SELECT id, nome, email FROM usuarios WHERE nome = '$usuario' AND senha = '$senha' ";

	$objDb = new database();//Instância a classe
	$link = $objDb -> conecta_mysql();//Executa função de conexão com o MySQL

	$resultado_id = mysqli_query($link, $sql);//Se conecta ao MySQL e envia o codigo da variavel $sql para o banco de dados

	//Dependendo do codigo enviado ao MySQL ele enviará certo tipo de retorno funções:

	//update retorna true/false - True se o comando for executado ou false se deu algum erro
	//insert retorna true/false -                    ||                  ||
	//delete retorna true/false -                    ||                  ||
	//select retorna a informação requisitada se deu certo ou false se deu algum erro

	if($resultado_id)
		{
		$dados_usuario = mysqli_fetch_array($resultado_id);
		if(isset($dados_usuario['nome']))
			{
			$_SESSION['id_usuario'] = $dados_usuario['id'];
			$_SESSION['usuario'] = $dados_usuario['nome'];
			$_SESSION['email'] = $dados_usuario['email'];
			$objDb->desconecta_mysql($link);

			header('Location: index.php');
			}else{
				 $objDb->desconecta_mysql($link);
				 header('Location: index.php?erro=1');
				 }
		}else{
			 echo 'Erro na execução da consulta, favor entrar em contato com o admin do site';
			 }
?>