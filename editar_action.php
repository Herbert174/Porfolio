<?php

	require_once('db.class.php');

	$objDb = new database();
	$link = $objDb -> conecta_mysql();

	$id = $_GET['id_produto'];
	$nome_produto = $_POST['nome_produto'];
	$resumo = $_POST['resumo'];
	$qntd_estoque = $_POST['qntd_estoque'];
	$preco = $_POST['preco'];
	$cumprimento = $_POST['cumprimento'];
	$altura = $_POST['altura'];
	$largura = $_POST['largura'];
	$peso = $_POST['peso'];
	$secao = $_POST['secao'];
	$info_tec = $_POST['info_tec'];
	$garantia = $_POST['garantia'];
	$embalagem = $_POST['embalagem'];

	if(!empty($_FILES['imagem']['name']))
		{
		$imagem = $_FILES['imagem'];

		//if($imagem['error'])
			//die("Falha ao enviar arquivo");

		if($imagem['size'] > 2097152)
			die("Arquivo excedeu o tamanho limite!! Max: 2MB");

		$pasta = "imagens/";
		$nomeImagem = $imagem['name'];//nome original do arquivo
		$novoNomeImagem = uniqid();//gera um id unico para que os nomes das imagens não se repitam
		$extensao = strtolower(pathinfo($nomeImagem,PATHINFO_EXTENSION));//retorna somento o nome da extensão da imagem/arquivo, transformando ele em minusculo se for preciso com a função strtolower
		
		if($extensao != "jpg" && $extensao != "png" && $extensao!= 0)//verifica se a extensão enviada é jpg ou png
			die("Tipo de arquivo não aceito");

		$path = $pasta.$novoNomeImagem.".".$extensao;

		$deu_certo = move_uploaded_file($imagem['tmp_name'], $path);//Move o arquivo selecionado para a pasta de imagens/arquivo do servidor
		}

	if($nome_produto && $resumo && empty($_FILES['imagem']['name']))
		{
		$sql = " UPDATE produtos SET nome_produto = '$nome_produto', resumo = '$resumo', qntd_estoque = '$qntd_estoque', preco = '$preco', cumprimento = '$cumprimento', altura = '$altura', largura = '$largura', peso = '$peso', secao = '$secao', info_tec = '$info_tec', garantia = '$garantia', embalagem = '$embalagem' WHERE id_produto = '$id' ";
		if($resultado_id = mysqli_query($link, $sql))
			{
			header("Location: crud");
			}
		}else{
			 if($nome_produto && $resumo && !empty($_FILES['imagem']['name']))
			 	{
			 	$sql = " UPDATE produtos SET nome_produto = '$nome_produto', resumo = '$resumo', qntd_estoque = '$qntd_estoque', preco = '$preco', cumprimento = '$cumprimento', altura = '$altura', largura = '$largura', peso = '$peso', secao = '$secao', info_tec = '$info_tec', garantia = '$garantia', embalagem = '$embalagem', imagem = '$path', nome_imagem = '$nomeImagem' WHERE id_produto = '$id' ";
				if($resultado_id = mysqli_query($link, $sql))
					{
					header("Location: crud");
					}
			 	}
			 }
?>