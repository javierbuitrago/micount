<?php 
if ($_GET) {
session_start();
require_once 'conexion/conexion.php';
$_SESSION['id_material'] = $_GET['id_material'];
$sql_delete = "DELETE FROM materiales WHERE id_material in(?)";
$statement = $pdo->prepare($sql_delete);
$statement->execute(array($_GET['id_material']));
if ($statement) {
	header('location: pagos_oficina.php?eliminado=true');
}
}
?>