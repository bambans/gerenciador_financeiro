<?php
	$servidor = 'localhost';
	$usuario = 'id11205855_root';
	$senha = 'bro21072002';
	$banco = 'id11205855_db_financas';
	$mysqli = new mysqli($servidor, $usuario, $senha, $banco);
	$mysqli->set_charset('utf8');
	if(mysqli_connect_errno()) trigger_error(mysqli_connect_error());
?>