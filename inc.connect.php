<?php
	
	define('DB_SERVIDOR' , 'localhost');
	define('DB_USUARIO' , 'root');
	define('DB_SENHA' , '');
	define('DB_BANCO' , 'bd2');

	$servidor = 'localhost';
	$usuario = 'root';
	$senha = '';
	$banco = 'bd2';
	
	$link = mysqli_connect($servidor, $usuario, $senha, $banco) or die ('Não foi possível conectar no servidor');

?>