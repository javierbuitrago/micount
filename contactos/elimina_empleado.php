<?php 
if ($_GET) {
session_start();
require_once 'conexion/conexion.php';
$_SESSION['id_empleado'] = $_GET['id_empleado'];
$sql_delete = "DELETE FROM empleados WHERE identificacion_empleado in(?)";
$statement = $pdo->prepare($sql_delete);
$statement->execute(array($_GET['id_empleado']));
if ($statement) {
	header('location: pagos_nomina.php?eliminado=$_GET[id_empleado]');
}
}
?>