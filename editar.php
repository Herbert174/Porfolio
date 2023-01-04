<?php

	session_start();
	require_once('db.class.php');

	$objDb = new database();
	$link = $objDb -> conecta_mysql();

	$id = $_GET['id_produto'];

	if($id)
		{
		//echo $id;
		$sql = " SELECT * FROM produtos WHERE id_produto = '$id' ";
		if($resultado_id = mysqli_query($link, $sql))
			{	
			$dados_id = mysqli_fetch_array($resultado_id);
			}
		}

?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Formulários</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="estilo.css">

    <style type="text/css">
    	body {background-image: none;}
    </style>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    
    <div class="container">
    	<div class="page-header">
        	<h1>Editar Produto</h1>
      	</div>

      	<div class="row">
      		<form method="POST" enctype="multipart/form-data" action="editar_action?id_produto=<?=$id?>">
        	<div class="col-sm-8">
        		<div class="form-group">
        			<label>
						Nome do produto:<br> <input type="text" name="nome_produto" value="<?= $dados_id['nome_produto']; ?>" class="form-control" maxlength="28">
					</label><br>
				</div>
				<div class="form-group">
					<label for="">
						Selecione a imagem
					</label><br>
					<a target="_blank" href="<?=$dados_id['imagem'];?>">
						<img height="50" width="50" src="<?=$dados_id['imagem']?>">
					</a><br><br>
					<input type="file" name="imagem">
				</div>
				<div class="form-group">
					<label>
						Resumo:<br>
						<textarea id="resumo" name="resumo" rows="3" cols="40"><?= $dados_id['resumo']; ?></textarea>
					</label><br>
				</div>
				<div class="form-group">
					<label>
						Informações técnicas:<br>
						<textarea id="info_tec" name="info_tec" rows="3" cols="40"><?= $dados_id['info_tec']; ?></textarea>
					</label>
				</div>
				<div class="form-group">
					<label>
						Garantia:<br>
						<textarea id="garantia" name="garantia" rows="3" cols="40"><?= $dados_id['garantia']; ?></textarea>
					</label>
				</div>
				<div class="form-group">
					<label>
						Embalagem:<br>
						<textarea id="embalagem" name="embalagem" rows="3" cols="40"><?= $dados_id['embalagem']; ?></textarea>
					</label>
				</div>
				<div class="form-group">
					<input type="submit" value="Atualizar" class="btn btn-primary">
				</div>
			</div>

			<div class="col-sm-4">
        		<div class="form-group">
					<label>
						Quantidade em estoque(un):<br> <input type="text" name="qntd_estoque" value="<?= $dados_id['qntd_estoque']; ?>" class="form-control">
					</label><br>
				</div>
				<div class="form-group">
					<label>
						Preço(R$):<br> <input type="text" name="preco" value="<?= $dados_id['preco']; ?>" class="form-control">
					</label><br>
				</div>
				<div class="form-group">
					<label>
						Cumprimento(cm):<br> <input type="text" name="cumprimento" value="<?= $dados_id['cumprimento']; ?>" class="form-control">
					</label><br>
				</div>
				<div class="form-group">
					<label>
						Altura(cm):<br> <input type="text" name="altura" value="<?= $dados_id['altura']; ?>" class="form-control">
					</label><br>
				</div>
				<div class="form-group">
					<label>
						Largura(cm):<br> <input type="text" name="largura" value="<?= $dados_id['largura']; ?>" class="form-control">
					</label><br>
				</div>
				<div class="form-group">
					<label>
						Peso(g):<br> <input type="text" name="peso" value="<?= $dados_id['peso']; ?>" class="form-control">
					</label><br>
				</div>
				<div class="form-group">
					<label>Seção:</label><br>
					<select name="secao">
						<option value="1"<?php if($dados_id['secao'] == 1)echo'selected';?>>Computadores</option>
		                <option value="2"<?php if($dados_id['secao'] == 2)echo'selected';?>>Notebooks</option>
		                <option value="3"<?php if($dados_id['secao'] == 3)echo'selected';?>>Celulares</option>
		                <option value="4"<?php if($dados_id['secao'] == 4)echo'selected';?>>Fones</option>
		                <option value="5"<?php if($dados_id['secao'] == 5)echo'selected';?>>Carregadores</option>
		                <option value="6"<?php if($dados_id['secao'] == 6)echo'selected';?>>Calçados</option>
	            	</select>
	            </div>
			</div>
			</form>
		</div>
	</div>
  </body>
</html>