<?php 
if ($_POST) {
	session_start();
	require_once 'conexion/conexion.php';
	
	$nombre_entrada=$_POST['nombre_entrada']? $_POST['nombre_entrada']: '';
	$tipo = 'ventas';
	$cantidad_entrante=$_POST['cantidad_entrante']? $_POST['cantidad_entrante']: '';
	$fecha=date('Y-m-d');
	#hora modificar 
	$hora=date('h:m:s');
	$identificacion_usuario=$_SESSION['ident'];

#datos para el archivo imagen
	$imagen_file=$_FILES['imagen']['tmp_name'];
	$imagen_name=$_FILES['imagen']['name'];
	$destino="img/imagen_facturas/".$imagen_name;

#consulta para insertar en la base de datos
	$sql_reg_invent="INSERT INTO entradas(nombre_entrada,tipo_entrada,imagen,cantidad_entrada,fecha_entrada,hora_entrada,identificacion_usuario)VALUES(?,?,?,?,?,?,?)";
	$statement_reg_invent=$pdo->prepare($sql_reg_invent);
	$statement_reg_invent->execute(array($nombre_entrada,$tipo,$imagen_name,$cantidad_entrante,$fecha,$hora,$identificacion_usuario));
	if ($statement_reg_invent) {
			move_uploaded_file($imagen_file, $destino);
			echo "
			<script>
			alert('Venta Registrada Con Exito');
			location.href=('ventas.php?reg=true');
			</script>
			";
		
	}

}
?>