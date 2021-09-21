<?php
// Conexão
require_once 'db_connect.php';

// Sessão
session_start();

// Botão enviar
if (isset($_POST['btn-entrar'])) {
	$erros = array();
	$login = mysqli_escape_string($connect, $_POST['login']);
	$senha = mysqli_escape_string($connect, $_POST['senha']);

	if (empty($login) or empty($senha)) {
		$erros[] = "<li> O campo login/senha precisa ser preenchido </li>";
	} else {
		$sql = "SELECT login FROM usuarios WHERE login = '$login'";
		$resultado = mysqli_query($connect, $sql);

		if (mysqli_num_rows($resultado) > 0) {
			$senha = md5($senha);
			$sql = "SELECT * FROM usuarios WHERE login = '$login' AND senha = '$senha'";
			$resultado = mysqli_query($connect, $sql);

			if (mysqli_num_rows($resultado) == 1) {
				$dados = mysqli_fetch_assoc($resultado);
				mysqli_close($connect);
				$_SESSION['logado'] = true;
				$_SESSION['id_usuario'] = $dados['id'];
				header('location: home.php');
			} else {
				$erros[] = "<li> Usuario e senha não conferem </li>";
			}
		} else {
			$erros[] = "<li> Usuario inexistente </li>";
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../style.css">
	<title> LOGIN </title>
</head>

<body>
	<div class="container-fluid">
		<div class="row  justify-content-center">
			<div class="col-md-12 text-center p-5 text-info">
				<h1>
					<p>NOME-EMPRESA</p>
				</h1>

			</div>
			<div class="col-md-3">
				<form action="" method="POST">
					<div class="mb-3 ">
						<label for="login" class="form-label">LOGIN:</label>
						<input type="text" name="login" class="form-control" id="login">
					</div>
					<div class="mb-3 ">
						<label for="exampleInputPassword1" class="form-label">SENHA:</label>
						<input type="password" name="senha" class="form-control" id="senha">
					</div>
					<div class="col-md-12 text-center">
						<button type="submit" name="btn-entrar" class="btn btn-primary">ENVIAR</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js"></script>
</body>

</html>


<!---------
	<form action="" method="POST">
		Login: <input type="text" name="login"><br>
		Senha: <input type="password" name="senha"><br>
		<button type="submit" name="btn-entrar"> Entrar </button>
	</form>
	------->