
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
#para inserccion en la base de datos tabla inventario
if ($_POST) {
	$codigo_inventario=$_POST['codigo_inventario']? $_POST['codigo_inventario']: '';
	$nombre_invent=$_POST['nombre_invent']? $_POST['nombre_invent']: '';
	$cantidad=$_POST['cantidad']? $_POST['cantidad']: '';
	$precio=$_POST['precio']? $_POST['precio']: '';
	$estado=$_POST['estado']? $_POST['estado']: '';
	
	$categoria=$_POST['categoria']? $_POST['categoria']: '';
	$fecha_invent=date('Y-m-d');
	#hora modificar 
	$hora_invent=date('h:m:s');
	$identificacion_usuario=$_SESSION['ident'];

#datos para el archivo imagen
	$imagen_file=$_FILES['imagen']['tmp_name'];
	$imagen_name=$_FILES['imagen']['name'];
	$destino="img/imagen_inventario/".$imagen_name;

#consulta para insertar en la base de datos
	$sql_reg_invent="INSERT INTO inventarios(codigo_inventario,nombre_inventario,fecha_inventario,hora_inventario,estado,cantidad,precio,imagen,identificacion_usuario,categoria_inventario)VALUES(?,?,?,?,?,?,?,?,?,?)";
	$statement_reg_invent=$pdo->prepare($sql_reg_invent);
	$statement_reg_invent->execute(array($codigo_inventario,$nombre_invent,$fecha_invent,$hora_invent,$estado,$cantidad,$precio,$imagen_name,$identificacion_usuario,$categoria));
	if ($statement_reg_invent) {
			move_uploaded_file($imagen_file, $destino);
			echo "
			<script>
			alert('inventario Registrado Con Exito');
			location.href=('hacer_inventario.php');
			</script>
			";
		
	}

}
if ($_SESSION) {
#para consultar la base de datos tabla categorias
	$ident=$_SESSION['ident'];
	$sql_categorias="SELECT * FROM categorias,usuarios WHERE categorias.identificacion_usuario in(?) and categorias.identificacion_usuario=usuarios.identificacion order by categoria";
	$statement_c = $pdo->prepare($sql_categorias);
	$statement_c->execute(array($ident));
	$resultado_c = $statement_c->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Hacer Inventario</title>
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
			<div class="col-xs-9">
				<legend id="click_hacer_inventario" class="legenda">Hacer Inventario</legend>
				<div class="hacer_inventario">

					<form class="form-group" action="" method="post" enctype="multipart/form-data">
						<input type="text" name="codigo_inventario" class="form-control" placeholder="codigo inventario" required="required">
						<input type="text" name="nombre_invent" class="form-control" placeholder="nombre inventario" required="required">
						<input type="text" name="cantidad" class="form-control" placeholder="cantidad" required="required">
						<input type="text" name="precio" class="form-control" placeholder="precio" required="required">
						<label for="estado">Seleccione estado del producto</label>
						<select type="text" name="estado" class="form-control" placeholder="estado" required="required">
							<option value="bueno">bueno</option>
							<option value="malo">malo</option>
							<option value="Regular">Regular</option>
						</select>
						<input type="file" name="imagen" class="form-control" placeholder="imagen" accept="image/*">
						<label for="categoria">Seleccione La Categoria</label>
						<select type="text" name="categoria" class="form-control" placeholder="categoria" required="required">
							<?php 
							foreach ($resultado_c as $res_c) {
							?>
							<option value="<?php echo $res_c['categoria']; ?>"><?php echo $res_c['categoria'] ?></option>
							<?php
							}
							?>
						</select>
						<input type="submit" class="btn btn-info" value="inventariar">
					</form>
				</div>
			</div>
			
		
	</section>

	<footer></footer>

</body>
</html>