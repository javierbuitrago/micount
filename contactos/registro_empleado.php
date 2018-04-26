<?php 
#session start
session_start();

#conexion
require_once 'conexion/conexion.php';

#Datos del formulario
$identificacion_empleado = $_POST['id'];
$name = $_POST['name'];
$apell = $_POST['apell'];
$fecha_na = $_POST['fecha_na'];
$fecha_in = date('Y-m-d');
$cargo = $_POST['cargo'];
$salario = $_POST['salario'];
$edad = $_POST['edad'];
$identificacion_usuario = $_SESSION['ident'];

#consulta
$sql_insert = "INSERT INTO empleados(identificacion_empleado,nombre_empleado,apellido_empleado,fecha_nacimiento,fecha_ingreso,	cargo,salario,edad,identificacion_usuario)VALUES(?,?,?,?,?,?,?,?,?)";
$statement = $pdo->prepare($sql_insert);
$statement->execute(array($identificacion_empleado,$name,$apell,$fecha_na,$fecha_in,$cargo,$salario,$edad,$identificacion_usuario));

if ($statement) {
	echo "
		<script>
			alert('has Registrado un nuevo empleado');
			location.href = 'pagos_nomina.php';
		</script>
	";
}



?>
