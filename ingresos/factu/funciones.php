<?php
$conexion = null;
function abrirConex()
{
	global $conexion;
	// Conexión con el servidor de base de datos MySQL
	$conexion = mysqli_connect('localhost', 'freenet', 'Ufps160520.', 'sistemaCount');
	mysqli_set_charset($conexion, 'utf8');
}
function cerrarConex($result='')
{
	if($result!='')
		mysqli_free_result($result); 
	// Cerrar conexión a la BD
	mysqli_close($GLOBALS['conexion']);
}
function sonDatosCorrectos($usuario, $clave) 
{	
	abrirConex();
	// Sentencia SQL para consultar el nombre del usuario
	$sql = "SELECT * FROM Auditor WHERE usuario='".$usuario."' AND password='".$clave."'";
	$resultado = mysqli_query($GLOBALS['conexion'], $sql);
	// Si existe, inicia sesión y guarda info del usuario
	if( $fila = mysqli_fetch_row($resultado) )
	{	
		session_start();
		// Comenzamos a usar variables de sesión
		$_SESSION['usuario'] = $usuario;
		$_SESSION['DNI'] = $fila[2];
		$_SESSION['nombres'] = $fila[3];
		$_SESSION['apellidos'] = $fila[4];
		$_SESSION['direccion'] = $fila[5];
		$_SESSION['telefono'] = $fila[6];
		$_SESSION['email'] = $fila[7];
		$_SESSION['sexo'] = $fila[8];
		$_SESSION['tipo'] = $fila[9];
		cerrarConex($resultado);
		return true; // Indicamos que sí existe
	} 
	return false;  
}
// Para verificar que ya se ha iniciado sesión previamente
function haIniciadoSesion()
{
	// Continuar una sesión iniciada
	session_start();
	// Verificamos la existencia de la variable de sesión
	if( isset($_SESSION['usuario']) ) return true;
	return false;
}
function getFines($id)
{
	abrirConex();
	global $conexion;
	$resultSet = mysqli_query($conexion, "SELECT fechaFin FROM Proyecto WHERE ID_Plan=".$id);
	return $resultSet->fetch_all();	
}

function getNormativa($id)
{
	abrirConex();
	global $conexion;
	$resultSet = mysqli_query($conexion, "SELECT * FROM NormativaAuditoria
										WHERE ID_Plan=".$id);
	return $resultSet->fetch_all()[0];
}
function getLastPlanID()
{
	// Devuelve el ID del último plan registrado
	abrirConex();
	global $conexion;
	$resultSet = mysqli_query($conexion, "SELECT MAX(ID_Plan) FROM PlanAuditoria");
	return $resultSet->fetch_all()[0][0];
}
function getLastPruebaID()
{
	// Devuelve el ID de la última prueba registrado
	abrirConex();
	global $conexion;
	$resultSet = mysqli_query($conexion, "SELECT COUNT(ID_Prueba) FROM Prueba");
	return $resultSet->fetch_all()[0][0];
}
/* FUNCIONES UTILITARIAS */
function ejecutarQuery($query)
{
	global $conexion;
	abrirConex();
	return mysqli_query($conexion, $query);
}
function getResultSet($query)
{
	global $conexion;
	abrirConex();
	$resultSet = mysqli_query($conexion, $query);
	cerrarConex();
	return $resultSet;
}
function getFirstRow($query)
{
	$rpta = getResultSet($query);
	if($rpta)
		return mysqli_fetch_row( getResultSet($query) );
	return array();
}
function getFirstValue($query)
{
	$rpta = getFirstRow($query);
	if($rpta)
		return $rpta[0];		
	return '';
}
?>