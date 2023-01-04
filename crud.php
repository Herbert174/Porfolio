<?php 
 
	require_once('db.class.php');//Requisita o script que contém as configurações para conectar com o banco de dados

	$objDb = new database();//Instância objDb com as propriedades database de db.class
	$link = $objDb -> conecta_mysql();//Cria uma conexão com o banco de dados e armazena em link

	$lista = [];//Cria um array para armazenar o resultado da leitura do banco de dados
	$sql = " SELECT * FROM produtos ";//Armazena em sql o codigo que será enviado para o banco de dados

	if($resultado_lista = mysqli_query($link, $sql))/*Se conecta com o banco de dados e envia o codigo de sql
													recuperando o retorno em resultado_lista*/
		{
		$lista = mysqli_fetch_all($resultado_lista, MYSQLI_ASSOC);
		}//Reorganiza em lista o retorno do banco de dados armazenado em resultado_lista
	
?>

<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Crud</title>
		<!-- Bootstrap -->
	    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	    <link rel="stylesheet" href="estilo.css">

	    <style type="text/css">
	    	body {background-image: none;}
	    </style>
	</head>

	<body>
		<div class="container"><!-- Estrutura onde será exibido a lista do CRUD de produtos -->
	    	<div class="page-header">
	        	<h1>Listagem de produtos</h1>
	      	</div>

		    <div class="row">
		    	<div class="col-sm-12">
					<table class="table table-hover">
						<thead class="tabela_custom">
							<tr>
								<th scope="col">ID</th>
								<th scope="col">Imagem</th>
								<th scope="col">Nome produto</th>
								<th scope="col">Preço</th>
								<th scope="col">Ações</th>
							</tr>
						</thead>
						<tbody><!-- Area onde é exibido os produtos já cadastrados no banco de dados -->
						<?php  
							foreach ($lista as $produtos):?><!-- Laço de repetição responsável por organizar e exibir
							cada produto da lista de produtos armazenado no banco de dados -->
								<tr>
									<td scope="row"><?=$produtos['id_produto'];?></td>
									<td><img height="50" width="50" src="<?=$produtos['imagem']?>"></td>
									<td><?=$produtos['nome_produto'];?></td>
									<td><?=$produtos['preco'];?></td>
									<td>
										<a href="editar?id_produto=<?=$produtos['id_produto'];?>">[ Editar ]</a>
										<a href="excluir?id_produto">[ Excluir ]</a>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		<a href="editar_slide">Atualizar produtos em destaque</a><br>
		<a href="cadastrar">Cadastrar produto</a><br><!-- Link que leva para area de cadastro de produtos -->
		<a href="index">Pagina Inicial</a><br><br><!-- Link que leva para a pagina inicial da loja -->
		</div>
	</body>
</html>