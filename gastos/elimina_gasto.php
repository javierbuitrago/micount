<?php 
if ($_GET) {
session_start();
require_once 'conexion/conexion.php';
$_SESSION['id_gasto'] = $_GET['id_gasto'];
$sql_delete = "DELETE FROM gastos WHERE id_gasto in(?)";
$statement = $pdo->prepare($sql_delete);
$statement->execute(array($_GET['id_gasto']));
if ($statement) {
	header('location: gastos_generales.php?eliminado=true');
}
}
?>