<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Cadastro de produto</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="estilo.css">

    <style type="text/css">
    	body {background-image: none;}
    </style>

  </head>

  <body>
    
    <div class="container"><!-- Local onde será exibido o formulário de cadastro dos produtos -->
    	<div class="page-header">
        	<h1>Cadastrar Produto</h1>
      	</div>

      	<div class="row"><!-- Row onde ficará o form que será enviado para o banco de dados -->
      		<form enctype="multipart/form-data" method="POST" action="cadastrando">
        	<div class="col-sm-8">
        		<div class="form-group">
	        		<label>
						Nome do produto:<br> <input type="text" name="nome_produto" class="form-control" maxlength="28">
					</label><br>
				</div>
				<div class="form-group">
					<label>
						Imagem:<br><br>
						<input type="hidden" name="MAX_FILE_SIZE" value="99999999"/><!-- Tamanho max. permitido -->
						<input name="imagem" type="file"/><!-- Ferramenta de busca necessária para selecionar imagem -->
					</label><br>
				</div>
				<div class="form-group">
					<label>
						Resumo:<br>
						<textarea id="resumo" name="resumo" rows="3" cols="40">Coloque aqui uma descrição do produto.</textarea>
					</label><br>
				</div>
				<div class="form-group">
					<label>
						Informações técnicas:<br>
						<textarea id="info_tec" name="info_tec" rows="3" cols="40">Coloque aqui as informações técnicas do produto.</textarea>
					</label>
				</div>
				<div class="form-group">
					<label>
						Garantia:<br>
						<textarea id="garantia" name="garantia" rows="3" cols="40">Informações sobre a garantia do produto.</textarea>
					</label>
				</div>
				<div class="form-group">
					<label>
						Embalagem:<br>
						<textarea id="embalagem" name="embalagem" rows="3" cols="40">Informações sobre o conteudo da embalagem do produto.</textarea>
					</label>
				</div>
				<div class="form-group">
					<input type="submit" class="btn btn-primary" value="Cadastrar"><!-- Botão de envio -->
				</div>
        	</div>

        	<div class="col-sm-4">
        		<div class="form-group">
	        		<label>
						Quantidade em estoque(un):<br> <input type="text" name="qntd_estoque" value="0">
					</label><br>
				</div>
				<div class="form-group">
					<label>
						Preço(R$):<br> <input type="text" name="preco" value="0.00">
					</label><br>
				</div>
				<div class="form-group">
					<label>
						Cumprimento(cm):<br> <input type="text" name="cumprimento" value="0">
					</label><br>
				</div>
				<div class="form-group">
					<label>
						Altura(cm):<br> <input type="text" name="altura" value="0">
					</label><br>
				</div>
				<div class="form-group">
					<label>
						Largura(cm):<br> <input type="text" name="largura" value="0"><br>
					</label>
				</div>
				<div class="form-group">
					<label>
						Peso(g):<br> <input type="text" name="peso" value="0">
					</label><br>
				</div>
				<div class="form-group">
					<label>Seção:</label><br>
					<select name="secao">
		                <option value="1">Computadores</option>
		                <option value="2">Notebooks</option>
		                <option value="3">Celulares</option>
		                <option value="4">Fones</option>
		                <option value="5">Carregadores</option>
		                <option value="6">Calçados</option>
	            	</select>
	            </div>
        	</div>
        	</form>	
		</div>
	</div>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>

  </body>
</html>