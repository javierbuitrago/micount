
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

#conteo de registro en la tabla de Empleados
	$sql_conteo="SELECT count(id_material)as conteo_id_material FROM materiales,usuarios WHERE materiales.identificacion_usuario in(?) and usuarios.identificacion=materiales.identificacion_usuario";
	$statement_conteo = $pdo->prepare($sql_conteo);
	$statement_conteo->execute(array($_SESSION['ident']));
	$resultado_conteo = $statement_conteo->fetchAll();

#consulta para mostrar en la tabla de gastos

	$sql="SELECT * FROM materiales,usuarios WHERE materiales.identificacion_usuario in(?) and usuarios.identificacion=materiales.identificacion_usuario order by materiales.id_material desc";
	$statement = $pdo->prepare($sql);
	$statement->execute(array($_SESSION['ident']));
	$resultado = $statement->fetchAll();
	
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Pagos</title>
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
				<legend id="click_ver_inventario" class="legenda">Registrar Material de oficina</legend>
				<?php if (@$_GET['reg']) {
					echo "<p style='color:white; background-color:green;'>Material Registrado.</p>";
				} ?>
			<form action="registro_material.php" method="post" entype="multipart/form-data" class="">
			<table border="1" width="100%">
				<tr>
					
					<td><input type="text" name="name" placeholder="nombre Material" class="form-control" required=""></td>
					<td><input type="text" name="tipo" placeholder="tipo Material" class="form-control" required=""></td>
					<td><input type="text" name="valor" placeholder="Valor Material" class="form-control" required=""></td>
					<td><input type="text" name="marca" placeholder="Marca Material" class="form-control" required=""></td>
					<td><input type="text" name="cantidad" placeholder="cantidad Material" class="form-control" required=""></td>
					<td><input type="reset" name="" value="Reiniciar" class="btn btn-warning"></td>
					<td><input type="submit" name="" value="Registrar" class="btn btn-success"></td>
				</tr>
					</form>
			</table>
				</div>
				
				<br>
			<legend id="click_ver_inventario" class="legenda">Total de Materiales Registrados.</legend>
		
			<div>
				<?php if (@$_GET['eliminado']) {
					echo "<p style='color:red;'>Material Eliminado</p>";
					$cod_eliminado = "<strong style='color:red;'>".$_SESSION['id_material']."</strong>";
					echo "identificacion de material ".$cod_eliminado." ha sido eliminado el Material.";
				} ?>
			</div>	
		
			<div class="ver_invent">
			<table border="1" width="100%" style="text-align: center; background-color: rgba(100,30,200,.3);">
				<tr style="background-color: gray; color: white; text-transform: uppercase; font-size: 12px">
					<td>id del Material</td>
					<td>nombre</td>
					<td>Tipo</td>
					<td>Valor</td>
					<td>Marca</td>
					<td>Cantidad</td>
					<td>Hora de Registro del sistema</td>
					<td>fecha de Registro del sistema</td>
					<td>Accion</td>
				</tr>
			
				<?php 
				foreach ($resultado_conteo as $res_conteo) {
				?>
				<p>Total de Materiales. <strong><?php echo $res_conteo['conteo_id_material']; ?></strong></p>
				<?php  
				}
				?>
				<?php foreach (@$resultado as $res) {	
				?>
				
					<tr>
						<td id="cod"><?php echo $res['id_material']; ?></td>
						<td><?php echo $res['nombre_material']; ?></td>
						<td><?php echo $res['tipo_material']; ?></td>
						<td><?php echo $res['valor_material']; ?></td>
						<td><?php echo $res['marca_material']; ?></td>
						<td><?php echo $res['cantidad_material']; ?></td>
						<td><?php echo $res['hora_registro']; ?></td>
						<td><?php echo $res['fecha_registro']; ?></td>
						<td><a id="btn_delete" class="btn btn-danger" href="elimina_material.php?id_material=<?php echo $res['id_material']; ?>" >Eliminar</a></td>
						
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


