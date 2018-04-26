<?php 
session_start();
require_once 'conexion/conexion.php';
if ($_SESSION['ident']) {
	echo "conect";
}
else
{
	header('location: index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>CountSystem</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/estilos_nav_lateral_isquierdo.css">
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/agregar_lista_debajo_nav.js"></script>
</head>
<body>
	<header>
		<?php include('inc/navegacion.php'); ?>
	</header>
	<aside>
		<div class="container">
			<div class="row">
				<div class="col-xs-4">
					<?php include('inc/nav_usuario_lateral_isquierdo/nav.php'); ?>
				</div>
				<div class="col-xs-4">
					<legend>Configurar Cotizacion de Salida</legend>
					<form action="" method="post">
						<label for="simple">Simple
							<input type="radio">
						</label>
					</form>
				</div>
				<div class="col-xs-4"></div>
			</div>
		</div>
	</aside>
	


	<footer></footer>

</body>
</html>