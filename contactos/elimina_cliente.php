<?php 
if ($_GET) {
session_start();
require_once 'conexion/conexion.php';
$_SESSION['id_cliente'] = $_GET['id_cliente'];
$sql_delete = "DELETE FROM clientes WHERE id_cliente in(?)";
$statement = $pdo->prepare($sql_delete);
$statement->execute(array($_GET['id_cliente']));
if ($statement) {
	header('location: clientes.php?eliminado=true');
}
}
?>