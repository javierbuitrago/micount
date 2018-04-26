
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


#consulta para mostrar en la tabla de inventarios

	$sql="SELECT * FROM usuarios,categorias WHERE usuarios.usuario in(?) and usuarios.identificacion=categorias.identificacion_usuario order by categoria asc";
	$statement = $pdo->prepare($sql);
	$statement->execute(array($_SESSION['usuario']));
	$resultado = $statement->fetchAll();
	
	if ($_POST) {
		
#para consultar la base de datos tabla categorias
	$ver_categoria=$_POST['ver_categoria'];
	$ident=$_SESSION['ident'];
	$sql_categorias="SELECT * FROM usuarios,inventarios WHERE inventarios.categoria_inventario in(?) and inventarios.identificacion_usuario in(?) and usuarios.identificacion=inventarios.identificacion_usuario";
	$statement_c = $pdo->prepare($sql_categorias);
	$statement_c->execute(array($ver_categoria,$ident));
	$resultado_categorias = $statement_c->fetchAll();
	}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>inventariado</title>
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
	
		
	<section class="container">
		<div class="row">
		<div class="col-xs-3">
			<?php include('inc/nav_usuario_lateral_isquierdo/nav.php'); ?>
		</div>
			<div class="col-xs-9">
				<legend id="click_ver_inventario_categoria" class="legenda">Ver inventario Por  Categoria</legend>
			<div class="">
				<form class="form-group" action="" method="post">
					<select name="ver_categoria" id="" class="form-control">
						<?php 
					
						foreach ($resultado as $res_c) {
						?>
						<option value="<?php echo $res_c['categoria']; ?>"><?php echo $res_c['categoria']; ?></option>
						<?php
						}
						?>
					</select>
					<input type="submit" class="btn btn-info" value="Consultar">
				</form>
			</div>
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
				</tr>
			
				
				<?php 
				if ($_POST) {
					foreach (@$resultado_categorias as $res) {				
				?>
				
					<tr>
						<td><?php echo $res['codigo_inventario']; ?></td>
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
					</tr>
				<?php
				}		
				} ?>
			</table>
				
			</div>
		</div>
	</section>
	
	
			
				
			


	<footer></footer>

</body>
</html>