<?php 
#session start
session_start();

#conexion
require_once 'conexion/conexion.php';

#Datos del formulario

$name = $_POST['name'];
$tipo = $_POST['tipo'];
$valor = $_POST['valor'];
$marca = $_POST['marca'];
$cantidad = $_POST['cantidad'];
$hora_reg = date('h-l-s');
$fecha_reg = date('Y-m-d');
$identificacion_usuario = $_SESSION['ident'];

#consulta
$sql_insert = "INSERT INTO materiales(nombre_material,tipo_material,valor_material,marca_material,cantidad_material,hora_registro,fecha_registro,identificacion_usuario)VALUES(?,?,?,?,?,?,?,?)";
$statement = $pdo->prepare($sql_insert);
$statement->execute(array($name,$tipo,$valor,$marca,$cantidad,$hora_reg,$fecha_reg,$identificacion_usuario));

if ($statement) {
	echo "
		<script>
			alert('has Registrado un nuevo Material');
			location.href = 'pagos_oficina.php?reg=true';
		</script>
	";
}



?>
