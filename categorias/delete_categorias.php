<?php 

session_start();
require_once 'conexion/conexion.php';
if ($_SESSION['ident']) {
	echo "conect";

#consulta para traer datos de la tabla categorias.
if ($_GET) {
$categoria_id = $_GET['categoria'];
$sql_categorias = "DELETE FROM categorias WHERE categorias.id_categoria in(?)";
$statement_categorias = $pdo->prepare($sql_categorias);
$delete_categoria = $statement_categorias->execute(array($categoria_id));

if ($delete_categoria) {
	header('location: agregar_categoria.php?eliminado=true');
}


}
else
{
	header('location: index.php');
}

}

?>