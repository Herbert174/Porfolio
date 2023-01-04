<?php  

    session_start();

    include_once("PagSeguroLibrary/PagSeguroLibrary.php");
    $paymentRequest = new PagSeguroPaymentRequest();

    //$frete = 0;

    $valor = (float)$_SESSION['valor'];
    $frete = (float)$_SESSION['preco_frete'];

    $valortotal = $valor;
    $valorfrete = $frete;

    require_once('db.class.php');
    $id_usuario = $_SESSION['id_usuario'];

    $sql = " SELECT * FROM carrinho_de_compras WHERE id = '$id_usuario' ";

    $objDb = new database();//Instância a classe
    $link = $objDb -> conecta_mysql();//Executa função de conexão com o MySQL

    $resultado_carrinho = mysqli_query($link, $sql);

    if($resultado_carrinho)
        {
        while($produto = mysqli_fetch_array($resultado_carrinho))
            {
            $produto_id   = $produto['id_produto'];
            $produto_qntd = $produto['qntd_produto'];

            $sql = " SELECT * FROM produtos WHERE id_produto = '$produto_id' ";
            $resultado_produto = mysqli_query($link, $sql);
            if($resultado_produto)
                {
                while($dados_produto = mysqli_fetch_array($resultado_produto))
                    {
                    $nome_produto        = $dados_produto['nome_produto'];
                    $preco_produto       = $dados_produto['preco'];
                    }
                $paymentRequest->addItem($produto_id, $nome_produto, $produto_qntd, $preco_produto);
                }else{
                     echo "Erro na consulta do banco de dados";
                     }
            }
        }

    $paymentRequest->addItem('0003', 'Frete',  1, $valorfrete);

    $paymentRequest->setCurrency("BRL");

    // Referenciando a transação do PagSeguro em seu sistema  
    $paymentRequest->setReference("REF123");  
      
    // URL para onde o comprador será redirecionado (GET) após o fluxo de pagamento  
    $paymentRequest->setRedirectUrl("http://www.lojamodelo.com.br");  
      
    // URL para onde serão enviadas notificações (POST) indicando alterações no status da transação  
    $paymentRequest->addParameter('notificationURL', 'http://www.lojamodelo.com.br/nas');  
    try {
        $credentials = PagSeguroConfig::getAccountCredentials(); // getApplicationCredentials()  
        $checkoutUrl = $paymentRequest->register($credentials);  

        
        }catch(PagSeguroServiceException $e)
            {  
            die($e->getMessage());
            } 

    echo "<a class='link-custom' href='{$checkoutUrl}'><button class='btn btn-default btn-block botao btn-blue'>Avançar para o Pagseguro</button></a>";

?>