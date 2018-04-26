<?php 
if ($_GET) {
session_start();
require_once 'conexion/conexion.php';
$sql_delete = "DELETE FROM productos WHERE id_producto in(?)";
$statement = $pdo->prepare($sql_delete);
$statement->execute(array($_GET['id_producto']));
if ($statement) {
	header('location: productos.php?eliminado=true');
}
}
?>