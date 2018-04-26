<?php
	session_start();
	require '../conexion/conexion.php';
	
	
	$cliente 		= $_POST['cliente'];
    echo $cliente;
	
	#consulta para traer el id cliente
	
    $sqlCliente = "select clientes.id_cliente from clientes,usuarios where usuarios.identificacion=clientes.identificacion_usuario and clientes.nombre_cliente ='$cliente'";
	$statementCliente = $pdo->prepare($sqlCliente);
    
	$statementCliente->execute();
    
	$resultCliente = $statementCliente->fetchAll();
	foreach($resultCliente as $rsCliente){
	$idCliente = $rsCliente['id_cliente'];
        echo $idCliente;
	}
    
	
	
	// Variables recibidas por POST
	@$numerof	      	= $_POST['numerof'];
	@$numeracion        	= $_POST['numeracion'];
	
	@$notas 			= $_POST['notas'];
	@$observaciones 	        = $_POST['observaciones']; 
 
 	@$item			= $_POST['item'];
 	@$referencia 		= $_POST['referencia'];
 	@$tipoEntrada		= "factura recurrente";
 	@$fechaEntrada		= date('y-m-d');
 	@$horaEntrada		= date('H:i:s');
 	@$precio			= $_POST['precio'];
 	@$descuento 		= $_POST['descuento'];
 	@$impuesto		= $_POST['impuesto'];
 	@$descripcion 		= $_POST['descripcion'];
 	@$cantidad		= $_POST['cantidad'];
 	@$total 			= $_POST['total'];
 	
 	
 	@$fechaf 		= $_POST['fechaf'];
 	@$vencimientof 		= $_POST['vencimientof'];
 	@$plazo 		= $_POST['plazo'];
 	@$bodega 		= $_POST['bodega'];
 	
 	@$vendedor 		= $_POST['vendedor'];
 	@$listaPrecios 		= $_POST['listaPrecios'];
 	
 	@$subtotal 		= $_POST['subtotal'];
 	@$descuentoTotal	= $_POST['descuentoTotal'];
 	@$subtotalDescuento 	= $_POST['subtotalDescuento'];
 	@$totalTotal		= $_POST['totalTotal'];
 	
 	//ejecutarQuery("DELETE FROM entrada WHERE id_factura = ".$idFactura);
 	
 	#consulta para insertar datos de factura en la tabla entradas.
    $consultaSql = "INSERT INTO entradas(
        numeracion,
        numero,
        notas,
        fecha,
        vencimiento,
        plazo,
        bodega,
        tipo_entrada,
        fecha_entrada,
        hora_entrada,
        id_cliente,
        subtotal,
        descuentoTotal,
        subtotalDescuento,
        totalTotal
        ) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $consulta = $pdo->prepare($consultaSql);
    $consulta->execute(array($numeracion,$numerof,$notas,$fechaf,$vencimientof,$plazo,$bodega,$tipoEntrada,$fechaEntrada,$horaEntrada,$subtotal,
        $descuentoTotal,$subtotalDescuento,$totalTotal,$idCliente));
    $consulta->errorCode();
            if($consulta){echo "<br>datos enviados a entradas."; 
             echo "
                <script>
                    alert('Factura Guardada Con Exito.');
window.location.href='facturas.php'                </script>";}
    
    #consulta para traer id_entrada
    $sqlEntrada = "select entradas.id_entrada from entradas where entradas.numero in(?)";
	$statementEntrada = $pdo->prepare($sqlEntrada);
    
	$statementEntrada->execute(array($numerof));
    
	$resultEntrada = $statementEntrada->fetchAll();
	foreach($resultEntrada as $rsEntrada){
	$idEntrada = $rsEntrada['id_entrada'];
        echo $idEntrada;
	}
    
 	
 	#consulta para insertar item de facturas

    for($i = 0; $i < sizeof($item); $i++){
        $insertSql = "INSERT INTO item_factura(item,referencia,precio_unitario,descuento,impuesto,descripcion,cantidad,total,fecha,hora,id_entrada) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
        $insert = $pdo->prepare($insertSql);
        $insert->execute(array($item[$i],$referencia[$i],$precio[$i],$descuento[$i],$impuesto[$i],$descripcion[$i],$cantidad[$i],$total[$i],$fechaEntrada,$horaEntrada,$idEntrada));
        
    }
    
            if($insert){
                echo "
                <script>
                    alert('Factura Guardada Con Exito.');
window.location.assign('https://www.w3schools.com')                </script>"; 
                       }

 	
?>
