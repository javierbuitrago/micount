<?php 
session_start();
require_once 'conexion/conexion.php';
if ($_SESSION['ident']) {
	#datos del formulario
	$imagen_file=$_FILES['imagen']['tmp_name'];
	$imagen_name=$_FILES['imagen']['name'];
	$ident = $_SESSION['ident'];
	#Consulta
	$sql_update_imagen = "UPDATE usuarios SET usuarios.imagen_empresa='$imagen_name' WHERE identificacion in(?)";
	$statement = $pdo->prepare($sql_update_imagen);
	$statement->execute(array($ident));

	
		$imagen_file=$_FILES['imagen']['tmp_name'];
		$imagen_name=$_FILES['imagen']['name'];
		$destino="img/imagen_empresa/".$imagen_name;
		$enviado = move_uploaded_file($imagen_file, $destino);
		if ($enviado) {
			echo "
			<script>
				alert('imagen de la Empresa Actualizada con Exito');
				location.href = ('perfil.php?update_imagen=true');
			</script>
			";
		}
	
}
else
{
	header('location: index.php');
}


	





?>