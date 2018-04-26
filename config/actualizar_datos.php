<?php 
session_start();
if ($_POST) {
	require_once 'conexion/conexion.php';

	#datos del formulario
	$ident = $_SESSION['ident'];
	@$identificacion = $_POST['identificacion'];
	$nombre_empresa = $_POST['nombre_empresa'];
	$id_negocio = $_POST['id_negocio'];
	$correo = $_POST['correo'];
	$numero_contacto = $_POST['numero_contacto'];
	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
	$nacionalidad = $_POST['nacionalidad'];
	$cargo = $_POST['cargo'];
	$direccion = $_POST['direccion'];
	$telefono = $_POST['telefono'];
	$website_link = $_POST['website_link'];
	$usuario = $_POST['usuario'];
	$clave = $_POST['clave'];
	


	#consulta
	$sql_update = "UPDATE usuarios SET nombre_empresa ='$nombre_empresa',id_negocio ='$id_negocio',correo ='$correo',numero_contacto =$numero_contacto,nombre ='$nombre',apellido ='$apellido',nacionalidad ='$nacionalidad',cargo ='$cargo',direccion ='$direccion',telefono =$telefono,website_link ='$website_link',usuario ='$usuario',clave ='$clave' WHERE usuarios.identificacion in(?)";
	$statement = $pdo->prepare($sql_update);
	#ejecucion de consulta 
	$statement->execute(array($ident));


	#condicion de consulta lograda
	if ($statement) {
		echo "
			<script>
				alert('Sus Datos han sido Actualizados');
				location.href = ('perfil.php?update=true');
			</script>
		";
	}
}


?>