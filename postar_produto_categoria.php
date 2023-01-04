<?php
    require_once('db.class.php');

    $secao = $_GET['secao'];

    $objDb = new database();
    $link = $objDb -> conecta_mysql();

    $lista = [];
    $sql = " SELECT * FROM produtos where secao = '$secao' ";

    if($resultado_lista = mysqli_query($link, $sql))
        {
        $lista = mysqli_fetch_all($resultado_lista, MYSQLI_ASSOC);
        }
    $_SESSION['lista'] = $lista;

    $count = 1;
    foreach ($lista as $produtos)
        {
        $preco_bruto = $produtos['preco'];
        $preco = number_format($preco_bruto, 2, ',', '.');
        echo '<div class="col-md-3">';
        echo '<a href="consulta_produto?produto='.$produtos['id_produto'].'">';
        echo '<img class="img-responsive img-custom" src="'.$produtos['imagem'].'"></a><br>';
        echo '<p><b>Produto:</b> <span class="direita">'.$produtos['nome_produto'].'</span></p>';
        echo '<p><b>Preço:</b> <span class="direita">R$ '.$preco.'</span></p>';
        echo '</div>';
        if($count == 0)
            {
            echo '</div>';
            }
        }
?>