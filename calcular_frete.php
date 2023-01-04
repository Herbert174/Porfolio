<?php 

	session_start();

	$comprimento_produto = $_SESSION['comprimento_produto'];
	$altura_produto      = $_SESSION['altura_produto'];
	$largura_produto     = $_SESSION['largura_produto'];
	$peso_produto        = $_SESSION['peso_produto'];
	//$cep_destino         = '04218000';

	$info_produto = array
						(
						'sCepOrigem'     => '01310100',
						//'sCepDestino'    => $cep_destino,
						'nVlPeso'        => $peso_produto,
						'nCdFormato'     => '1',
						'nVlComprimento' => $comprimento_produto,
						'nVlAltura'      => $altura_produto,
						'nVlLargura'     => $largura_produto,
						'nCdServico'     => '04014',
						);

						$retorno_produto = http_build_query($info_produto);

	$variaveis_extras = http_build_query($_POST);

	$url = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?nCdEmpresa=&sDsSenha=&sCdAvisoRecebimento=n&sCdMaoPropria=n&nVlValorDeclarado=0&nVlDiametro=0&StrRetorno=xml&nIndicaCalculo=3&".$retorno_produto."&".$variaveis_extras;

	$unparsedResult = file_get_contents($url);
	$parsedResult = simplexml_load_string($unparsedResult);

	$retorno = array
		(
		'preco' => strval($parsedResult->cServico->Valor),
		'prazo' => strval($parsedResult->cServico->PrazoEntrega)
		);
	(float)$_SESSION['preco_frete'] = $retorno['preco'];
	die(json_encode($retorno));

	/*
	http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?
	nCdEmpresa=&              Apenas para clientes com contrato
	sDsSenha=&                Apenas para clientes com contrato
	sCepOrigem=&              Cep de origem do produto
	sCepDestino=&	          Cep de destino do produto
	nVlPeso=&                 Peso total do produto, incluindo a embalagem em kg
	nCdFormato=&              Formato da encomenda (Pacote/Rolo/Envelope)
	nVlComprimento=&          Comprimento da encomenda com a embalagem em cm
	nVlAltura=&               Altura da encomenda com a embalagem em cm, envelope = 0
	nVlLargura=&              Largura da encomenda com a embalagem em cm
	sCdMaoPropria=n&          Entrega em mão própria (S,N)
	nVlValorDeclarado=&       Declarar um valor ao produto (Valor declarado em R$)
	sCdAvisoRecebimento=&     Adicionar aviso de recebimento (S,N)
	nCdServico=&			  Serviço de envio (SEDEX, PAC, SEDEX12, 10, HOJE A VISTA)
	nVlDiametro=&             Diâmetro da encomenda com a embalagem em cm
	StrRetorno=xml&              
	nIndicaCalculo=3
	*/

?>