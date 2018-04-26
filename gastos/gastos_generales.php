
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
	

#consulta para sumar los gastos generales.
	$sql_sum = "SELECT SUM(cantidad_gasto)as sumatoria_gastos FROM gastos,usuarios WHERE gastos.identificacion_usuario in(?) AND gastos.identificacion_usuario=usuarios.identificacion ";
	$statement_sum = $pdo->prepare($sql_sum);
	$statement_sum->execute(array($_SESSION['ident']));
	$resultado_sum = $statement_sum->fetchAll();

#consulta para sacar el promedio los gastos generales.
	$sql_prom = "SELECT AVG(cantidad_gasto)as promedio_gastos FROM gastos,usuarios WHERE gastos.identificacion_usuario in(?) AND gastos.identificacion_usuario=usuarios.identificacion ";
	$statement_prom = $pdo->prepare($sql_prom);
	$statement_prom->execute(array($_SESSION['ident']));
	$resultado_prom = $statement_prom->fetchAll();

#consulta para sacar el minimo de los gastos generales.
	$sql_min = "SELECT MIN(cantidad_gasto)as minimo_gastos FROM gastos,usuarios WHERE gastos.identificacion_usuario in(?) AND gastos.identificacion_usuario=usuarios.identificacion ";
	$statement_min = $pdo->prepare($sql_min);
	$statement_min->execute(array($_SESSION['ident']));
	$resultado_min = $statement_min->fetchAll();

#consulta para sacar el maximo de los gastos generales.
	$sql_max = "SELECT MAX(cantidad_gasto)as maximo_gastos FROM gastos,usuarios WHERE gastos.identificacion_usuario in(?) AND gastos.identificacion_usuario=usuarios.identificacion ";
	$statement_max = $pdo->prepare($sql_max);
	$statement_max->execute(array($_SESSION['ident']));
	$resultado_max = $statement_max->fetchAll();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ver Gastos Generales</title>
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
				<legend id="click_ver_inventario" class="legenda">Registrar Gastos</legend>
			
			<?php  
			if (@$_GET['reg']) {
				echo "<p style='color:white; background-color:green'>Gasto Registrado</p>";
			}
			?>
		
			<div class="ver_invent">
			<table border="1" width="100%" style="text-align: center;">
				<tr style="background-color: gray; color: white; text-transform: uppercase; font-size: 12px">
					
					<td>nombre</td>
					<td>Descripcion</td>
					<td>cantidad Gastada</td>
					
					<td>Accion</td>
				</tr>
			
				
				
					<tr>
					<form action="registro_gasto_general.php" method="post">
						
						<td><input type="text" name="nombre_gasto" class="form-control" required=""></td>
						<td><input type="text" name="descripcion_gasto" class="form-control" required=""></td>
						<td><input type="text" name="cantidad_gasto" class="form-control" required=""></td>
						
						<td><input type="submit" value="Registrar Gasto" class="btn btn-success"></td>
					</form>
						
					</tr>
				
			</table>
		</div>
				
			<legend id="click_ver_inventario" class="legenda">Ver Gastos Generales</legend>
			
			<?php
			#sumatoria de la cantidad de gastos 
				foreach ($resultado_sum as $rs_sum) {
			?>
				<h4 style="color: blue;">el valor de los gastos generales es: <?php echo $rs_sum['sumatoria_gastos']; ?></h4>
			<?php  
			}
			?>
			
			<?php 
			#el valor Minimo de los gastos generales 
				foreach ($resultado_min as $rs_min) {
			?>
				<h4 style="color: orange;">el valor Minimo de los gastos generales es: <?php echo $rs_min['minimo_gastos']; ?></h4>
			<?php  
			}
			?>

			<?php 
			#el valor Maximo de los gastos generales
				foreach ($resultado_max as $rs_max) {
			?>
				<h4 style="color: violet;">el valor Maximo de los gastos generales es: <?php echo $rs_max['maximo_gastos']; ?></h4>
			<?php  
			}
			?>	

			<?php 
			#el valor promedio de los gastos generales
				foreach ($resultado_prom as $rs_prom) {
			?>
				<h4 style="color: green;">el Promedio de los gastos generales es: <?php echo $rs_prom['promedio_gastos']; ?></h4>
			<?php  
			}
			?>
				
		
			<?php if (@$_GET['eliminado']) {
					echo "<p style='color:white;background-color:crimson;'>Gasto Eliminado</p>";
					$cod_eliminado = "<strong style='color:red;'>".$_SESSION['id_gasto']."</strong>";
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
				<p>registros de Gastos. <strong><?php echo $res_conteo['conteo_id_gasto']; ?></strong></p>
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
						<td><a id="btn_delete" class="btn btn-danger" href="elimina_gasto.php?id_gasto=<?php echo $res['id_gasto']; ?>" >Eliminar</a></td>
						
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


