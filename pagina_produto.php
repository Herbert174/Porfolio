<?php

    session_start();

    $avalie         = isset($_GET['avalie']) ? $_GET['avalie'] : 0;

    $id_produto     = $_SESSION['id_produto'];
    $qntd_estoque   = $_SESSION['qntd_estoque'];
    $nome_produto   = $_SESSION['nome_produto'];
    $preco_bruto    = $_SESSION['preco'];
    $resumo         = $_SESSION['resumo'];
    $imagem         = $_SESSION['imagem'];
    $valor          = $_SESSION['valor'];
    $avaliacoes     = $_SESSION['avaliacoes'];
    $num_avaliacoes = $_SESSION['num_avaliacoes'];
    $info_tec       = $_SESSION['info_tec'];
    $embalagem      = $_SESSION['embalagem'];
    $garantia       = $_SESSION['garantia'];

    //$_SESSION['pagina_produto'] = 'pc_produto1.php';
    $erro = isset($_GET['erro']) ? $_GET['erro'] : 0;

    if(isset($_SESSION['usuario']))
        {
        $usuario = $_SESSION['usuario'];
        }else{
             $usuario = 'Faça o login para iniciar as compras';
             }

    $preco_parcelado = $preco_bruto / 18;
    $preco = number_format($preco_bruto, 2, ',', '.');
    $parcela = number_format($preco_parcelado, 2, ',', '.');

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

        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

        <!-- CSS -->
        <link href="estilo.css" rel="stylesheet">

        <!-- Jquery -->
        <script src="jquery-3.6.0.js"></script>
        <script src='jquery.elevatezoom.js'></script>

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
                $('#comprar').click( function()
                    {
                    $.ajax({
                            url: 'consulta_carrinho',
                            success: function(data)
                                {
                                $('#produto-carrinho').html(data);
                                $('#modal-mensagem').modal();
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
                $('#meu_carrinho').click( function()
                    {
                    $.ajax({
                            url: 'consulta_carrinho',
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
                $('#btn_comentario').click( function()
                    {
                    if($('#texto_comentario').val().length > 0)
                        {
                        $('#modal-avalie').modal();
                        $.ajax({
                              url: 'inclui_comentarios',
                              method: 'post',
                              data: {texto_comentario: $('#texto_comentario').val() },
                              success: function(data)
                                {
                                $('#texto_comentario').val('');
                                atualizacomentario();
                                }
                              });
                        }
                    });
                function atualizacomentario()
                    {
                    //carrega os comentarios
                    $.ajax({
                          url: 'postar_comentario',
                          success: function(data)
                              {
                              $('#comentarios').html(data);
                              //Elementos criados por um script só existem pro codigo no momento em que ele for executado
                              //portanto se você precisa usar um elemento de algum script você precisa usa-lo no momento 
                              //em que ele for carregado
                              $('.btn_apagar').click( function()
                                {
                                var id_tweets = $(this).data('id_comentario');

                                $.ajax({
                                        url: 'apagar_comentario',
                                        method: 'post',
                                        data: {id_tweet: id_tweets},
                                        success: function(data)
                                            {
                                            atualizacomentario();
                                            }
                                      })
                                });
                              }
                          })
                    }
                atualizacomentario();
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
                        <li><a href="index">Início</a></li>
                        <li><a href="#">Contato</a></li>
                        <li><a href="#">Cadastrar</a></li>
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
                      <div class="col-md-12">
                        <div class="col-md-3">
                            <img class="img-responsive img-custom3" src=<?= $imagem ?>>
                        </div>
                        <div class="col-md-3">
                          <h4><?= $nome_produto ?></h4>
                          <p><?= $resumo ?></p>
                          <p class="negrito">Valor: <?= $preco ?></p>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="col-md-12">
                            <form action="adicionar_carrinho" method="post">
                                <br>
                                <span class="negrito">Quantidade: </span>
                                <input class="input-custom" type="number" id="numero" name="qntd" min="1" max="10" step="1"><br><br>
                                <input type="submit" class="btn btn-success" name="" value="Adicionar ao carrinho">
                            </form>
                        </div>
                      </div>
                    </div>
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

        <div class="modal fade" id="modal-avalie">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
                    <h4 class="modal-title">Avalie</h4>
                </div>
                <div class="modal-body">
                  <div class="container">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="col-md-4">
                            <form method="post" action="avalie" enctype="multipart/form-data">
                                <div class="estrelas">
                                    <input type="radio" id="vazio" name="estrela" value=""checked>

                                    <label for="estrela_um"><i class="fa"></i></label>
                                    <input type="radio" id="estrela_um" name="estrela" value="1">

                                    <label for="estrela_dois"><i class="fa"></i></label>
                                    <input type="radio" id="estrela_dois" name="estrela" value="2">

                                    <label for="estrela_tres"><i class="fa"></i></label>
                                    <input type="radio" id="estrela_tres" name="estrela" value="3">

                                    <label for="estrela_quatro"><i class="fa"></i></label>
                                    <input type="radio" id="estrela_quatro" name="estrela" value="4">

                                    <label for="estrela_cinco"><i class="fa"></i></label>
                                    <input type="radio" id="estrela_cinco" name="estrela" value="5"><br>
                                    
                                    <?= $num_avaliacoes ?>
                                    <span>avaliações</span>
                                    <br><br>
                                    <input type="submit" value="Enviar avaliação">
                                </div>
                            </form>
                        </div>
                      </div>
                    </div>
                  </div>                                             
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

        <section id="conteudo1"><br>
            <div class="container borda1">
                <div class="row">
                    <div class="col-md-6">
                        <div class="img-produto">
                            <img id="zoom_01" class="img-responsive img-custom2" src="<?=$imagem?>">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="col-md-12">
                            <h2>R$ <?=$preco?></h2>
                            <p>À vista no PIX com até 10% OFF</p>
                            <p class="negrito">R$ <?=$preco?></p>
                            <p>Em até 18x de <span class="negrito">R$ <?=$parcela?></span> sem juros no cartão Ou em 1x no cartão com até <span class="negrito">10% OFF</span></p>
                            <p>Quantidade no estoque: <?= $qntd_estoque ?>un.</p>
                            <button class="btn btn-primary btn-lg btn-custom1" id="comprar">Comprar</button>
                            <h3>Avalie</h3>
                            <?php 
                                if(isset($_SESSION['erro_avalie']))
                                    {
                                    echo "É necessario realizar o login e escolher uma nota para fazer a avaliação! <br>";
                                    unset($_SESSION['erro_avalie']);//destroi a sessão erro avalie
                                    }
                            ?>
                            <form method="post" action="avalie" enctype="multipart/form-data">
                                <div class="estrelas">
                                    <input type="radio" id="vazio" name="estrela" value="">

                                    <label for="estrela_um"><i class="fa"></i></label>
                                    <input type="radio" id="estrela_um" name="estrela" value="1">

                                    <label for="estrela_dois"><i class="fa"></i></label>
                                    <input type="radio" id="estrela_dois" name="estrela" value="2">

                                    <label for="estrela_tres"><i class="fa"></i></label>
                                    <input type="radio" id="estrela_tres" name="estrela" value="3">

                                    <label for="estrela_quatro"><i class="fa"></i></label>
                                    <input type="radio" id="estrela_quatro" name="estrela" value="4">

                                    <label for="estrela_cinco"><i class="fa"></i></label>
                                    <input type="radio" id="estrela_cinco" name="estrela" value="5" checked><br>
                                    
                                    <?= $num_avaliacoes ?>
                                    <span>avaliações</span><br><br>

                                    <span>Nota geral do produto: <span class="negrito"><?= $avaliacoes ?></span></span>

                                    <?php 
                                        if($avalie == 1)
                                            {
                                            echo "<br><br>Avaliação feita com sucesso <br>";
                                            $avalie = 0;
                                            }
                                    ?>

                                    <a href="https://web.whatsapp.com/send?phone=" target="_blank"><img class="img-whatsapp" src="imagens/whatsapp.png"> </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <h2>Comentários</h2>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="input-group">
                                    <input type="text" id="texto_comentario" class="form-control" placeholder="O que você achou do produto?" maxlength="140">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" id="btn_comentario" type="button">Postar avaliação</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div id="comentarios" class="list-group"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">

                        <div class="page-header">
                            <h2>Produto</h2>
                            <p class="lead">Conheça mais sobre o produto</p>
                        </div><!-- page-header -->

                        <!-- Criação das abas -->
                        <ul class="nav nav-tabs" role="tablist"> 
                            <li class="active"><a href="#descricao" role="tab" data-toggle="tab">Descrição do produto</a></li>
                            <li><a href="#info_tec" role="tab" data-toggle="tab">Informações técnicas</a></li>
                            <li><a href="#embalagem" role="tab" data-toggle="tab">Conteúdo da embalagem</a></li>
                            <li><a href="#garantia" role="tab" data-toggle="tab">Garantia</a></li>
                        </ul>
                        <!-- Conteúdo das abas -->
                        <div class="tab-content">
                            
                            <!-- Aba informações -->
                            <div class="tab-pane active" role="tabpanel" id="descricao">
                                <h2>DESCRIÇÃO DO PRODUTO</h2>
                                <p><?=$resumo?></p>
                            </div>

                            <!-- Aba avaliações -->
                            <div class="tab-pane" role="tabpanel" id="info_tec">
                                <h2>INFORMAÇÕES TÉCNICAS</h2>
                                <p><?=$info_tec?></p>
                            </div>

                            <!-- Aba compre também -->
                            <div class="tab-pane" role="tabpanel" id="embalagem">
                                <h3>Conteúdo da Embalagem:</h3>
                                <p><?=$embalagem?></p>
                            </div>

                            <div class="tab-pane" role="tabpanel" id="garantia">
                                <h3>Garantia:</h3>
                                <p><?=$garantia?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <footer id="rodape">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                    </div>
                    <div class="col-md-4">
                        <ul class="nav">
                            <li class="item-rede-social"><a href="#"><img src="imagens/facebook.png"></a></li>
                            <li class="item-rede-social"><a href="#"><img src="imagens/twitter.png"></a></li>
                            <li class="item-rede-social"><a href="#"><img src="imagens/instagram.png"></a></li>
                        </ul>
                    </div>
                </div> <!-- /row --><br><br>
            </div>
        </footer>

        <script>
            $('#zoom_01').elevateZoom({
            zoomType: "inner",
            cursor: "crosshair",
            zoomWindowFadeIn: 500,
            zoomWindowFadeOut: 750
            });
        </script>

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="bootstrap/js/bootstrap.min.js"></script>
    </body>
</html>