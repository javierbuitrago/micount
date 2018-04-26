<?php
#session start
session_start();

#conexion
require_once 'conexion/conexion.php';

#Datos del formulario
$cod_producto = $_POST['cod_producto'];
$name = $_POST['name'];
$descripcion = $_POST['descripcion'];
$precio = $_POST['precio'];
$fecha = date('Y-m-d');
$identificacion_usuario = $_SESSION['ident'];

#consulta
$sql_insert = "INSERT INTO productos(cod_producto,nombre_producto,descripcion_producto,precio_producto,fecha_producto,
identificacion_usuario)VALUES(?,?,?,?,?,?)";
$statement = $pdo->prepare($sql_insert);
$statement->execute(array($cod_producto,$name,$descripcion,$precio,$fecha,$identificacion_usuario));

if ($statement) {
	echo "
		<script>
			alert('has Registrado un nuevo Producto');
			location.href = 'productos.php?reg=true';
		</script>
	";
}



?>
