
<?php 
session_start();
require_once('../conexion/conexion.php');

if ($_SESSION['ident']) {
	echo "";
}
else
{
	header('location: index.php');
}

#para consultar la base de datos tabla entradas
if ($_SESSION) {

#conteo de registro en la tabla de entradas
	$sql_conteo="SELECT count(id_entrada)as conteo_id_entradas FROM entradas,usuarios WHERE usuarios.usuario in(?) and usuarios.identificacion=entradas.identificacion_usuario";
	$statement_conteo = $pdo->prepare($sql_conteo);
	$statement_conteo->execute(array($_SESSION['usuario']));
	$resultado_conteo = $statement_conteo->fetchAll();

#consulta para mostrar en la tabla de gastos

	$sql="SELECT * FROM entradas,usuarios WHERE entradas.identificacion_usuario in(?) and usuarios.identificacion=entradas.identificacion_usuario order by entradas.id_entrada desc";
	$statement = $pdo->prepare($sql);
	$statement->execute(array($_SESSION['ident']));
	$resultado = $statement->fetchAll();
	

#consulta para sumar los gastos generales.
	$sql_sum = "SELECT SUM(cantidad_gasto)as sumatoria_gastos FROM gastos,usuarios WHERE gastos.identificacion_usuario in(?) AND gastos.identificacion_usuario=usuarios.identificacion ";
	$statement_sum = $pdo->prepare($sql_sum);
	$statement_sum->execute(array($_SESSION['ident']));
	$resultado_sum = $statement_sum->fetchAll();

#consulta para sacar el promedio las facturas.
	$sql_prom_fac = "SELECT AVG(cantidad_entrada)as promedio_entrada_fac FROM entradas,usuarios WHERE entradas.identificacion_usuario in(?) AND tipo_entrada='factura' AND entradas.identificacion_usuario=usuarios.identificacion ";
	$statement_prom_fac = $pdo->prepare($sql_prom_fac);
	$statement_prom_fac->execute(array($_SESSION['ident']));
	$resultado_prom_fac = $statement_prom_fac->fetchAll();

#consulta para sacar el promedio las Ventas.
	$sql_prom_ven = "SELECT AVG(cantidad_entrada)as promedio_entrada_ven FROM entradas,usuarios WHERE entradas.identificacion_usuario in(?) AND tipo_entrada='ventas' AND entradas.identificacion_usuario=usuarios.identificacion ";
	$statement_prom_ven = $pdo->prepare($sql_prom_ven);
	$statement_prom_ven->execute(array($_SESSION['ident']));
	$resultado_prom_ven = $statement_prom_ven->fetchAll();

#consulta para sacar el minimo de las facturas
	$sql_max = "SELECT MIN(cantidad_entrada)as minimo_facturas FROM entradas,usuarios WHERE entradas.identificacion_usuario in(?) AND tipo_entrada='factura' AND entradas.identificacion_usuario=usuarios.identificacion ";
	$statement_max = $pdo->prepare($sql_max);
	$statement_max->execute(array($_SESSION['ident']));
	$resultado_min_fac = $statement_max->fetchAll();

#consulta para sacar el maximo de las facturas.
	$sql_max = "SELECT MAX(cantidad_entrada)as maximo_facturas FROM entradas,usuarios WHERE entradas.identificacion_usuario in(?) AND tipo_entrada='factura' AND entradas.identificacion_usuario=usuarios.identificacion ";
	$statement_max = $pdo->prepare($sql_max);
	$statement_max->execute(array($_SESSION['ident']));
	$resultado_max_fac = $statement_max->fetchAll();

#consulta para sacar el minimo de las ventas.
	$sql_max = "SELECT MIN(cantidad_entrada)as minimo_ventas FROM entradas,usuarios WHERE entradas.identificacion_usuario in(?) AND tipo_entrada='ventas' AND entradas.identificacion_usuario=usuarios.identificacion ";
	$statement_max = $pdo->prepare($sql_max);
	$statement_max->execute(array($_SESSION['ident']));
	$resultado_min = $statement_max->fetchAll();

#consulta para sacar el maximo de las VENTAS.
	$sql_max = "SELECT MAX(cantidad_entrada)as maximo_ventas FROM entradas,usuarios WHERE entradas.identificacion_usuario in(?) AND tipo_entrada='ventas' AND entradas.identificacion_usuario=usuarios.identificacion ";
	$statement_max = $pdo->prepare($sql_max);
	$statement_max->execute(array($_SESSION['ident']));
	$resultado_max = $statement_max->fetchAll();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Entradas</title>
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
		<legend id="click_ver_inventario" class="legenda">Datos Generales de las Entradas</legend>
	<table border="" width="100%" style="font-family: arial; text-align: center; background-color: rgba(100,30,200,.3);">
	<tr>
		<td></td>
		<th style="background-color: gray; color: white; text-align: center;">Facturas</th>
		<th style="background-color: gray; color: white; text-align: center;">Ventas</th>
	</tr>
	<tr>
		<th style="background-color: gray; color: white; text-align: center;">maximo Valor</th>
			<td class="">
				<?php 
					#el valor Maximo de los facturas
						foreach ($resultado_max_fac as $rs_max_fac) {
					?>
						<h4 style="color: white;">la Factura con mayor Valor es de: <?php echo $rs_max_fac['maximo_facturas']; ?></h4>
					<?php  
					}
					?>	
			</td>
			<td class="">
				<?php 
					#el valor Maximo de los Ventas
						foreach ($resultado_max as $rs_max) {
					?>
						<h4 style="color: white;">la Venta con mayor Valor es de: <?php echo $rs_max['maximo_ventas']; ?></h4>
					<?php  
					}
					?>
			</td>
	</tr>
	<tr>
		<th style="background-color: gray; color: white; text-align: center;">minimo Valor</th>
			<td class="">
				<?php 
					#el valor Maximo de los facturas
						foreach ($resultado_min_fac as $rs_min_fac) {
					?>
						<h4 style="color: white;">la Factura con menor Valor es de: <?php echo $rs_min_fac['minimo_facturas']; ?></h4>
					<?php  
					}
					?>	
			</td>
			<td class="">
				<?php 
					#el valor Maximo de los Ventas
						foreach ($resultado_min as $rs_min) {
					?>
						<h4 style="color: white;">la Venta con menor Valor es de: <?php echo $rs_min['minimo_ventas']; ?></h4>
					<?php  
					}
					?>
			</td>
	</tr>
	<tr>
		<th style="background-color: gray; color: white; text-align: center;">Promedio</th>
			<td class="">
				<?php 
					#el valor Maximo de los facturas
						foreach ($resultado_prom_fac as $rs_prom_fac) {
					?>
						<h4 style="color: white;">El Promedio del valor de facturas es de: <?php echo $rs_prom_fac['promedio_entrada_fac']; ?></h4>
					<?php  
					}
					?>	
			</td>
			<td class="">
				<?php 
					#el valor Maximo de los Ventas
						foreach ($resultado_prom_ven as $rs_prom_ven) {
					?>
						<h4 style="color: white;">El Promedio del valor de Ventas es de: <?php echo $rs_prom_ven['promedio_entrada_ven']; ?></h4>
					<?php  
					}
					?>
			</td>
	</tr>
		

				
		</table>	
			<legend id="click_ver_inventario" class="legenda">Ver Entradas Registradas</legend>
			
			
				
		
			<?php if (@$_GET['eliminado']) {
					echo "<p style='color:white;background-color:crimson;'>Factura Eliminada</p>";
					$cod_eliminado = "<strong style='color:red;'>".$_SESSION['id_entrada']."</strong>";
					echo "codigo de la factura ".$cod_eliminado." ha sido eliminado.";
				} ?>
		
			<div class="ver_invent">
			<table border="1" width="100%" style="text-align: center; background-color: rgba(100,30,200,.3);">
				<tr style="background-color: gray; color: white; text-transform: uppercase; font-size: 12px">
					<td>id entrada</td>
					<td>nombre entrada</td>
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
				<p>registros de Facturas. <strong><?php echo $res_conteo['conteo_id_entradas']; ?></strong></p>
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
						<td><a id="btn_delete" class="btn btn-danger" href="elimina_factura.php?id_entrada=<?php echo $res['id_entrada']; ?>" >Eliminar</a></td>
						
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


