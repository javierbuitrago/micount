<?php 
if ($_GET) {
session_start();
require_once 'conexion/conexion.php';
$_SESSION['cod_inventario'] = $_GET['cod_inventario'];
$sql_delete = "DELETE FROM inventarios WHERE codigo_inventario in(?)";
$statement = $pdo->prepare($sql_delete);
$statement->execute(array($_GET['cod_inventario']));
if ($statement) {
	header('location: inventario.php?eliminado=$_GET[cod_inventario]');
}
}
?>