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

#conteo de registro en la tabla de Clientes
	$sql_conteo="SELECT count(id_cliente)as conteo_id_cliente FROM clientes,usuarios WHERE clientes.identificacion_usuario in(?) and usuarios.identificacion=clientes.identificacion_usuario";
	$statement_conteo = $pdo->prepare($sql_conteo);
	$statement_conteo->execute(array($_SESSION['ident']));
	$resultado_conteo = $statement_conteo->fetchAll();

#consulta para mostrar en la tabla de gastos

	$sql="SELECT * FROM clientes,usuarios WHERE clientes.identificacion_usuario in(?) and usuarios.identificacion=clientes.identificacion_usuario order by clientes.id_cliente desc";
	$statement = $pdo->prepare($sql);
	$statement->execute(array($_SESSION['ident']));
	$resultado = $statement->fetchAll();

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Clientes</title>
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
				<legend id="click_ver_inventario" class="legenda">Registrar Cliente</legend>
				<?php if (@$_GET['reg']) {
					echo "<p style='color:white; background-color:green;'>Cliente Registrado.</p>";
				} ?>
			<form action="registro_cliente.php" method="post" entype="multipart/form-data" class="">
			<table border="1" width="100%">
				<tr>
				<label for="id">identificacion Cliente
					<td><input type="text" name="identificacion_cliente" placeholder="identificacion" class="form-control" required=""></td>
				</label>
				</tr>
				<tr>
					<td><input type="text" name="name" placeholder="nombre Cliente" class="form-control" required=""></td>
				</tr>
				<tr>
					<td><input type="text" name="apellido" placeholder="apellido Cliente" class="form-control" required=""></td>
				</tr>
				<tr>
          <td><input type="text" name="correo" placeholder="Correo" class="form-control" required=""></td>
          			</tr>
          			<tr>
					<td><input type="text" name="direccion" placeholder="Direccion" class="form-control" required=""></td>
				</tr>
				<tr>
					<td><input type="text" name="telefono" placeholder="Telefono" class="form-control" required=""></td>
				</tr>
				<tr>
					
					<td><input type="submit" name="" value="Registrar" class="btn btn-success"></td>
				</tr>
				
					
				
				

			</table>
			</form>
				</div>

				<br>
			<legend id="click_ver_inventario" class="legenda">Total de Clientes.</legend>

			<div>
				<?php if (@$_GET['eliminado']) {
					echo "<p style='color:red;'>Cliente Eliminado</p>";
					$cod_eliminado = "<strong style='color:red;'>".$_SESSION['id_cliente']."</strong>";
					echo "identificacion del Cliente ".$cod_eliminado." ha sido eliminado el Cliente.";
				} ?>
			</div>
		<?php
				foreach ($resultado_conteo as $res_conteo) {
				?>
				<p>Total de Clientes. <strong><?php echo $res_conteo['conteo_id_cliente']; ?></strong></p>
				<?php
				}
				?>
			<div class="ver_invent">
			<table border="1" width="100%" style="text-align: center; background-color: rgba(100,30,200,.3);">
				<tr style="background-color: gray; color: white; text-transform: uppercase; font-size: 12px">
					<td>identificacion del Cliente</td>
					<td>nombre</td>
					<td>apellido</td>
          <td>Correo</td>
					<td>Direccion</td>
					<td>Telefono</td>

					<td>Accion</td>
				</tr>


				<?php foreach (@$resultado as $res) {
				?>

					<tr>
						<td id="cod"><?php echo $res['identificacion_cliente']; ?></td>
						<td><?php echo $res['nombre_cliente']; ?></td>
						<td><?php echo $res['apellido_cliente']; ?></td>
            <td><?php echo $res['correo_cliente']; ?></td>
						<td><?php echo $res['direccion_cliente']; ?></td>
						<td><?php echo $res['telefono_cliente']; ?></td>

						<td><a id="btn_delete" class="btn btn-danger" href="elimina_cliente.php?id_cliente=<?php echo $res['id_cliente']; ?>" >Eliminar</a></td>

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


