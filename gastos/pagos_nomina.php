
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
	$sql_conteo="SELECT count(id_empleado)as conteo_id_empleado FROM empleados,usuarios WHERE empleados.identificacion_usuario in(?) and usuarios.identificacion=empleados.identificacion_usuario";
	$statement_conteo = $pdo->prepare($sql_conteo);
	$statement_conteo->execute(array($_SESSION['ident']));
	$resultado_conteo = $statement_conteo->fetchAll();

#consulta para mostrar en la tabla de gastos

	$sql="SELECT * FROM empleados,usuarios WHERE empleados.identificacion_usuario in(?) and usuarios.identificacion=empleados.identificacion_usuario order by empleados.id_empleado desc";
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
				<legend id="click_ver_inventario" class="legenda">Registrar Empleado</legend>
			<form action="registro_empleado.php" method="post" entype="multipart/form-data" class="">
			<table border="1" width="100%">
				<tr>
					<td><input type="text" name="id" placeholder="identificacion Empleado" class="form-control" required=""></td>
					<td><input type="text" name="name" placeholder="nombre" class="form-control" required=""></td>
					<td><input type="text" name="apell" placeholder="apellido" class="form-control" required=""></td>
					<td><input type="text" name="fecha_na" placeholder="fecha de nacimiento" class="form-control" required=""></td>
					<td><input type="text" name="cargo" placeholder="cargo" class="form-control" required=""></td>
					<td><input type="text" name="salario" placeholder="salario" class="form-control" required=""></td>
					<td><input type="text" name="edad" placeholder="edad" class="form-control" required=""></td>
					<td><input type="reset" name="" value="Reiniciar" class="btn btn-warning"></td>
					<td><input type="submit" name="" value="Registrar" class="btn btn-success"></td>
				</tr>
					</form>
			</table>
				</div>
				
				<br>
			<legend id="click_ver_inventario" class="legenda">Total de Empleados</legend>
		
			<div>
				<?php if (@$_GET['eliminado']) {
					echo "<p style='color:red;'>empleado Eliminado</p>";
					$cod_eliminado = "<strong style='color:red;'>".$_SESSION['id_empleado']."</strong>";
					echo "identificacion de empleado ".$cod_eliminado." ha sido eliminado el empleado.";
				} ?>
			</div>	
		
			<div class="ver_invent">
			<table border="1" width="100%" style="text-align: center; background-color: rgba(100,30,200,.3);">
				<tr style="background-color: gray; color: white; text-transform: uppercase; font-size: 12px">
					<td>identificacion Empleado</td>
					<td>nombre</td>
					<td>apellido</td>
					<td>fecha nacimiento</td>
					<td>fecha ingreso al sistema</td>
					<td>cargo</td>
					<td>salario</td>
					<td>edad</td>
					<td>Accion</td>
				</tr>
			
				<?php 
				foreach ($resultado_conteo as $res_conteo) {
				?>
				<p>Total de Empleados. <strong><?php echo $res_conteo['conteo_id_empleado']; ?></strong></p>
				<?php  
				}
				?>
				<?php foreach (@$resultado as $res) {	
				?>
				
					<tr>
						<td id="cod"><?php echo $res['identificacion_empleado']; ?></td>
						<td><?php echo $res['nombre_empleado']; ?></td>
						<td><?php echo $res['apellido_empleado']; ?></td>
						<td><?php echo $res['fecha_nacimiento']; ?></td>
						<td><?php echo $res['fecha_ingreso']; ?></td>
						<td><?php echo $res['cargo']; ?></td>
						<td><?php echo $res['salario']; ?></td>
						<td><?php echo $res['edad']; ?></td>
						<td><a id="btn_delete" class="btn btn-danger" href="elimina_empleado.php?id_empleado=<?php echo $res['identificacion_empleado']; ?>" >Eliminar</a></td>
						
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


