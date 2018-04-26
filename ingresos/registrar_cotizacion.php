<?php
session_start();
require_once'conexion/conexion.php';
if ($_POST) {
	$cod = $_POST['cod'];
	$_SESSION['cod'] = $cod;
    $cliente = $_POST['cli'];
	$_SESSION['cliente'] = $cliente;
	$observacion = $_POST['obs'];
    $_SESSION['observacion'] = $observacion;
	$notas = $_POST['not'];
    $_SESSION['notas'] = $notas;
	$vencimiento = $_POST['venc'];
    $_SESSION['vencimiento'] = $vencimiento;
	$vendedor = $_POST['vendedor'];
    $_SESSION['vendedor'] = $vendedor;
	$precio_uni = $_POST['precio_uni'];
    $_SESSION['precio_uni'] = $precio_uni;
	$impuesto = $_POST['impuesto'];
    $_SESSION['impuesto'] = $impuesto;
	$producto = $_POST['producto'];
    $_SESSION['producto'] = $producto;
	$cant_prod = $_POST['cant_prod'];
    $_SESSION['cant_prod'] = $cant_prod;
	$fecha = date('Y-M-d');
	$hora = date('H:i:s');
	$precio_total = (intval($precio_uni)*intval($cant_prod));
    $_SESSION['precio_total'] = $precio_total;
	$ident = $_SESSION['ident'];

	#consulta de Registro
	$sql_insert = "INSERT INTO cotizaciones(
	cod_cotizacion,
	cliente_cotizacion,
	observaciones_cotizacion,
    producto_cotizacion,
	notas_cotizacion,
	fecha_cotizacion,
	vencimiento_cotizacion,
	vendedor_cotizacion,
	precio_unitario,
	precio_total,
	impuesto_cotizacion,
	cantidad_cotizacion,
	hora_cotizacion,
	identificacion_usuario
	)VALUES(
	?,?,?,?,?,?,?,?,?,?,?,?,?,?
	)";
	$statement = $pdo->prepare($sql_insert);
	$statement->execute(array($cod,$cliente,$observacion,$producto,$notas,$fecha,$vencimiento,$vendedor,$precio_uni,$precio_total,$impuesto,$cant_prod,$hora,$ident));

	if ($statement) {
		echo "
			<script>
				alert('Cotizacion Guardada.');
                location.href = ('inc/cotizacion/formato_pdf_cotizacion.php');
			</script>
		";
	}

}

?>
