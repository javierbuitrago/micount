<?php 
if ($_GET) {
session_start();
require_once 'conexion/conexion.php';
$_SESSION['id_entrada'] = $_GET['id_entrada'];
$sql_delete = "DELETE FROM entradas WHERE id_entrada in(?)";
$statement = $pdo->prepare($sql_delete);
$statement->execute(array($_GET['id_entrada']));
if ($statement) {
	header('location: facturas.php?eliminado=true');
}
}
?>