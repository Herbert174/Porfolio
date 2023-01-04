<?php 

	session_start();

	require_once('db.class.php');

	//$id_usuario = $_SESSION['id_usuario'];
	$id_usuario = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : 0;

	$valor = 0;

	$comprimento_soma = 0;
	$altura_soma      = 0;
	$largura_soma     = 0;
	$peso_soma        = 0;
	
	$_SESSION['valor'] = 0;

	$sql = " SELECT * FROM carrinho_de_compras WHERE id = '$id_usuario' ";

	$objDb = new database();//Instância a classe
	$link = $objDb -> conecta_mysql();//Executa função de conexão com o MySQL

	$resultado_carrinho = mysqli_query($link, $sql);

	if($resultado_carrinho)
		{
		while($produto = mysqli_fetch_array($resultado_carrinho))
			{
			$produto_id   = $produto['id_produto'];
			$produto_qntd = $produto['qntd_produto'];

			$sql = " SELECT * FROM produtos WHERE id_produto = '$produto_id' ";
			$resultado_produto = mysqli_query($link, $sql);
			if($resultado_produto)
				{
				if($dados_produto = mysqli_fetch_array($resultado_produto))
					{
					$nome_produto   = $dados_produto['nome_produto'];
					$preco_produto  = $dados_produto['preco'];
					$resumo_produto = $dados_produto['resumo'];
					$imagem_produto = $dados_produto['imagem'];

					$comprimento_produto = $dados_produto['cumprimento'];
					$altura_produto      = $dados_produto['altura'];
					$largura_produto     = $dados_produto['largura'];
					$peso_produto        = $dados_produto['peso'];

					$comprimento_soma = $comprimento_soma + $comprimento_produto;
					$altura_soma      = $altura_soma + $altura_produto;
					$largura_soma     = $largura_soma + $largura_produto;
					$peso_soma        = $peso_soma + $peso_produto;

					$valor = $valor + ($preco_produto * $produto_qntd);
					$preco_produto1 = number_format($preco_produto, 2, ',', '.');
					$valor1 = number_format($valor, 2, ',', '.');

					echo '<div class="row">';
	                echo '<div class="col-md-12"><br>';
	                echo '<div class="col-md-3">';
	                echo '<img class="img-responsive img-custom3" src="'.$imagem_produto.'">';
	                echo '<br>';
	                echo '</div>';
	                echo '<div class="col-md-3">';
	                echo '<h4>'.$nome_produto.'</h4>';
	                echo '<p>'.$resumo_produto.'</p>';
	                echo '<p><span class="negrito">Valor: '.$preco_produto1.'</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A unidade</p>';
	                echo '<p>'.$produto_qntd.' Unidades no carrinho</p>';
	                echo '<a class="link-custom" href="remover_carrinho.php?produto_id='.$produto_id.'"><button class="btn btn-default btn-block botao">Remover do carrinho</button></a>';
	                echo '</div>';
	                echo '</div>';
	                echo '</div';
					}
				$_SESSION['valor'] = $valor1;

				$_SESSION['comprimento_produto'] = $comprimento_soma;
				$_SESSION['altura_produto']      = $altura_soma;
				$_SESSION['largura_produto']     = $largura_soma;
				$_SESSION['peso_produto']        = $peso_soma;
				}else{
					 echo "Erro na consulta do banco de dados";
				     }
			}
		}

?>