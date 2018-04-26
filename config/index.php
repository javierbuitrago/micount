<?php 
session_start();
require_once '../conexion/conexion.php';
if ($_SESSION['ident']) {
	echo "";
}
else
{
	header('location: ../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fn Conta</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" media="(max-width: 300px)" href="../css/inicio.css">
        <link rel="stylesheet" href="../css/inicio.css">

    <link rel="shortcut icon" href="../img/imgmain/favicon-ilove.png" type="image/x-icon">
    <link rel="icon" type="image/png" href="../img/imgmain/favicon-ilove.png"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100i,300,400,400i,700,900i" rel="stylesheet">
   
	<script type="text/javascript" src="../js/agregar_lista_debajo_nav.js"></script>
</head>
<body>

 <?php include('../menuFreenetConfig.php');  ?>
	
	<center>
		<h2>Configuraciones</h2>
	<table width="60%">
		<tbody>
			<tr>
				<td class="celdas-config"><a href="" class="celdas-title">Facturacion</a><br>
					Configura la información que se mostrará en tus facturas de venta y su formato de impresión <br><br>
				<ul>
					<li><a href="terminos.php">Terminos de Pago</a></li>
					<li><a href="">numeracion</a></li>
					<li><a href="">Datos generales</a></li>
					<li><a href="">vendedores</a></li>
					<li><a href="">terminos de pago</a></li>
				</ul>
			</td>
				
				<td class="celdas-config"><a href="" class="celdas-title">Plantillas</a><br>
					Administra las plantillas de impresión de tus documentos <br><br>
					<ul>
						<li><a href="">plantillas</a></li>
					</ul>
				</td>
				<td class="celdas-config"><a href="" class="celdas-title">Impuestos</a><br>
					Define aquí los tipos de impuestos y retenciones que aplicas a tus facturas de venta <br><br>
					<ul>
						<li><a href="">inpuestos</a></li>
						<li><a href="">retenciones</a></li>
					</ul>
				</td>

			</tr>
			<tr>
				<td class="celdas-config"><a href="" class="celdas-title">Empresa</a><br>
					Completa la información de tu empresa. Esto es importante para que tus facturas de venta cuenten con una presentación adecuada <br><br>
					<ul>
					<li><a href="">Empresa</a></li>
					<li><a href="">Usuarios</a></li>
					<li><a href="">Mi perfil</a></li>
					<li><a href="">Multimoneda</a></li>
					
				</ul>
				</td>
				<td class="celdas-config"><a href="" class="celdas-title">Notificaciones y correos</a><br>
					Configura las plantillas, las notificaciones del sistema y las notificaciones de facturas de venta <br><br>
					<ul>
					<li><a href="">notificacion</a></li>
					<li><a href="">plantillas personalizadas</a></li>
					<li><a href="">preferencias de correo</a></li>
					<li><a href="">vendedores</a></li>
					<li><a href="">terminos de pago</a></li>
				</ul>
				</td>
				<td class="celdas-config"><a href="" class="celdas-title">Historial</a><br>
					Consulta el historial de correos de facturas de venta enviadas a clientes y operaciones realizadas en la cuenta <br><br>
					<ul>
					<li><a href="">historial de correos</a></li>
					<li><a href="">historial de operaciones</a></li>
				</ul>
				</td>

			</tr>
			<tr>
				<td class="celdas-config"><a href="" class="celdas-title">Integracion con apps</a><br>
					Encuentra toda la información para que puedas integrar otros sistemas con Alegra <br><br>
					<ul>
					<li><a href="">API</a></li>
					<li><a href="">zapier</a></li>
					<li><a href="">Pagos en linea</a></li>
				</ul>
				</td>
				<td class="celdas-config"><a href="" class="celdas-title">Suscricion - planes</a><br>
					Encuentra toda la información para que puedas integrar otros sistemas con Alegra <br><br>
					<ul>
					<li><a href="">suscripcion</a></li>
					<li><a href="">metodos de pago</a></li>
				</ul>
				</td>
				<td class="celdas-config"><a href="" class="celdas-title">inventario</a><br>
					Activa el código de barras para que lo utilices en tu POS <br><br>
					<ul>
					<li><a href="">atributos Adicionales</a></li>
				</ul>
				</td>
				<td></td>

			</tr>
		</tbody>
	</table>
	</center>
	<style>
.celdas-config{
	background-color: transparent;
	border: 1px dodgerblue solid;
}
li{
	list-style: none;
}
a{
	color: dodgerblue;
}
.celdas-title{
	font-size: 18px;
	border-bottom: 1px blue solid;

}
	</style>

	
	
	<footer class="foot">Copyright@ 2018 Freenet.</footer>
</div>

</body>
</html>

	
