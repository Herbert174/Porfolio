<?php

	session_start();

    $erro = isset($_GET['erro']) ? $_GET['erro'] : 0;

    $valor = $_SESSION['valor'];

    if(isset($_SESSION['usuario']))
        {
        $usuario = $_SESSION['usuario'];
        }else{
             $usuario = 'Faça o login para iniciar as compras';
             }

    include_once("PagSeguroLibrary/PagSeguroLibrary.php");

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Loja Online</title>
        <link rel="icon" href="imagens/twitter.png">

        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- CSS -->
        <link href="estilo.css" rel="stylesheet">

        <!-- Jquery -->
        <script src="jquery-3.6.0.js"></script>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Javascript -->
        <script type="text/javascript">
            var produto_erro;
            $(document).ready(function() 
                {
	            $('#calcular').click(function() 
	                {
					let formSerialized = $('#formDestino').serialize();
					$.post('calcular_frete', formSerialized, function(resultado)
						{
						resultado = JSON.parse(resultado);
						let valorFrete = resultado.preco;
						let prazoEntrega = resultado.prazo;
						//é necessario utilizar a aspas dessa forma ` por uma questão de sintax do javascript
						$('#resultado').html(`Frete: <span class="direita"><b>R$ ${valorFrete} </b></span><br><br> Prazo de entrega: <span class="direita"><b>${prazoEntrega} dias úteis</b></span>`);
                        $.ajax({
                                url: 'atualiza_preco_total',
                                success: function(data)
                                    {
                                    $('#valor_total').html(data);
                                    }
                              });

                        $.ajax({
                                url: 'api_pagseguro',
                                success: function(data)
                                    {
                                    $('#btn_compra').html(data);
                                    }
                              });
						});
                    
					});
	            $.ajax({
                        url: 'consulta_carrinho1',
                        success: function(data)
                            {
                            $('#produto-carrinho').html(data);
                            }
                      });
                /*$.ajax({
                        url: 'atualiza_preco',
                        success: function(data)
                            {
                            $('#valor').html(data);
                            }
                      });*/
                $.ajax({
                        url: 'verifica_embalagem',
                        success: function(data)
                            {
                            $('#retorno').html(data);
                            }
                      });
                
                });
            
        </script>
    </head>

    <body>
    	<!-- Barra de Navegação -->
        <nav class="navbar navbar-default navbar-fixed-top navbar-custom">

            <!-- container-fluid para o menu aparecer na página inteira -->
            <div class="container-fluid">

                <!-- Barra de Navegação quando em colapso -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target = "#Navegacao">
                        <span class="sr-only">Alterar Menu</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>

                <!-- Barra de Navegação em estado normal -->
                <div class="collapse navbar-collapse" id="Navegacao">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="index">Início</a></li>
                        <li><a href="#">Contato</a></li>
                        <li><a href="cadastrar">Cadastrar</a></li>
                        <li class="<?= $erro == 1 ? 'open' : '' ?>">
                            <a id="entrar" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Login</a>
                            <ul class="dropdown-menu menu-custom" aria-labelledby="entrar">
                                <div class="col-md-12">
                                    <p style="color: black;">Acesse sua conta e vá as compras</p>
                                    
                                    <form method="post" action="validar_acesso" id="formLogin">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="campo_usuario" name="usuario" placeholder="Usuário" />
                                        </div>
                
                                        <div class="form-group">
                                            <input type="password" class="form-control red" id="campo_senha" name="senha" placeholder="Senha" />
                                        </div>
                
                                        <button type="buttom" class="btn btn-primary btn-custom1" id="btn_login">Entrar</button>

                                        <br /><br />                
                                    </form>
                                    <?php
                                        if($erro == 1)
                                            {   
                                            echo '<font color="#FF0000">Usuario e ou senha invalido(s)</font>';
                                            }
                                    ?>
                                </div>
                            </ul>
                        </li>
                        <li><button class="btn_custom" id="meu_carrinho" data-toggle="modal" data-target="#modal-mensagem"><img class="carrinho_compras" src="imagens/Emote1.png">Meu Carrinho</button></li>
                    </ul>

                    <img class="nav navbar-nav navbar-left imgcustom" src="imagens/twitter.png">
                    <div class="nav navbar-nav navbar-left nav-custom">
                        Bem vindo: <span class="negrito"><?= $usuario ?></span>
                    </div>
                </div> 

            <!-- Container fluid -->
            </div>

        <!-- Barra de navegação -->
        </nav>

        <section id="conteudo">
        	<div class="container">
        		<div class="row">
        			<div class="col-md-12">
        				<div class="col-md-8">
        					<div class="row">
	        					<h2>Selecione o endereço de entrega</h2>
	        					<form id="formDestino" action="">
									<p>
										<label for="">Cep de destino</label>
										<input type="text" name="sCepDestino">
									</p>

									<p><button type="button" id="calcular">Calcular</button></p>
								</form>
							</div>
							<div class="row">
								<div class="col-md-12">
									<h2>Produto(s)</h2>
									<div id="produto-carrinho" class=""></div>
									<br><br><br>
								</div>
							</div>
						</div>
        				<div class="col-md-4">
        					<div class="row">
        					<h2>Resumo da compra</h2>
        					<h4>Subtotal: <span class="negrito direita">R$ <?= $valor ?></span></h4>
        					<h4><span id="resultado"></span></h4>
                            <h3><span class="negrito"><span id="valor_total"></span></span></h3>
                            <div><p id="btn_compra"></p></div><br>
                            <h4 class="negrito" id="retorno"></h4>
        					<p>Peso limite por compra 30kg</p>
        					<p>A soma máxima das dimensões da embalagem é de no máximo 200cm (comprimento + largura + altura), acima disso será necessario realizar o pedido do restantes dos produtos em uma nova compra</p>
        					<div><button class="btn btn-default btn-block botao"><a href = "index">Continuar comprando</a></button></div>
        					<br><div><p id="btn_compra"></p></div>
        				</div>
        			</div>
        		</div>
        	</div>
        </section>

    </body>