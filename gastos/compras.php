
<?php 
session_start();
require_once('conexion/conexion.php');

if ($_SESSION['ident']) {
	echo "conect";
}
else
{
	header('location: index.php');
}

#para consultar la base de datos tabla gastos
if ($_SESSION) {

#conteo de registro en la tabla de gastos
	$sql_conteo="SELECT count(id_gasto)as conteo_id_gasto FROM gastos,usuarios WHERE usuarios.usuario in(?) and usuarios.identificacion=gastos.identificacion_usuario";
	$statement_conteo = $pdo->prepare($sql_conteo);
	$statement_conteo->execute(array($_SESSION['usuario']));
	$resultado_conteo = $statement_conteo->fetchAll();

#consulta para mostrar en la tabla de gastos

	$sql="SELECT * FROM gastos,usuarios WHERE gastos.identificacion_usuario in(?) and usuarios.identificacion=gastos.identificacion_usuario order by gastos.id_gasto desc";
	$statement = $pdo->prepare($sql);
	$statement->execute(array($_SESSION['ident']));
	$resultado = $statement->fetchAll();
	
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ver Compras</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/estilos_nav_lateral_isquierdo.css">
	<link rel="stylesheet" href="css/stilos_botones.css">
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/agrega_formulario.js"></script>
</head>
<body>
	<header>
		<?php include('inc/navegacion.php'); ?>
	</header>
	
	<aside>
		<div class="container">
			<div class="row">
				<div class="col-xs-3">
					<?php include('inc/nav_usuario_lateral_isquierdo/nav.php'); ?>
				</div>
				<div class="col-xs-9">
				<legend id="click_ver_inventario" class="legenda">Ver Compras Realizadas</legend>
		
			<?php if (@$_GET['eliminado']) {
					echo "<p style='color:white;background-color:crimson;'>Gasto Eliminado</p>";
					$cod_eliminado = "<strong style='color:red;'>".$_SESSION['id_gasto_compra']."</strong>";
					echo "codigo del gasto ".$cod_eliminado." ha sido eliminado.";
				} ?>
		
			<div class="ver_invent">
			<table border="1" width="100%" style="text-align: center; background-color: rgba(100,30,200,.3);">
				<tr style="background-color: gray; color: white; text-transform: uppercase; font-size: 12px">
					<td>codigo Gasto</td>
					<td>nombre Gasto</td>
					<td>Descripcion</td>
					<td>cantidad Gastada</td>
					<td>hora</td>
					<td>fecha</td>
					<td>Accion</td>
				</tr>
			
				<?php 
				foreach ($resultado_conteo as $res_conteo) {
				?>
				<p>registros de mis Compras. <strong><?php echo $res_conteo['conteo_id_gasto']; ?></strong></p>
				<?php  
				}
				?>
				<?php foreach (@$resultado as $res) {	
				?>
				
					<tr>
						<td id="cod"><?php echo $res['id_gasto']; ?></td>
						<td><?php echo $res['nombre_gasto']; ?></td>
						<td><?php echo $res['descripcion_gasto']; ?></td>
						<td><?php echo $res['cantidad_gasto']; ?></td>
						<td><?php echo $res['hora_gasto']; ?></td>
						<td><?php echo $res['fecha_gasto']; ?></td>
						<td><a id="btn_delete" class="btn btn-danger" href="elimina_gasto_compra.php?id_gasto=<?php echo $res['id_gasto']; ?>" >Eliminar</a></td>
						
					</tr>
				<?php	
				} ?>
			</table>
		</div>	
			
			</div>
		</div>
	</aside>
	
	
		
		
	


	<footer></footer>
	
</body>
</html>


