<?php
	$servidor = 'localhost';
	$usuario = 'root';
	$senha = '';
	$banco = 'db_financas';
	$mysqli = new mysqli($servidor, $usuario, $senha, $banco);
	$mysqli->set_charset('utf8');
	if(mysqli_connect_errno()) trigger_error(mysqli_connect_error());
?>
