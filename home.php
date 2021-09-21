<?php 
// Conexão
require_once 'db_connect.php';

// Sessão
session_start();

//verificação
 if (!isset($_SESSION['logado'])) {
	header('location: index.php');
}			
// Dados
$id = $_SESSION['id_usuario'];
$sql = "SELECT * FROM usuarios WHERE id = '$id'";
$resultado = mysqli_query($connect, $sql);
$dados = mysqli_fetch_array($resultado);
mysqli_close($connect);
?>
<html>
<head>
	<meta charset="UTF-8">
	<title>pagina restrita</title>
</head>
<body>
	<h1> olá <?php echo $dados['nome']; ?></h1>
	<a href="logout.php">SAIR</a>
</body>
</html>