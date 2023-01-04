<?php

	session_start();

	require_once('db.class.php');//Habilita funções de conexão com o banco de dados

	$id_usuario = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : 0;
	$id_produto = $_SESSION['id_produto'];

	$objDb = new database();//instancia a classe
	$link = $objDb -> conecta_mysql();//executa função de conexão com o MySQL

	$sql = " SELECT DATE_FORMAT(t.data_inclusao, '%d %b %Y %T') AS data_inclusao_formatada, t.comentario, t.id_comentario, u.nome ";
	$sql.= " FROM comentarios AS t JOIN usuarios AS u ON (t.id_usuario = u.id) ";//Junta as tabelas do banco de dados comentario e usuarios em uma só para poder vincular post de usuario a os comentarios que ele terá acesso
	$sql.= " WHERE id_produto = '$id_produto' ";
	$sql.= " ORDER BY data_inclusao DESC ";

	$resultado_id = mysqli_query($link, $sql);

	if($resultado_id)
		{
		while($registro = mysqli_fetch_array($resultado_id, MYSQLI_ASSOC))
			{
			echo '<a href="#" class="list-group-item">';
				echo '<h4 class="list-group-item-heading">'.$registro['nome'].' <small> - '.$registro['data_inclusao_formatada'].'  </small>';
				echo '<p class="list-group-item-text pull-right">';
				echo '</p> </h4>';
				echo '<p class="list-group-item-text">'.$registro['comentario'].'</p>';	
			echo '</a>';
			}
		}else{
			 echo 'Erro na consulta de comentarios no banco de dados!';
		     }

?>