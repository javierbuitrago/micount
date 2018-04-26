<?php
$dts="mysql:dbname=sistemaCount;host=localhost;";
$user="root";
$pass="";
try {
	$pdo=new pdo($dts,$user,$pass);

} catch (Exception $e) {
	$e.getMessage();
	echo "= problemas en la conexion";
}
?>
