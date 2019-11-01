<?php
	session_start();
	include('connect.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Painel de controle</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="manifest" href="manifest.json">
		<link rel="stylesheet" type="text/css" href="style.css">
		<script>
		    if(window.history.replaceState){
		        window.history.replaceState(null, null, window.location.href);
		    }
		</script>
	</head>
	<?php
	    if(isset($_SESSION['user'])){
	?>
	<body>
		<div class="container">
			<form method="post" class="form-group form">
				<div class="row">
					<div class="col-md-2">
						<center>
							<img src="favicon.png">
							<h3 style="color: #ccac00">&nbsp;&nbsp;Tavious</h3>
						</center>
					</div>
					<div class="col-md-8">
						<br>
						<br>
						<center><h1 style="white-space: normal">Finanças de <?php echo $_SESSION['nm_user']; ?></h1></center>
					</div>
					<div class="col-md-2">
						<br>
						<br>
						<a class="btn btn-block btn-outline-primary" href='sair.php'>Sair</a>
					</div>
				</div>
				<hr>
				<div class="form-group">
					<label for="exampleFormControlTextarea1">Descrição da transação:
						<textarea name="descricao" class="form-control" id="exampleFormControlTextarea1" rows="5" cols="200" required></textarea>
					</label>
				</div>
				<div class="row">
					<div class="col-md-6">
						<label for="valor">Valor:
							<div class="input-group mb-2">
								<div class="input-group-prepend">
									<div class="input-group-text">
										&nbsp;&nbsp;R$&nbsp;&nbsp;
									</div>
								</div>
								<input id="valor" class="form-control" type="number" step="any" name="valor" placeholder="9999" required>
							</div>
						</label>
					</div>
					<div class="col-md-6">
						<label for="data">Data:
							<div class="input-group mb-2">
								<div class="input-group-prepend">
									<div class="input-group-text">Data</div>
								</div>
								<input id="data" class="form-control" type="date" name="data" required>
							</div>
						</label>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<label for="cat">Categoria de gastos:
							<div class="input-group mb-2">
								<div class="input-group-prepend">
									<div class="input-group-text">Categoria</div>
								</div>
								<select id="cat" class="form-control" name="categoria">
									<?php
										$sql = "SELECT * FROM TB_CATEGORIA";
										if($query = $mysqli->query($sql)){
											while($obj = $query->fetch_object()){
												echo "<option value=".$obj->CD_CATEGORIA.">".$obj->NM_CATEGORIA."</option>";
											}
										}
										else{ 
											printf("Error: %s\n", $mysqli->error);
										}
									?>
								</select>
							</div>
						</label>
					</div>
					<div class="col-md-6">
    					<center>
    					    <br>
    					    Tipo:
    						<br>
    						<div class="form-check form-check-inline">
    						    <input class="form-check-input" type="radio" name="i/o" id="in" value="0">
    						    <label class="form-check-label" for="in">Entrada</label>
    						    </div>
    						<div class="form-check form-check-inline">
    						    <input class="form-check-input" type="radio" name="i/o" id="out" value="1">
    					        <label class="form-check-label" for="out">Saída</label>
    						</div>
						</center>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<label for="for">Forma de pagamento:
							<div class="input-group mb-2">
								<div class="input-group-prepend">
									<div class="input-group-text">Forma</div>
								</div>
								<select id="for" class="form-control" name="forma">
									<?php
										$sql = "SELECT * FROM TB_FORMA";
										if($query = $mysqli->query($sql)){
											while($obj = $query->fetch_object()){
												echo "<option value=".$obj->CD_FORMA.">".$obj->DS_FORMA."</option>";
											}
										}
										else{
											printf("Error: %s\n", $mysqli->error);
										}
									?>
								</select>
							</div>
						</label>
					</div>
					<div class="col-md-3">
						<br>
						<center>
							<input class="btn btn-block btn-outline-success" type="submit" value="Gravar">
						</center>
					</div>
					<div class="col-md-3">
						<br>
						<center>
							<input class="btn btn-block btn-outline-warning" type="reset" name="reset" value="Limpar">
						</center>
					</div>
				</div>
			</form>
			<?php
				if(isset($_POST['valor'])){
					$sql = "INSERT INTO TB_TRANSACAO VALUES (NULL, '".$_POST["descricao"]."', '".$_POST["valor"]."', '".$_POST["data"]."', '".$_POST["i/o"]."', '".$_POST["forma"]."', '".$_POST["categoria"]."', '".$_SESSION['user']."')";
					if($query = $mysqli->query($sql)){
					}
					else{
						printf("Error: %s\n", $mysqli->error);
					}
				}
			?>
			<br>
			<hr>
			<div class="row">
				<div class="col-md-12" style="/*display: none;*/">
					<div class="form" id="hist">
						<center>
							<h2>Histórico de transações</h2>
						</center>
						<?php
							$sql = "SELECT
							TRA.CD_TRANSACAO, TRA.DS_TRANSACAO, TRA.DT_TRANSACAO, TRA.VL_TRANSACAO, TRA.ST_TRANSACAO, FORM.DS_FORMA, CAT.NM_CATEGORIA
							FROM TB_TRANSACAO AS TRA INNER JOIN
							TB_FORMA AS FORM ON(TRA.ID_FORMA = FORM.CD_FORMA) INNER JOIN
							TB_CATEGORIA AS CAT ON(TRA.ID_CATEGORIA = CAT.CD_CATEGORIA)
							WHERE ID_USUARIO = ".$_SESSION['user']."
							ORDER BY CD_TRANSACAO DESC";
							if($query = $mysqli->query($sql)){
								echo'<table class="table table-hover table-sm">
										<thead>
											<tr>
												<th scope="col" style="display: none;">#</th>
												<th scope="col">Descrição</th>
												<th scope="col">Valor</th>
												<th scope="col">Data</th>
												<th scope="col">I/O</th>
												<th scope="col">Forma</th>
												<th scope="col">Categoria</th>
												<th scope="col">Opções</th>
											</tr>
										</thead>
										<tbody>';
								while($obj = $query->fetch_object()){
									echo "<tr>
											<th scope='row' style='display: none;'>$obj->CD_TRANSACAO</th>
											<td>$obj->DS_TRANSACAO</td>
											<td>R$$obj->VL_TRANSACAO</td>
											<td>$obj->DT_TRANSACAO</td>
											<td>";if($obj->ST_TRANSACAO == 0)echo "Entrada";else echo "Saída";echo "</td>
											<td>$obj->DS_FORMA</td>
											<td>$obj->NM_CATEGORIA</td>
											<td>
												<a class='btn btn-sm btn-outline-primary' href='editar.php?codigo=$obj->CD_TRANSACAO'>Editar</a>
												<a class='btn btn-sm btn-outline-danger' href='excluir.php?codigo=$obj->CD_TRANSACAO'>Excluir</a>
											</td>
										</tr>";
								}
								echo "</tbody>";
								echo "</table>";
							}
							else{
								printf("Error: %s\n", $mysqli->error);
							}
						?>
					</div>
				</div>	
			</div>
		</div>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<br>
		<footer><center><span>&copy; Otávio Rodrigues Bambans - 2019</span></center></footer>
	</body>
	<?php
	    }
	    else{
	        echo "<script>window.location.href='index.php';</script>";
	    }
	?>
</html>