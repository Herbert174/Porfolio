<?php 
 
	class database
		{
		//host
		private $host = 'Localhost';

		//usuario
		private $usuario = 'root';

		//senha
		private $senha = '';

		//banco de dados
		private $database = 'crud';

		public function conecta_mysql()
			{
			//criar conexão
			$con = mysqli_connect($this -> host, $this -> usuario, $this -> senha, $this -> database);

			//ajustar o charset de comunicação entre a aplicação e o banco de dados
			mysqli_set_charset($con, 'utf8');

			//verificar se houve erro de conexão
			if(mysqli_connect_errno())
				{
				echo 'Erro ao tentar se conectar com o banco de dados MySQL: '.mysqli_connect_error();
				}
			return $con;
			}

		public function desconecta_mysql($con)
			{
			mysqli_close($con);
			}
		}

?>