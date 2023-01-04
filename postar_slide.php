<?php
    require_once('db.class.php');

    $objDb = new database();
    $link = $objDb -> conecta_mysql();

    $lista = [];
    $destaque = [];
    $sql = " SELECT * FROM produtos ";

    if($resultado_lista = mysqli_query($link, $sql))
        {
        $lista = mysqli_fetch_all($resultado_lista, MYSQLI_ASSOC);
        }
    
    $sql = " SELECT * FROM produtos_destaque ";

    if($resultado_lista = mysqli_query($link, $sql))
        {
        $destaque = mysqli_fetch_all($resultado_lista, MYSQLI_ASSOC);
        }
    $Mais_vendido = $destaque[0]['mais_vendido'] - 1;
    $Novidades1 = $destaque[0]['novidade1'] - 1;
    $Novidades2 = $destaque[0]['novidade2'] - 1;
    $Novidades3 = $destaque[0]['novidade3'] - 1;
    $Destaque = $destaque[0]['destaque'] - 1;

    echo '<div class="col-md-3">';
    echo '<h2 class="titulo1">Mais vendido</h2>';
    echo '<a href="consulta_produto?produto='.$lista[$Mais_vendido]['id_produto'].'"><img class="img-responsive img-custom1" src="'.$lista[$Mais_vendido]['imagem'].'"></a>';
    echo '</div>';
    echo '<div class="col-md-6 tamanho">';
    echo '<h2 class="titulo1">Novidades</h2>';
    echo '<div id="myCarousel" class="carousel slide custom" data-ride="carousel">';
    echo '<ol class="carousel-indicators">';
    echo '<li data-target="#myCarousel" data-slite-to="0" class="active"></li>';
    echo '<li data-target="#myCarousel" data-slite-to="1"></li>';
    echo '<li data-target="#myCarousel" data-slite-to="2"></li>';
    echo '</ol>';
    echo '<div class="carousel-inner">';
    echo '<div class="item active">';
    echo '<a href="consulta_produto?produto='.$lista[$Novidades1]['id_produto'].'"><img src="'.$lista[$Novidades1]['imagem'].'" alt="Imagem 1" style="width: 100%; height: 300px;"></a>';
    echo '</div>';
    echo '<div class="item">';
    echo '<a href="consulta_produto?produto='.$lista[$Novidades2]['id_produto'].'"><img src="'.$lista[$Novidades2]['imagem'].'" alt="Imagem 2" style="width: 100%; height: 300px;"></a>';
    echo '</div>';
    echo '<div class="item">';
    echo '<a href="consulta_produto?produto='.$lista[$Novidades3]['id_produto'].'"><img src="'.$lista[$Novidades3]['imagem'].'" alt="Imagem 3" style="width: 100%; height: 300px;"></a>';
    echo '</div>';
    echo '</div>';
    echo '<a class="left carousel-control" href="#myCarousel" data-slide="prev">';
    echo '<span class="glyphicon glyphicon-chevron-left"></span>';
    echo '<span class="sr-only">Anterior</span>';
    echo '</a>';
    echo '<a class="right carousel-control" href="#myCarousel" data-slide="next">';
    echo '<span class="glyphicon glyphicon-chevron-right"></span>';
    echo '<span class="sr-only">Proximo</span>';
    echo '</a>';
    echo '</div>';
    echo '</div>';
    echo '<div class="col-md-3">';
    echo '<h2 class="titulo1">Destaque</h2>';
    echo '<a href="consulta_produto?produto='.$lista[$Destaque]['id_produto'].'"><img class="img-responsive img-custom1" src="'.$lista[$Destaque]['imagem'].'"></a>';
    echo '</div>';

?>