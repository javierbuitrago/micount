
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

#para consultar la base de datos tabla inventario
if ($_SESSION) {

#conteo de registro en la tabla de inventarios
	$sql_conteo="SELECT count(id_inventario)as conteo_id_inventario FROM inventarios,usuarios WHERE usuarios.usuario in(?) and usuarios.identificacion=inventarios.identificacion_usuario";
	$statement_conteo = $pdo->prepare($sql_conteo);
	$statement_conteo->execute(array($_SESSION['usuario']));
	$resultado_conteo = $statement_conteo->fetchAll();

#consulta para mostrar en la tabla de inventarios

	$sql="SELECT * FROM inventarios,usuarios WHERE usuarios.usuario in(?) and usuarios.identificacion=inventarios.identificacion_usuario order by id_inventario desc";
	$statement = $pdo->prepare($sql);
	$statement->execute(array($_SESSION['usuario']));
	$resultado = $statement->fetchAll();
	
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ver Inventario</title>
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
				<?php if (@$_GET['eliminado']) {
					echo "<p style='color:red;'>Inventario Eliminado</p>";
					$cod_eliminado = "<strong style='color:red;'>".$_SESSION['cod_inventario']."</strong>";
					echo "codigo de inventario ".$cod_eliminado." ha sido eliminado.";
				} ?>
			<legend id="click_ver_inventario" class="legenda">Ver inventario Completo</legend>
		
	
		
			<div class="ver_invent">
			<table border="1" width="100%" style="text-align: center; background-color: rgba(100,30,200,.3);">
				<tr style="background-color: gray; color: white; text-transform: uppercase; font-size: 12px">
					<td>codigo inventario</td>
					<td>nombre inventario</td>
					<td>cantidad</td>
					<td>precio</td>
					<td>estado</td>
					<td>imagen</td>
					<td>categoria</td>
					<td>fecha inventario</td>
					<td>hora inventario</td>
					<td>identificacion del que hizo el inventario</td>
					<td>nombre del que hizo el inventario</td>
					<td>Accion</td>
				</tr>
			
				<?php 
				foreach ($resultado_conteo as $res_conteo) {
				?>
				<p>registros de inventario actual <strong><?php echo $res_conteo['conteo_id_inventario']; ?></strong></p>
				<?php  
				}
				?>
				<?php foreach (@$resultado as $res) {	
				?>
				
					<tr>
						<td id="cod"><?php echo $res['codigo_inventario']; ?></td>
						<td><?php echo $res['nombre_inventario']; ?></td>
						<td><?php echo $res['cantidad']; ?></td>
						<td><?php echo $res['precio']; ?></td>
						<td><?php echo $res['estado']; ?></td>
						<td><img src="img/imagen_inventario/<?php echo $res['imagen']; ?>" width="80px" alt=""></td>
						<td><?php echo $res['categoria_inventario']; ?></td>
						<td><?php echo $res['fecha_inventario']; ?></td>
						<td><?php echo $res['hora_inventario']; ?></td>
						<td><?php echo $res['identificacion_usuario']; ?></td>
						<td><?php echo $res['nombre']; ?></td>
						<td><a id="btn_delete" class="btn btn-danger" href="elimina_inventario.php?cod_inventario=<?php echo $res['codigo_inventario']; ?>" >Eliminar</a></td>
						
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


