<?php 
session_start();
require_once 'conexion/conexion.php';

#captura de datos del formulario
$nombre_gasto = $_POST['nombre_gasto'];
$descripcion_gasto = $_POST['descripcion_gasto'];
$cantidad_gasto = $_POST['cantidad_gasto'];

#estos datos siguientes no estan en el formulario
$fecha_gasto = date('Y-m-d');
$hora_gasto = date('h:L:s');#reparar el valor de minutos para este dato : $hora_gasto = date('h:L:s')
$identificacion_usuario = $_SESSION['ident'];

#consulta de insercion
$sql_insert = "INSERT INTO gastos
(
	nombre_gasto,
	descripcion_gasto,
	cantidad_gasto,
	fecha_gasto,
	hora_gasto,
	identificacion_usuario
)
VALUES
(
	?,?,?,?,?,?
)";

$statement = $pdo->prepare($sql_insert);
$statement->execute(array($nombre_gasto,$descripcion_gasto,$cantidad_gasto,$fecha_gasto,$hora_gasto,$identificacion_usuario));

if ($statement) {
	echo "
		<script>
			alert('Gasto Registrado con Exito');
			location.href = 'gastos_generales.php?reg=true';
		</script>
	";
}


?>

