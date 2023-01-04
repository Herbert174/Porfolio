<?php  

	require_once('db.class.php');

	//Recupera a partir da superglobal POST as informações do formulário
	$usuario = $_POST['usuario'];
	$email   = $_POST['email'];
	$senha   = md5($_POST['senha']);

	$objDb = new database();//Instância a classe
	$link = $objDb -> conecta_mysql();//Executa função de conexão com o MySQL

	$usuario_existe = false;
	$email_existe = false;

	//Verificar se o usuario já existe no banco de dados
	$sql = " SELECT * FROM usuarios where nome = '$usuario' ";

	if($resultado_id = mysqli_query($link, $sql))
		{
		$dados_usuario = mysqli_fetch_array($resultado_id);

		if(isset($dados_usuario['nome']))
			{
			$usuario_existe = true;
			}
		}

	//Verificar se o email já existe no banco de dados
	$sql = " SELECT * FROM usuarios where email = '$email' ";

	if($resultado_id = mysqli_query($link, $sql))
		{
		$dados_usuario = mysqli_fetch_array($resultado_id);

		if(isset($dados_usuario['email']))
			{
			$email_existe = true;
			}
		}

	//Se o usuario ou o email existir no banco de dados retorna um erro e para a execução do codigo, retornando para a pagina de cadastro
	if($usuario_existe || $email_existe)
		{
		$retorno_get = '';
		if($usuario_existe)
			{
			$retorno_get.= "erro_usuario=1&";
			}
		if($email_existe)
			{
			$retorno_get.= "erro_email=1&";
			}

		header('Location: cadastrar_user.php?'.$retorno_get);
		die();
		}

	//Registra usuario, email e senha enviados pelo usuario para o banco de dados e volta para a pagina inicial
	$sql = " INSERT INTO usuarios(nome, email, senha) values('$usuario', '$email', '$senha') ";

	if(mysqli_query($link, $sql))
		{
		$retorno_get.= "sucesso_registro=1&";
		header('Location: index.php?'.$retorno_get);
		}else{
			 echo 'Erro ao registrar usúario';
			 }

?>