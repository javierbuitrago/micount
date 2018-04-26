<?php
#session start
session_start();

#conexion
require_once 'conexion/conexion.php';

#Datos del formulario
$identificacion_cliente = $_POST['identificacion_cliente'];
$name = $_POST['name'];
$apellido = $_POST['apellido'];
$correo = $_POST['correo'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$identificacion_usuario = $_SESSION['ident'];

#consulta
$sql_insert = "INSERT INTO clientes(identificacion_cliente,nombre_cliente,apellido_cliente,
correo_cliente,direccion_cliente,telefono_cliente,identificacion_usuario)VALUES(?,?,?,?,?,?,?)";

$statement = $pdo->prepare($sql_insert);
$statement->execute(array($identificacion_cliente,$name,$apellido,$correo,$direccion,$telefono,$identificacion_usuario));

if ($statement) {
	echo "
		<script>
			alert('has Registrado un nuevo Cliente');
			location.href = 'clientes.php?reg=true';
		</script>
	";
}



?>
