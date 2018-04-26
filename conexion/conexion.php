<?php
$dts="mysql:dbname=sistemacount;host=localhost;";
$user="brayan";
$pass="brayan";
try {
	$pdo=new pdo($dts,$user,$pass);

} catch (Exception $e) {
	$e.getMessage();
	echo "= problemas en la conexion";
}
?>
