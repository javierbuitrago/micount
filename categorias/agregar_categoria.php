<?php 
session_start();
require_once('conexion/conexion.php');

if ($_SESSION['ident']) {
	echo "conect";

#consulta para traer datos de la tabla categorias.
$sql_categorias = "SELECT * FROM categorias,usuarios WHERE categorias.identificacion_usuario=$_SESSION[ident] AND categorias.identificacion_usuario=usuarios.identificacion ORDER BY id_categoria desc";
$statement_categorias = $pdo->prepare($sql_categorias);
$statement_categorias->execute(array());
$result_categorias = $statement_categorias->fetchAll();

}
else
{
	header('location: index.php');
}

if ($_POST) {	
	$categoria=$_POST['categoria']? $_POST['categoria']: '';

#consulta para insertar en la base de datos tabla categorias
	$ident=$_SESSION['ident'];
	$sql_reg_cat="INSERT INTO categorias(identificacion_usuario,categoria)VALUES(?,?)";
	$statement_reg_cat=$pdo->prepare($sql_reg_cat);
	$statement_reg_cat->execute(array($_SESSION['ident'],$categoria));
	if ($statement_reg_cat) {
			echo "
			<script>
			alert('Categoria Agregada Con Exito');
			location.href=('agregar_categoria.php');
			</script>
			";
		
	}

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Agregar Categoria</title>
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
		<div class="col-xs-3">
			<?php include('inc/nav_usuario_lateral_isquierdo/nav.php'); ?>
		</div>
		<div class="col-xs-4">
			<legend id="click_crear_categoria" class="legenda">Agregar Categoria</legend>
			<div class="crear_categoria">
				<form class="form-group" action="" method="post">
					<input type="text" class="form-control" name="categoria" placeholder="Nombre Categoria" required="required">
					<input type="submit" class="btn btn-info" value="Agregar">
				</form>
			</div>
		</div>
		<div class="col-xs-4">
		<?php 
		if (@$_GET['eliminado']) {
			echo "<p style='color:red'>Categoria Eliminada.</p>";
		}
		?>
			<legend>Mis Categorias</legend>
			<table>
				<tr>
					<th>categoria</th>
					<th>Accion</th>
				</tr>
				
					<?php 
					foreach ($result_categorias as $rs_categorias) {
					?>
					<tr>
						<td><?php echo $rs_categorias['categoria']; ?></td>
						<td><a href="delete_categorias.php?categoria=<?php echo $rs_categorias['id_categoria']; ?>" class="btn btn-danger">Eliminar</a></td>	
					</tr>	
					<?php 
					}
					?>
				

			</table>
		</div>
	</section>

	<footer></footer>

</body>
</html>