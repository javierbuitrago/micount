<?php 
session_start();
require_once 'conexion/conexion.php';
if ($_SESSION['ident']) {
	echo "
        <script>  
            console.log('sesion activa');
        </script>
    ";
}
else
{
	header('location: index.php');
}

#consulta sql para comprobar que la cotizacion sea simple o compuesta 
$sql_comprueba_configuracion = "SELECT * FROM configuraciones,usuarios WHERE usuarios.identificacion=configuraciones.identificacion_usuario AND configuraciones.identificacion_usuario in(?)";
$statement_comprueba_configuracion = $pdo->prepare($sql_comprueba_configuracion);
$statement_comprueba_configuracion->execute(array($_SESSION['ident']));
$resultado_comprobacion = $statement_comprueba_configuracion->fetchAll();

foreach ($resultado_comprobacion as $rs_comprobacion) {
	$dato_comprobado = $rs_comprobacion['conf_cotizacion'];
	echo $dato_comprobado;
}

#consulta para traer los clientes.
$sql_select = "SELECT * FROM usuarios,clientes WHERE clientes.identificacion_usuario in(?) AND usuarios.identificacion=clientes.identificacion_usuario";
	$statement_select = $pdo->prepare($sql_select);
	$statement_select->execute(array($_SESSION['ident']));
	$resultado_select = $statement_select->fetchAll();


#consulta para traer los productos del usuario.
$sql_productos = "SELECT * FROM usuarios,productos WHERE productos.identificacion_usuario in(?) AND usuarios.identificacion=productos.identificacion_usuario";
	$statement_productos = $pdo->prepare($sql_productos);
	$statement_productos->execute(array($_SESSION['ident']));
	$resultado_productos = $statement_productos->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Nueva Cotizacion</title>
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
				<div class="col-xs-8">
				<?php 
				if (@$dato_comprobado == 'simple') {
					include_once 'inc/cotizacion/cotizacion_simple.php';
				}
				else if (@$dato_comprobado == 'compuesta') {
					include_once 'inc/cotizacion/cotizacion_compuesta.php';
				}
				else
				{
					echo "No has configurado Tu Cotizacion..<p><a href='conf_coti.php'>Configurar</a></p>";
				}
				?>
					
				</div>
				<div class="col-xs-0"></div>
			</div>
		</div>
	</aside>
	


	<footer></footer>

</body>
</html>