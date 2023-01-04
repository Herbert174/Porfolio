<?php  

	require_once('db.class.php');
	
	$objDb = new database();
	$link = $objDb -> conecta_mysql();

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

	if(isset($_FILES['imagem']))//Verifica se algo foi enviado para imagem através de FILES
		{
		$imagem = $_FILES['imagem'];//Guarda o arquivo em $imagem

		if($imagem['error'])//Caso o arquivo esteja corrompido, para o codigo e retorna a mensagem de erro
			die("Falha ao enviar imagem");

		if($imagem['size'] > 4194304)//Verifica se o tamanho da imagem excede o tamanho maximo, 4MB
			die("Arquivo excedeu o tamanho limite!! Max: 4MB");

		$pasta = "imagens/";//Define em $pasta o local onde a imagem será armazenada
		$nomeImagem = $imagem['name'];//Armazena o nome original do arquivo
		$novoNomeImagem = uniqid();//Gera um id unico para que os nomes das imagens não se repitam
		$extensao = strtolower(pathinfo($nomeImagem,PATHINFO_EXTENSION));//Retorna somente o nome da extensão da imagem/arquivo, transformando ele em minusculo se for preciso com a função strtolower
		
		if($extensao != "jpg" && $extensao != "png")//Verifica se a extensão enviada é jpg ou png
			die("Formato de arquivo não aceito");

		$path = $pasta.$novoNomeImagem.".".$extensao;//Define o local onde a imagem será armazenada e o nome que será salvo

		$deu_certo = move_uploaded_file($imagem['tmp_name'], $path);//Move o arquivo selecionado para a pasta de imagens/arquivo do servidor
		}

	$sql = " INSERT INTO produtos(nome_produto, resumo, qntd_estoque, preco, cumprimento, altura, largura, peso, secao, info_tec, garantia, embalagem, imagem, nome_imagem) 
		     values('$nome_produto', '$resumo', '$qntd_estoque', '$preco', '$cumprimento', '$altura', '$largura', '$peso', '$secao', '$info_tec', 'garantia', 'embalagem', '$path', '$nomeImagem') ";
	//Armazena em $sql o codigo que será enviado ao banco de dados

	if(mysqli_query($link, $sql))//Envia o codigo ao banco de dados, cadastrando as informações do produto enviado pelo usuario
		{
		//echo 'Produto registrado com sucesso!'
		header("Location: crud");//Retorna para a página inicial do CRUD
		}else{
			 echo 'Erro ao registrar usúario';
			 }

?>