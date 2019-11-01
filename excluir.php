<?php
	session_start();
	include('connect.php');
	$sql = "DELETE FROM TB_TRANSACAO WHERE CD_TRANSACAO = '".$_GET['codigo']."'";
	if($query = $mysqli->query($sql)){
		header("location: financas.php?=#hist");
	}
	else{
		//echo $mysqli->error; 
	}
?>