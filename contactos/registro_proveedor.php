<?php 
#session start
session_start();

#conexion
require_once 'conexion/conexion.php';

#Datos del formulario
$identificacion_proveedor = $_POST['id'];
$name = $_POST['name'];
$tipo = $_POST['tipo'];
$producto = $_POST['producto'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$valor = $_POST['valor'];
$hora_reg = date('h-l-s');
$fecha_reg = date('Y-m-d');
$identificacion_usuario = $_SESSION['ident'];

#consulta
$sql_insert = "INSERT INTO proveedores(identificacion_proveedor,nombre_proveedor,tipo_proveedor,producto_provee,direccion,telefono,valor_producto,identificacion_usuario,hora_registro,fecha_registro)VALUES(?,?,?,?,?,?,?,?,?,?)";
$statement = $pdo->prepare($sql_insert);
$statement->execute(array($identificacion_proveedor,$name,$tipo,$producto,$direccion,$telefono,$valor,$identificacion_usuario,$hora_reg,$fecha_reg));

if ($statement) {
	echo "
		<script>
			alert('has Registrado un nuevo Proveedor');
			location.href = 'proveedores.php?reg=true';
		</script>
	";
}



?>
