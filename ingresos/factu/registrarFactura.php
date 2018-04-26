<?php
	session_start();
	require '../conexion/conexion.php';
	
	
	$cliente 		= $_POST['cliente'];
	
	#consulta para traer el id cliente
	$sqlCliente = "select cliente.id_cliente from clientes,usuarios,entradas where usuarios.identificacion=clientes.identificacion_usuario and clientes.id_cliente='$cliente'";
	$statementCliente = $pdo->prepare($sqlClie);
	$statementCliente->execute();
	$resultCliente = $statement->fetchAll();
	foreach($resultCliente as $rsCliente){
	$idCliente = $rsCliente['id_cliente'];
	}
	
	
	// Variables recibidas por POST
	$numerof	      	= $_POST['numerof'];
	$numeracion        	= $_POST['numeracion'];
	
	$notas 			= $_POST['notas'];
	$observaciones 	        = $_POST['observaciones']; 
 
 	$item			= $_POST['item'];
 	$referencia 		= $_POST['referencia'];
 	$tipoEntrada		= "factura recurrente";
 	$fechaEntrada		= date('y-m-d');
 	$horaEntrada		= date('H:i:s');
 	$precio			= $_POST['precio'];
 	$descuento 		= $_POST['descuento'];
 	$impuesto		= $_POST['impuesto'];
 	$descripcion 		= $_POST['descripcion'];
 	$cantidad		= $_POST['cantidad'];
 	$total 			= $_POST['total'];
 	
 	$plazo 			= $_POST['plazo'];
 	$fechaf 		= $_POST['fechaf'];
 	$vencimientof 		= $_POST['vencimientof'];
 	$bodega 		= $_POST['bodega'];
 	
 	
 	$vendedor 		= $_POST['vendedor'];
 	$listaPrecios 		= $_POST['listaPrecios'];
 	
 	$subtotal 		= $_POST['subtotal'];
 	$descuentoTotal		= $_POST['descuentoTotal'];
 	$subtotalDescuento 	= $_POST['subtotalDescuento'];
 	$totalTotal		= $_POST['totalTotal'];
 	
 	//ejecutarQuery("DELETE FROM entrada WHERE id_factura = ".$idFactura);
 	
 	#consulta para insertar datos de factura en la tabla entradas.
 	$pdo->query("INSERT entradas(numeracion,numero,notas,fecha,vencimiento,bodega,referencia,tipo_entrada,fecha_entrada,hora_entrada,id_cliente) VALUES(".$numeracion.",".$numerof.",'".$notas."' ,'".$fechaf."','".$vencimientof."','".$bodega."','".$referencia."','".$tipoEntrada."','".$fechaEntrada."','".$horaEntrada."',".$idCliente.")");
 	
 	#consulta para insertar item de facturas
 	for($i = 0; $i<sizeof($item); ++$i)
 		$pdo->query("INSERT item_factura VALUES('".$item[$i]."','".$referencia[$i]."',".$precio[$i].",".$descuento[$i].",".$impuesto[$i].",'".$descripcion[$i].",".$cantidad[$i].",".$total[$i].",".$numerof .")");




 	
?>
<script>
	alert("Datos Guardados exitosamente.");
	window.history.back();
</script>