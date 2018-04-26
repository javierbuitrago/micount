
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
	$sql_conteo="SELECT count(id_entrada)as conteo_id_entrada FROM entradas,usuarios WHERE entradas.identificacion_usuario in(?) and tipo_entrada='ventas' AND usuarios.identificacion=entradas.identificacion_usuario";
	$statement_conteo = $pdo->prepare($sql_conteo);
	$statement_conteo->execute(array($_SESSION['ident']));
	$resultado_conteo = $statement_conteo->fetchAll();

#consulta para mostrar en la tabla de gastos

	$sql="SELECT * FROM entradas,usuarios WHERE entradas.identificacion_usuario in(?) and tipo_entrada='ventas' AND usuarios.identificacion=entradas.identificacion_usuario order by entradas.id_entrada desc";
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

#consulta para sacar el minimo de las ventas.
	$sql_max = "SELECT MIN(cantidad_entrada)as minimo_facturas FROM entradas,usuarios WHERE entradas.identificacion_usuario in(?) AND tipo_entrada='ventas' AND entradas.identificacion_usuario=usuarios.identificacion ";
	$statement_max = $pdo->prepare($sql_max);
	$statement_max->execute(array($_SESSION['ident']));
	$resultado_min = $statement_max->fetchAll();

#consulta para sacar el maximo de las VENTAS.
	$sql_max = "SELECT MAX(cantidad_entrada)as maximo_facturas FROM entradas,usuarios WHERE entradas.identificacion_usuario in(?) AND tipo_entrada='ventas' AND entradas.identificacion_usuario=usuarios.identificacion ";
	$statement_max = $pdo->prepare($sql_max);
	$statement_max->execute(array($_SESSION['ident']));
	$resultado_max = $statement_max->fetchAll();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ventas</title>
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
				<legend id="click_ver_inventario" class="legenda">Registrar Venta</legend>
			
			<?php  
			if (@$_GET['reg']) {
				echo "<p style='color:white; background-color:green'>Venta Registrada</p>";
			}
			?>
		
			<div class="ver_invent">
			<table border="1" width="100%" style="text-align: center; background-color: rgba(100,30,200,.3);">				
					<tr>
					<form action="registro_venta.php" method="post" enctype="multipart/form-data">
					<label for="nombre_entrada">
							<td style="background-color: gray; color: white; text-transform: uppercase; font-size: 12px; border-bottom: 1px; border-bottom-color: darkblue; border-bottom-style: solid;" >nombre Venta</td>
							<td><input type="text" name="nombre_entrada" class="form-control" required=""></td>
						</label>
					</tr>
					<tr>
					<label for="imagen">
							<td style="background-color: gray; color: white; text-transform: uppercase; font-size: 12px; border-bottom: 1px; border-bottom-color: darkblue; border-bottom-style: solid;" >comprobante o imagen</td>
							<td><input type="file" name="imagen" class="" required=""></td>
						</label>
					</tr>
					<tr>
					<label for="cantidad_entrada">
							<td style="background-color: gray; color: white; text-transform: uppercase; font-size: 12px; border-bottom: 1px; border-bottom-color: darkblue; border-bottom-style: solid;" >cantidad entrante</td>
							<td><input type="text" name="cantidad_entrante" class="form-control" required=""></td>
						</label>
					</tr>
					<tr>

						<td style="background-color: gray; color: white; text-transform: uppercase; font-size: 12px; border-bottom: 1px; border-bottom-color: darkblue; border-bottom-style: solid;">Accion</td>
						<td><input type="submit" value="Registrar Venta" class="btn btn-success"></td>
					</tr>
					</form>
						
					
				
			</table>
			<br>
		</div>

		<?php 
			#el valor Maximo de los facturas
				foreach ($resultado_max as $rs_max) {
			?>
				<h4 style="color: violet;">la Venta con mayor Valor es de: <?php echo $rs_max['maximo_facturas']; ?></h4>
			<?php  
			}
			?>		
			
			<?php 
			#el valor minimo de las fcturas
				foreach ($resultado_min as $rs_min) {
			?>
				<h4 style="color: orange;">la Venta con menor Valor es de: <?php echo $rs_min['minimo_facturas']; ?></h4>
			<?php  
			}
			?>		
			<legend id="click_ver_inventario" class="legenda">Ver Ventas Registradas</legend>
			
			
				
		
			<?php if (@$_GET['eliminado']) {
					echo "<p style='color:white;background-color:crimson;'>Factura Eliminada</p>";
					$cod_eliminado = "<strong style='color:red;'>".$_SESSION['id_entrada']."</strong>";
					echo "codigo de la Venta ".$cod_eliminado." ha sido eliminado.";
				} ?>
		
			<div class="ver_invent">
			<table border="1" width="100%" style="text-align: center; background-color: rgba(100,30,200,.3);">
				<tr style="background-color: gray; color: white; text-transform: uppercase; font-size: 12px">
					<td>id entrada</td>
					<td>nombre de Venta</td>
					<td>Tipo</td>
					<td>comprobante</td>
					<td>cantidad Entrante</td>
					<td>fecha</td>
					<td>hora</td>
					<td>Accion</td>
				</tr>
			
				<?php 
				foreach ($resultado_conteo as $res_conteo) {
				?>
				<p>registros de Ventas. <strong><?php echo $res_conteo['conteo_id_entrada']; ?></strong></p>
				<?php  
				}
				?>
				<?php foreach (@$resultado as $res) {	
				?>
				
					<tr>
						<td id="cod"><?php echo $res['id_entrada']; ?></td>
						<td><?php echo $res['nombre_entrada']; ?></td>
						<td><?php echo $res['tipo_entrada']; ?></td>
						<td><img src="img/imagen_facturas/<?php echo $res['imagen']; ?>" alt="" width="100px"></td>
						<td><?php echo $res['cantidad_entrada']; ?></td>
						<td><?php echo $res['fecha_entrada']; ?></td>
						<td><?php echo $res['hora_entrada']; ?></td>
						<td><a id="btn_delete" class="btn btn-danger" href="elimina_venta.php?id_entrada=<?php echo $res['id_entrada']; ?>" >Eliminar</a></td>
						
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


