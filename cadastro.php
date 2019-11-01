<?php
	session_start();
	include('connect.php');
	if(isset($_POST['name'])){
		$sql = "INSERT INTO TB_USUARIO VALUES (NULL, '".$_POST["name"]."', '".$_POST["email"]."', '".$_POST["senha"]."')";
		if($query = $mysqli->query($sql)){
			echo "<script>alert('Cadastro efetuado com sucesso!');</script>";
		}
		else{
			printf("Error: %s\n", $mysqli->error);//Retorna e exibi de forma humana o debug do erro ocorrido 
		}
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Cadastro</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="style.css">
		<script>
		    if(window.history.replaceState){
		        window.history.replaceState(null, null, window.location.href);
		    }
		</script>
	</head>
	<body>
		<div class="container">
			<form method="post" class="form-group form">
				<div class="row">
					<div class="col-md-2">
						<img src="favicon.png">
					</div>
					<div class="col-md-8">
						<br>
						<center>
							<h1 id="login-title" style="color: #ccac00">&nbsp;&nbsp;Tavious</h1>
							<br>
							<caption><h2>Cadastro</h2></caption>
						</center>
					</div>
					<div class="col-md-2"></div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-6">
						<label for="user">Nome:<input id="user" class="form-control" type="text" name="name" placeholder="Teste" required></label>
					</div>
					<div class="col-md-6">
						<label for="login">Email:<input id="login" class="form-control" type="email" name="email" placeholder="teste@teste.com" required></label>
					</div>	
				</div>
				<div class="row">
					<div class="col-md-6">
						<label for="senha">Senha:<input id="senha" class="form-control" type="password" name="senha" required></label>
					</div>
					<div class="col-md-6">
						<br>
						<center>
    						<input class="btn btn-outline-dark" type="submit" value="Cadastrar">
    							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    						<a class="btn btn-outline-info" href="index.php">Faça login!</a>
						</center>
					</div>
				</div>	
			</form>
		</div>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<br>
		<footer><center><span>&copy; Otávio Rodrigues Bambans - 2019</span></center></footer>
	</body>
</html>