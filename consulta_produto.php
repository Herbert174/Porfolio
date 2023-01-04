<?php  

	session_start();

	require_once('db.class.php');

	$id_produto = $_GET['produto'];//Recupera o id do produto á ser consultado no banco de dados

	$sql = " SELECT * FROM produtos WHERE id_produto = '$id_produto' ";

	$objDb = new database();//Instância a classe
	$link = $objDb -> conecta_mysql();//Executa função de conexão com o MySQL

	$resultado_id = mysqli_query($link, $sql);//Se conecta ao MySQL e envia o codigo da variavel $sql

	if($resultado_id)
		{
		$dados_produto = mysqli_fetch_array($resultado_id);
		if(isset($dados_produto['nome_produto']))
			{
			$_SESSION['id_produto']     = $dados_produto['id_produto'];
			$_SESSION['nome_produto']   = $dados_produto['nome_produto'];
			$_SESSION['qntd_estoque']   = $dados_produto['qntd_estoque'];
			$_SESSION['preco']          = $dados_produto['preco'];
			$_SESSION['resumo']         = $dados_produto['resumo'];
			$_SESSION['imagem']         = $dados_produto['imagem'];
			$_SESSION['avaliacoes']     = $dados_produto['avaliacoes'];
			$_SESSION['num_avaliacoes'] = $dados_produto['num_avaliacoes'];
			$_SESSION['info_tec']       = $dados_produto['info_tec'];
			$_SESSION['embalagem']      = $dados_produto['embalagem'];
			$_SESSION['garantia']       = $dados_produto['garantia'];

			header('Location: pagina_produto');

			}else{
				 echo "Produto não cadastrado";
			     }
		}else{
			 echo "Erro na consulta do banco de dados";
		     }

?>