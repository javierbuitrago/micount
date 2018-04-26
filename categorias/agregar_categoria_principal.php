<?php 
session_start();
require_once('conexion/conexion.php');

if ($_SESSION['ident']) {
	echo "conect";
}
else
{
	header('location: index.php');
}

if ($_POST) {	
	$categoria=$_POST['categoria']? $_POST['categoria']: '';

#consulta para insertar en la base de datos tabla categorias
	$ident=$_SESSION['ident'];
	$sql_reg_cat="INSERT INTO categorias(identificacion_usuario,categoria)VALUES(?,?)";
	$statement_reg_cat=$pdo->prepare($sql_reg_cat);
	$statement_reg_cat->execute(array($_SESSION['ident'],$categoria));
	if ($statement_reg_cat) {
			echo "
			<script>
			alert('Categoria Agregada Con Exito');
			location.href=('inventario.php');
			</script>
			";
		
	}

}

?>