<?php

	session_start();
	require_once('db.class.php');

	$objDb = new database();
	$link = $objDb -> conecta_mysql();

	$sql = " SELECT * FROM produtos_destaque ";
	if($resultado_id = mysqli_query($link, $sql))
		{	
		$dados_destaque = mysqli_fetch_array($resultado_id);
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
        	<h1>Editar produtos em destaque</h1>
      	</div>

      	<div class="row">
      		<form method="POST" enctype="multipart/form-data" action="editando_slide">
        	<div class="col-sm-8">
        		<div class="form-group">
        			<label>
						Novidade 1:<br> <input type="text" name="novidade1" value="<?= $dados_destaque['novidade1']; ?>" class="form-control">
					</label><br>
				</div>
                <div class="form-group">
        			<label>
                        Novidade 2:<br> <input type="text" name="novidade2" value="<?= $dados_destaque['novidade2']; ?>" class="form-control">
					</label><br>
				</div>
                <div class="form-group">
        			<label>
                        Novidade 3:<br> <input type="text" name="novidade3" value="<?= $dados_destaque['novidade3']; ?>" class="form-control">
					</label><br>
				</div>
				<div class="form-group">
        			<label>
                        Mais vendido:<br> <input type="text" name="mais_vendido" value="<?= $dados_destaque['mais_vendido']; ?>" class="form-control">
					</label><br>
				</div><div class="form-group">
        			<label>
						Destaque:<br> <input type="text" name="destaque" value="<?= $dados_destaque['destaque']; ?>" class="form-control">
					</label><br>
				</div>
				<div class="form-group">
					<input type="submit" value="Atualizar" class="btn btn-primary">
				</div>
			</div>
			</form>
		</div>
	</div>
  </body>
</html>