
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
			location.href=('inventario.php');
			</script>
			";
		
	}

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
	
#para consultar la base de datos tabla categorias
	$ident=$_SESSION['ident'];
	$sql_categorias="SELECT * FROM categorias,usuarios WHERE categorias.identificacion_usuario in(?) and categorias.identificacion_usuario=usuarios.identificacion";
	$statement_c = $pdo->prepare($sql_categorias);
	$statement_c->execute(array($ident));
	$resultado_c = $statement_c->fetchAll();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>inventario</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/stilos_botones.css">
	<link rel="stylesheet" href="css/estilos_nav_lateral_isquierdo.css">
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/enlace_page.js"></script>
</head>
<body>
	<header>
		<?php include('inc/navegacion.php'); ?>
	</header>

	<section class="container">
		<div class="col-xs-3">
			<?php include('inc/nav_usuario_lateral_isquierdo/nav.php'); ?>
		</div>
		<div class="col-xs-4" style="background-color: rgba(100,30,200,.1);">
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
				<br>
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
						<td><a id="btn_delete" class="btn btn-danger" href="elimina_inventario_principal.php?cod_inventario=<?php echo $res['codigo_inventario']; ?>" >Eliminar</a></td>
						
					</tr>
				<?php	
				} ?>
			</table>
			</div>
			</div>
		</div>
		<div class="col-xs-4" style="background-color: rgba(100,30,200,.3);">
		<legend id="click_crear_categoria" class="legenda">Agregar Categoria</legend>
			<div class="crear_categoria">
				<form class="form-group" action="agregar_categoria_principal.php" method="post">
					<input type="text" class="form-control" name="categoria" placeholder="Nombre Categoria" required="required">
					<input type="submit" class="btn btn-info" value="Agregar">
				</form>
			</div>
		</div>
		
	</section>
	
	<section class="container">
		<div class="col-xs-4">
		

		</div>
		<div class="col-xs-4">
			
		</div>
	</section>
	
	
	<section class="container">
		<div class="row">
			<div class="col-xs-12">
				
			</div>
		</div>
	</section>


	<footer></footer>

</body>
</html>