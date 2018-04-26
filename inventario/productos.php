
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

#conteo de registro en la tabla de productos
	$sql_conteo="SELECT count(id_producto)as conteo_id_producto FROM productos,usuarios WHERE productos.identificacion_usuario in(?) and usuarios.identificacion=productos.identificacion_usuario";
	$statement_conteo = $pdo->prepare($sql_conteo);
	$statement_conteo->execute(array($_SESSION['ident']));
	$resultado_conteo = $statement_conteo->fetchAll();

#consulta para mostrar en la tabla de productos

	$sql="SELECT * FROM productos,usuarios WHERE productos.identificacion_usuario in(?) and usuarios.identificacion=productos.identificacion_usuario order by productos.id_producto desc";
	$statement = $pdo->prepare($sql);
	$statement->execute(array($_SESSION['ident']));
	$resultado = $statement->fetchAll();
	
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Productos</title>
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
	<br>
	
	<aside>
		<div class="container">
			<div class="row">
				<div class="col-xs-3">
					<?php include('inc/nav_usuario_lateral_isquierdo/nav.php'); ?>
				</div>
				<div class="col-xs-9">

				<div class="">
				<legend id="click_ver_inventario" class="legenda">Registrar Producto</legend>
				<?php if (@$_GET['reg']) {
					echo "<p style='color:white; background-color:green;'>Producto Registrado.</p>";
				} ?>
			<form action="registro_producto.php" method="post" entype="multipart/form-data" class="">
			<table border="1" width="100%">
				<tr>
				<label for="id">codigo
					<td><input type="text" name="cod_producto" placeholder="Codigo Producto" class="form-control" required=""></td>
				</label>
					<td><input type="text" name="name" placeholder="nombre Producto" class="form-control" required=""></td>
					<td><input type="text" name="descripcion" placeholder="Descripcion" class="form-control" required=""></td>
                    <td><input type="text" name="precio" placeholder="Precio" class="form-control" required=""></td>
					
					<td><input type="reset" name="" value="Reiniciar" class="btn btn-warning"></td>
					<td><input type="submit" name="" value="Registrar" class="btn btn-success"></td>
				</tr>
					
			</table>
			</form>
				</div>
				
				<br>
			<legend id="click_ver_inventario" class="legenda">Total de Productos.</legend>
		
			<div>
				<?php if (@$_GET['eliminado']) {
					echo "<p style='color:red;'>Producto Eliminado</p>";
					$cod_eliminado = "<strong style='color:red;'>eliminado</strong>";
					echo "Codigo del producto ".$cod_eliminado." ha sido eliminado el Producto.";
				} ?>
			</div>	
		<?php 
				foreach ($resultado_conteo as $res_conteo) {
				?>
				<p>Total de Productos. <strong><?php echo $res_conteo['conteo_id_producto']; ?></strong></p>
				<?php  
				}
				?>
			<div class="ver_invent">
			<table border="1" width="100%" style="text-align: center; background-color: rgba(100,30,200,.3);">
				<tr style="background-color: gray; color: white; text-transform: uppercase; font-size: 12px">
					<td>codigo Producto</td>
					<td>nombre</td>
					<td>Descripcion</td>
                    <td>Precio</td>
					<td>Fecha</td>
					
					<td>Accion</td>
				</tr>
			
				
				<?php foreach (@$resultado as $res) {	
				?>
				
					<tr>
						<td id="cod"><?php echo $res['cod_producto']; ?></td>
						<td><?php echo $res['nombre_producto']; ?></td>
						<td><?php echo $res['descripcion_producto']; ?></td>
                        <td><?php echo $res['precio_producto']; ?></td>
						<td><?php echo $res['fecha_producto']; ?></td>
						
						<td><a id="btn_delete" class="btn btn-danger" href="elimina_producto.php?id_producto=<?php echo $res['id_producto']; ?>" >Eliminar</a></td>
						
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


