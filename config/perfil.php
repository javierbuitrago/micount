<?php 
session_start();
require_once 'conexion/conexion.php';
if ($_SESSION['ident']) {
	
	echo "";
#consulta para traer datos de la tabla usuario.
	$sql_query = "SELECT * FROM usuarios WHERE usuarios.identificacion in(?)";
	$statement = $pdo->prepare($sql_query);
	$statement->execute(array($_SESSION['ident']));
	$resultado_query = $statement->fetchAll();
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
	<title>Perfil | <?php echo $_SESSION['usuario']; ?> |</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/estilos_nav_lateral_isquierdo.css">
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/aparecer_nav.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	
</head>
<body>
	<header>
		<?php include('inc/navegacion.php'); ?>
	</header>
	<aside>
		<div class="container">
			<div class="row">
				<div class="col-xs-4">
				<legend class="legenda-ver-nav" style="cursor:pointer;">Menu De Trabajo <-</legend>
					<div class="espacio-nav-lateral">
						<?php include('inc/nav_usuario_lateral_isquierdo/nav.php'); ?>
					</div>
				</div>
				<div class="col-xs-4">
				<legend class="legenda-ver-nav-perfil" style="cursor:pointer;">Menu Perfil <-</legend>
					<div class="espacio-nav-lateral-perfil">
						<?php include 'inc/navegacion_perfil.php'; ?>

					</div>
				</div>
					
				<div class="col-xs-4">
					<div class="data_update">
					<?php 

					if (@$_GET['update']==true) {
						echo "<p style='background-color:mediumseagreen;color:white;'>Datos Actualizados con exito.</p>";
					}
					?>
					<div style="background-color: rgba(100,20,200,.2); border-radius: 10px; text-align: center; padding: 10px;">
					
							
							<?php if (@$_GET['data_update']) {
								foreach ($resultado_query as $rs_query) {
							?>
							<legend>Actualizar Datos</legend>
							<table width="100%">
								<form action="actualizar_datos.php" method="post">
							<tr>
								<th>Idetificacion</th>
								<td><input type="text" name="identificacion" class="form-control" value="<?php echo $rs_query['identificacion']; ?>" disabled required></td>
							</tr>
								<th>Nombre de la empresa</th>
								<td><input type="text" name="nombre_empresa" class="form-control" value="<?php echo $rs_query['nombre_empresa']; ?>" required></td>
							</tr>
								<th>identificacion del negocio</th>
								<td><input type="text" name="id_negocio" class="form-control" value="<?php echo $rs_query['id_negocio']; ?>" required></td>
							</tr>
								<th>Correo Electronico</th>
								<td><input type="text" name="correo" class="form-control" value="<?php echo $rs_query['correo']; ?>" required></td>
							</tr>
								<th>Numero de contacto</th>
								<td><input type="text" name="numero_contacto" class="form-control" value="<?php echo $rs_query['numero_contacto']; ?>" required></td>
							</tr>
								<th>Mi Nombre</th>
								<td><input type="text" name="nombre" class="form-control" value="<?php echo $rs_query['nombre']; ?>" required></td>
							</tr>
								<th>Mi Apellido</th>
								<td><input type="text" name="apellido" class="form-control" value="<?php echo $rs_query['apellido']; ?>" required></td>
							</tr>
								<th>Mi Nacionalidad</th>
								<td><input type="text" name="nacionalidad" class="form-control" value="<?php echo $rs_query['nacionalidad']; ?>" required></td>
							</tr>
								<th>Mi Cargo</th>
								<td><input type="text" name="cargo" class="form-control" value="<?php echo $rs_query['cargo']; ?>" required></td>
							</tr>
								<th>Mi Direccion</th>
								<td><input type="text" name="direccion" class="form-control" value="<?php echo $rs_query['direccion']; ?>" required></td>
							</tr>
								<th>Mi Telefono</th>
								<td><input type="text" name="telefono" class="form-control" value="<?php echo $rs_query['telefono']; ?>" required></td>
							</tr>
								<th>Link o Ruta del Sitio Web</th>
								<td><input type="text" name="website_link" class="form-control" value="<?php echo $rs_query['website_link']; ?>" required></td>
							</tr>
								
							</tr>
								<th>Mi Usuario de Ingreso</th>
								<td><input type="text" name="usuario"class="form-control" value="<?php echo $rs_query['usuario']; ?>" required></td>
							</tr>
								<th>Mi clave de ingreso</th>
								<td><input type="text" name="clave" class="form-control" value="<?php echo $rs_query['clave']; ?>" required></td>
							</tr>
								<td>Accion</td>
								<td><input type="submit" class="btn btn-success" value="Actualizar mis Datos"></td>
							</tr>
							<?php
								}
							} 
							else{
								echo "";
							}
							?>
							</form>
							</div>
							<div style="background-color: rgba(100,20,200,.2); border-radius: 10px; padding: 10px;">
							</table>
							<?php 
							if (@$_GET['update_imagen']==true) {
								echo "<p style='background-color:mediumseagreen;color:white;'>Imagen Actualizada con exito.</p>";
							}
							?>
							
							<?php 
							if (@$_GET['data_update_imagen']){	
							?>
							<legend>Actualizar Imagen de la empresa o logo</legend>
							<table width="100%">
								<form action="actualizar_imagen_empresa.php" method="post" enctype="multipart/form-data">
							<tr>
								<th>imagen de la empresa</th>
								<td>
									<img src="img/imagen_empresa/<?php foreach ($resultado_query as $rs_query_imagen) {
										echo $rs_query_imagen['imagen_empresa'];
									}
									 ?>" alt="no hay imagen de la empresa" width="100px">
								 </td>
							</tr>
							<tr>
								<th>cambiar imagen</th>
								<td><input type="file" accept="img/image" name="imagen" required=""></td>
							</tr>	
							<tr>
								<td></td>
								<td><input type="submit" value="Actualizar" class="btn btn-success"></td>
							</tr>
							<?php 
							}
							?>
								</form>
							</table>
							</div>
						</div>
				</div>
			</div>
		</div>
	</aside>
	


	<footer></footer>

</body>
</html>