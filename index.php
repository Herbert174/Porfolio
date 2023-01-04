<?php

    session_start(); //Teste

    $erro = isset($_GET['erro']) ? $_GET['erro'] : 0;
    $sucesso = isset($_GET['sucesso_registro']) ? $_GET['sucesso_registro'] : 0;

    $valor = 0;

    if(isset($_SESSION['usuario']))
        {
        $valor = $_SESSION['valor'];
        $usuario = $_SESSION['usuario'];
        }else{
             $usuario = 'Faça o login para iniciar as compras';
             }

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
            $(document).ready(function() 
                {
                $('#meu_carrinho').click( function()//Coloca de forma dinamica os produtos escolhidos pelo usuario no carrinho de compras
                    {
                    $.ajax({
                            url: 'consulta_carrinho?pagina=index',
                            success: function(data)
                                {
                                $('#produto-carrinho').html(data);
                                }
                          });
                    $.ajax({
                            url: 'atualiza_preco',
                            success: function(data)
                                {
                                $('#valor').html(data);
                                }
                          });
                    })
                function postarproduto()
                    {
                    //carrega os produtos
                    $.ajax({
                          url: 'postar_produto',
                          success: function(data)
                              {
                              $('#produtos').html(data);
                              }
                          })
                    }
                postarproduto();

                function postarslide()
                    {
                    //carrega os produtos
                    $.ajax({
                          url: 'postar_slide',
                          success: function(data)
                              {
                              $('#meu_slide').html(data);
                              }
                          })
                    }
                postarslide();
                //Esconde o elemento dinamico do carrinho de compras quando não tem nenhum usuario logado
                <?php
                    if(!isset($_SESSION['usuario']))
                        {
                        ?>
                        $('#produto-carrinho').hide();
                        $('#finalizar_compra').hide();
                        <?php
                        }
                ?>
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
                        <li><a href="#">Início</a></li>
                        <li><a href="#">Contato</a></li>
                        <li><a href="cadastrar_user">Cadastrar</a></li>
                        <li class="<?= $erro == 1 ? 'open' : '' ?><?= $sucesso == 1 ? 'open' : '' ?>">
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
                                        if($sucesso == 1)
                                            {
                                            echo '<font color="#0E7411">Conta criada com sucesso!</font>';
                                            }
                                    ?>
                                </div>
                            </ul>
                        </li>
                        <li>
                            <a id="categorias" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Categorias
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu menu-custom1" aria-labelledby="categorias">
                                    <li><a href="computadores">Computadores</a></li>
                                    <li><a href="notebooks">Notebooks</a></li>
                                    <li><a href="celulares">Celulares</a></li>
                                    <li><a href="fones">Fones</a></li>
                                    <li><a href="carregadores">Carregadores</a></li>
                                    <li><a href="calcados">Calçados</a></li>
                                    <li><a href="crud">CRUD</a></li>
                            </ul>
                        </li>
                        <li><button class="btn_custom" id="meu_carrinho" data-toggle="modal" data-target="#modal-mensagem"><img class="carrinho_compras" src="imagens/Emote1.png">Meu Carrinho</button></li>
                    </ul>

                    <img class="nav navbar-nav navbar-left imgcustom" src="imagens/twitter.png">
                    <div class="nav navbar-nav navbar-left nav-custom">
                        <p>Bem vindo: <span class="negrito"><?= $usuario ?></span></p>
                    </div>
                </div> 

            <!-- Container fluid -->
            </div>

        <!-- Barra de navegação -->
        </nav>

        <div class="modal fade" id="modal-mensagem">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                    <h4 class="modal-title">Carrinho de compras</h4>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="titulo1">Itens no carrinho</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div id="produto-carrinho" class="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <h4>Valor : <span class="negrito"><span id="valor"></span>R$</span></h4>
                                <span id="finalizar_compra">
                                    <a class="link-custom" href="pagamento"><button class="btn btn-primary">Finalizar Carrinho</button></a>
                                </span>
                            </div>
                        </div>
                    </div>                                             
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
        </div>

        <section id="conteudo">   
            <div class="container">
                <div class="row">
                    <div class="col-md-12" id="meu_slide">
                    </div>
                </div>
            </div>
        </section>

        <section id="conteudo1">
            <br>
            <div class="Container-fluid">
                <div class="col-sm-1">
                    <a href="https://web.whatsapp.com/send?phone=" target="_blank"><img class="img-whatsapp" src="imagens/whatsapp.png"> </a>
                </div>
                <div class="col-sm-10 custom1">
                    <h3 class="titulo1">Produtos</h3>
                    <div class="row borda" id="produtos">
                    </div>
                </div>
                <div class="col-sm-1">
                </div>
            </div>
        </section>

        <footer id="rodape">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <h3 class="titulo2">Nossa equipe</h3>
                    </div>
                    <div class="col-md-2">
                        <h3>Categorias</h3>
                        <a class="link-custom" href="computadores">Computadores</a><br>
                        <a class="link-custom" href="notebooks">Notebooks</a><br>
                        <a class="link-custom" href="celulares">Celulares</a><br>
                        <a class="link-custom" href="fones">Fones</a><br>
                        <a class="link-custom" href="carregadores">Carregadores</a><br>
                        <a class="link-custom" href="calcados">Calçados</a>
                    </div>
                    <div class="col-md-3">
                        <h3 class="titulo1">Utilizamos o pagseguro</h3><br>
                        <img class="img-rodape" src="imagens/img_pagseguro.png">
                    </div>
                    <div class="col-md-3">
                        <br><br><br><br><br>
                        <ul class="nav">
                            <li class="item-rede-social"><a href="#"><img src="imagens/facebook.png"></a></li>
                            <li class="item-rede-social"><a href="#"><img src="imagens/twitter.png"></a></li>
                            <li class="item-rede-social"><a href="#"><img src="imagens/instagram.png"></a></li>
                        </ul>
                    </div>
                </div> <!-- /row --><br><br>
            </div>
        </footer>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="bootstrap/js/bootstrap.min.js"></script>
        
    </body>
</html>