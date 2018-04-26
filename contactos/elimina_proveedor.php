<?php 
if ($_GET) {
session_start();
require_once 'conexion/conexion.php';
$_SESSION['id_proveedor'] = $_GET['id_proveedor'];
$sql_delete = "DELETE FROM proveedores WHERE id_proveedor in(?)";
$statement = $pdo->prepare($sql_delete);
$statement->execute(array($_GET['id_proveedor']));
if ($statement) {
	header('location: proveedores.php?eliminado=true');
}
}
?>