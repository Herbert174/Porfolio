<?php 

	session_start();

	$_SESSION['esconder_frete'] = 0;

    $comprimento_produto = isset($_SESSION['comprimento_produto']) ? $_SESSION['comprimento_produto'] : 0;
    $altura_produto = isset($_SESSION['altura_produto']) ? $_SESSION['altura_produto'] : 0;
    $largura_produto = isset($_SESSION['largura_produto']) ? $_SESSION['largura_produto'] : 0;
    $peso_produto = isset($_SESSION['peso_produto']) ? $_SESSION['peso_produto'] : 0;

    $soma = $comprimento_produto + $altura_produto + $largura_produto;

    if($comprimento_produto > 100 || $altura_produto > 100 || $largura_produto > 100 || $soma > 200)
        {
        $_SESSION['produto_erro'] = 1;
        $dimensao_produto = "As dimensões da compra não foram aceitas pela transportadora, por favor retire alguns produtos do carrinho e tente novamente";
        echo $dimensao_produto;
        die();
        }

    if($comprimento_produto < 16 || $altura_produto < 2 || $largura_produto < 11)
    	{
        $_SESSION['produto_erro'] = 1;
    	$dimensao_produto = "As dimensões da compra foram menores que as aceitas pela transportadora";
        echo $dimensao_produto;
        die();
    	}
    
    echo "Tamanho da embalagem aceito pela transportadora";

?>