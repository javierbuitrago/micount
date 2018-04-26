<?php 
session_start();
require_once('conexion/conexion.php');

if ($_SESSION['ident']) {
	echo "";
}
else
{
	header('location: index.php');
}

#para consultar la base de datos tabla gastos
if ($_SESSION) {

#conteo de registro en la tabla de Empleados
	$sql_conteo="SELECT count(id_proveedor)as conteo_id_proveedor FROM proveedores,usuarios WHERE proveedores.identificacion_usuario in(?) and usuarios.identificacion=proveedores.identificacion_usuario";
	$statement_conteo = $pdo->prepare($sql_conteo);
	$statement_conteo->execute(array($_SESSION['ident']));
	$resultado_conteo = $statement_conteo->fetchAll();

#consulta para mostrar en la tabla de gastos

	$sql="SELECT * FROM proveedores,usuarios WHERE proveedores.identificacion_usuario in(?) and usuarios.identificacion=proveedores.identificacion_usuario order by proveedores.id_proveedor desc";
	$statement = $pdo->prepare($sql);
	$statement->execute(array($_SESSION['ident']));
	$resultado = $statement->fetchAll();
	
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Proveedores</title>
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

				<div class="">
				<legend id="click_ver_inventario" class="legenda">Registrar Proveedor</legend>
				<?php if (@$_GET['reg']) {
					echo "<p style='color:white; background-color:green;'>Proveedor Registrado.</p>";
				} ?>
			<form action="registro_proveedor.php" method="post" entype="multipart/form-data" class="">
			<table border="0" width="100%" background-color: rgba(100,30,200,.3);>
				<tr>
				<label for="id">Nit Empresa
					<td><input type="text" name="id" placeholder="identificacion o nit" class="form-control" required=""></td>
				</label>
				</tr>
				<tr>
					<td><input type="text" name="name" placeholder="nombre Proveedor" class="form-control" required=""></td>
				</tr>
				<tr>
					<td><select name="tipo" class="form-control" required="">
						<option value="Empresa">Empresa</option>
						<option value="Multinacional">Multinacional</option>
						<option value="Independiente">Independiente</option>
					</select></td>
				</tr>
				<tr>
					<td><input type="text" name="direccion" placeholder="Direccion" class="form-control" required=""></td>
				</tr>
				<tr>
					<td><input type="text" name="telefono" placeholder="Telefono" class="form-control" required=""></td>
				</tr>
				<tr>
					<td><input type="text" name="producto" placeholder="Producto" class="form-control" required=""></td>
				</tr>
				<tr>
					<td><input type="text" name="valor" placeholder="Valor producto" class="form-control" required=""></td>
				</tr>
				<tr>
					<td><input type="reset" name="" value="Reiniciar" class="btn btn-warning"></td>
				</tr>
				<tr>
					<td><input type="submit" name="" value="Registrar" class="btn btn-success"></td>
				</tr>
					</form>
			</table>
				</div>
				
				<br>
			<legend id="click_ver_inventario" class="legenda">Total de Proveedores.</legend>
		
			<div>
				<?php if (@$_GET['eliminado']) {
					echo "<p style='color:red;'>Proveedor Eliminado</p>";
					$cod_eliminado = "<strong style='color:red;'>".$_SESSION['id_proveedor']."</strong>";
					echo "identificacion del Proveedor ".$cod_eliminado." ha sido eliminado el Proveedor.";
				} ?>
			</div>	
		<?php 
				foreach ($resultado_conteo as $res_conteo) {
				?>
				<p>Total de Proveedores. <strong><?php echo $res_conteo['conteo_id_proveedor']; ?></strong></p>
				<?php  
				}
				?>
			<div class="ver_invent">
			<table border="1" width="100%" style="text-align: center; background-color: rgba(100,30,200,.3);">
				<tr style="background-color: gray; color: white; text-transform: uppercase; font-size: 12px">
					<td>identificacion del Proveedor</td>
					<td>nombre</td>
					<td>Tipo</td>
					<td>Direccion</td>
					<td>Telefono</td>
					<td>Producto</td>
					<td>Valor</td>
					<td>Hora de Registro al sistema</td>
					<td>fecha de Registro al sistema</td>
					<td>Accion</td>
				</tr>
			
				
				<?php foreach (@$resultado as $res) {	
				?>
				
					<tr>
						<td id="cod"><?php echo $res['identificacion_proveedor']; ?></td>
						<td><?php echo $res['nombre_proveedor']; ?></td>
						<td><?php echo $res['tipo_proveedor']; ?></td>
						<td><?php echo $res['direccion']; ?></td>
						<td><?php echo $res['telefono']; ?></td>
						<td><?php echo $res['producto_provee']; ?></td>
						<td><?php echo $res['valor_producto']; ?></td>
						<td><?php echo $res['hora_registro']; ?></td>
						<td><?php echo $res['fecha_registro']; ?></td>
						<td><a id="btn_delete" class="btn btn-danger" href="elimina_proveedor.php?id_proveedor=<?php echo $res['id_proveedor']; ?>" >Eliminar</a></td>
						
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


