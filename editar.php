<?php
	session_start();
	include('connect.php');
	$sql = "SELECT * FROM TB_TRANSACAO WHERE CD_TRANSACAO = '".$_GET['codigo']."'";
	if($query = $mysqli->query($sql)){
		$obj_edit = $query->fetch_object();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Painel de controle</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
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
						<center>
							<img src="favicon.png">
							<h3 style="color: #ccac00">&nbsp;&nbsp;Tavious</h3>
						</center>
					</div>
					<div class="col-md-8">
						<br>
						<br>
						<h1 class="col-md-11">Editar</h1>
					</div>
					<div class="col-md-2">
						<br>
						<br>
						<a class="btn btn-outline-primary" href='financas.php?=#hist'>Voltar</a>
					</div>
				</div>
				<hr>
				<div class="col-auto">
					<div class="form-group">
						<label for="exampleFormControlTextarea1">Descrição da transação:
							<textarea name="descricao" class="form-control" id="exampleFormControlTextarea1" rows="3" cols="45" required><?php echo $obj_edit->DS_TRANSACAO; ?></textarea>
						</label>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="col-auto">
							<label for="valor">Valor:
								<div class="input-group mb-2">
									<div class="input-group-prepend">
										<div class="input-group-text">
											&nbsp;&nbsp;R$&nbsp;&nbsp;
										</div>
									</div>
									<input id="valor" class="form-control" type="number" step="any" name="valor" placeholder="9999" value=<?php echo $obj_edit->VL_TRANSACAO; ?> required>
								</div>
							</label>
						</div>
					</div>
					<div class="col-md-6">
						<div class="col-auto">
							<label for="data">Data:
								<div class="input-group mb-2">
									<div class="input-group-prepend">
										<div class="input-group-text">Data</div>
									</div>
									<input id="data" class="form-control" type="date" name="data" value=<?php echo $obj_edit->DT_TRANSACAO; ?> required>
								</div>
							</label>
						</div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-6">
						<div class="col-auto">
							<label for="cat">Categoria de gastos:
								<div class="input-group mb-2">
									<div class="input-group-prepend">
										<div class="input-group-text">Categoria</div>
									</div>
									<select id="cat" class="form-control" name="categoria">
										<?php
											$sql = "SELECT * FROM TB_CATEGORIA";
											if($query = $mysqli->query($sql)){
												while($obj_categoria = $query->fetch_object()){
													if($obj_edit->ID_CATEGORIA == $obj_categoria->CD_CATEGORIA){
														echo "<option value=".$obj_categoria->CD_CATEGORIA." selected>".$obj_categoria->NM_CATEGORIA."</option>";
													}
													else{
														echo "<option value=".$obj_categoria->CD_CATEGORIA.">".$obj_categoria->NM_CATEGORIA."</option>";
													}
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
					</div>
					<div class="col-md-1"></div>
					<div class="col-md-5">
						<div class="col-auto">
							Tipo:
							<br>
							<div class="row">
								<?php
									if($obj_edit->ST_TRANSACAO == 0){
										echo '<label class="radio-inline" for="in">
												<input id="in" class="form-control-small" type="radio" name="i/o" value="0" checked="checked" required> Entrada
											</label>
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											<label class="radio-inline" for="out">
												<input id="out" class="form-control-small" type="radio" name="i/o" value="1"  required> Saída
											</label>';
									}
									else{
										echo '<label class="radio-inline" for="in">
												<input id="in" class="form-control-small" type="radio" name="i/o" value="0" required> Entrada
											</label>
											&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
											<label class="radio-inline" for="out">
												<input id="out" class="form-control-small" type="radio" name="i/o" value="1" checked="checked" required> Saída
											</label>';
									}
								?>
							</div>
						</div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-md-6">
						<div class="col-auto">
							<label for="for">Forma de pagamento:
								<div class="input-group mb-2">
									<div class="input-group-prepend">
										<div class="input-group-text">Forma</div>
									</div>
									<select id="for" class="form-control" name="forma">
										<?php
											$sql = "SELECT * FROM TB_FORMA";
											if($query = $mysqli->query($sql)){
												while($obj_forma = $query->fetch_object()){
													if($obj_edit->ID_FORMA == $obj_forma->CD_FORMA){
														echo "<option value=".$obj_forma->CD_FORMA." selected>".$obj_forma->DS_FORMA."</option>";
													}
													else{
														echo "<option value=".$obj_forma->CD_FORMA.">".$obj_forma->DS_FORMA."</option>";
													}
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
					</div>
					<div class="col-md-3">
						<br>
						<center>
							<input class="btn btn-block btn-outline-success" type="submit" value="Alterar">
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
					$sql =  "UPDATE TB_TRANSACAO SET DS_TRANSACAO =  '".$_POST["descricao"]."', VL_TRANSACAO = '".$_POST["valor"]."', DT_TRANSACAO = '".$_POST["data"]."', ST_TRANSACAO = '".$_POST["i/o"]."', ID_FORMA = '".$_POST["forma"]."', ID_CATEGORIA = '".$_POST["categoria"]."' WHERE CD_TRANSACAO = '".$_GET['codigo']."'";
					if($query = $mysqli->query($sql)){
						echo "<script>window.location.href='financas.php';</script>";
					}
					else{
						printf("Error: %s\n", $mysqli->error);
					}
				}
			?>
		</div>
		<?php
		}
		else{
			printf("Error: %s\n", $mysqli->error);
		}
		?>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
		<br>
		<footer><center><span>&copy; Otávio Rodrigues Bambans - 2019</span></center></footer>
	</body>
</html>