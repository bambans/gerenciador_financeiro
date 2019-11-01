<?php 
	session_start();
	include('connect.php');
	$mysqli->close();
	session_destroy();
	header('location: index.php');
?>