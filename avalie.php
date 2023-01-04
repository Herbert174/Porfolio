<?php  

	session_start();

	require_once('db.class.php');

	$usuario = $_SESSION['usuario'];
	$produto = $_SESSION['id_produto'];
	$pagina  = $_SESSION['pagina_produto'];

	if(!empty($_POST['estrela'])&&isset($_SESSION['usuario']))
		{
		$estrela = $_POST['estrela'];

		$sql = " SELECT avaliacoes, num_avaliacoes, total_avaliacoes FROM produtos WHERE id_produto = '$produto' ";

		$objDb = new database();
		$link = $objDb -> conecta_mysql();

		$resultado_produto = mysqli_query($link, $sql);

		if($resultado_produto)
			{
			$dados_produto    = mysqli_fetch_array($resultado_produto);
			$avaliacao        = $dados_produto['avaliacoes'];
			$num_avaliacao    = $dados_produto['num_avaliacoes'];
			$total_avaliacao  = $dados_produto['total_avaliacoes'];
			}
		$num_avaliacoes = $num_avaliacao + 1;
		$total_avaliacoes = $total_avaliacao + $estrela;
		(float)$avaliacoes = $total_avaliacoes / $num_avaliacoes;

		$sql = " UPDATE produtos SET avaliacoes = '$avaliacoes', num_avaliacoes = '$num_avaliacoes', total_avaliacoes = '$total_avaliacoes' WHERE id_produto = '$produto' ";

		if(mysqli_query($link, $sql))
			{
			header('Location: consulta_produto.php?produto='.$produto);
			}else{
				 echo "erro ao registrar avaliação";
				 }

		}else{
			 $_SESSION['erro_avalie'] = 1;
			 header('Location: consulta_produto.php?produto='.$produto);
			 }
	//header("Location: pc_produto1.php");

?>