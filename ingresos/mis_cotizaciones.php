<?php 
session_start();
require_once 'conexion/conexion.php';
if ($_SESSION['ident']) {
	echo "
        <script>
            console.log('sesion iniciada);
        </script>
    ";
}
   else
{
	header('location: index.php');
}



#consulta para traer los productos del usuario.
    $sql_productos = "SELECT * FROM usuarios,productos WHERE productos.identificacion_usuario in(?) AND usuarios.identificacion=productos.identificacion_usuario";
	$statement_productos = $pdo->prepare($sql_productos);
	$statement_productos->execute(array($_SESSION['ident']));
	$resultado_productos = $statement_productos->fetchAll();

#consulta para traer las cotizaciones.
    $sql_select = "SELECT * FROM cotizaciones,usuarios WHERE cotizaciones.identificacion_usuario=$_SESSION[ident] AND usuarios.identificacion=cotizaciones.identificacion_usuario order by id_cotizacion desc";
    
    $statement = $pdo->query($sql_select);
    $result = $statement->fetchAll(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>CountSystem</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/estilos_nav_lateral_isquierdo.css">
	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/agregar_lista_debajo_nav.js"></script>
</head>
<body>
	<header>
		<?php include('inc/navegacion.php'); ?>
	</header>
	<br>
	<aside>
		<div class="container">
			<div class="row">
				<div class="col-xs-4">
					<?php include('inc/nav_usuario_lateral_isquierdo/nav.php'); ?>
				</div>
				<div class="col-xs-4">
                <?php 
					if (@$_GET['cotizacion']==true) {
						echo "<p style='color:white; background-color:mediumseagreen;'>Cotizacion Guardada.</p>";
					}
                    if (@$_GET['delete']==true) {
						echo "<p style='color:white; background-color:red;'>Cotizacion Eliminada.</p>";
					}
					?>
				    <?php
                        foreach($result as $rs_cotizacion){  
                  
                     ?>
                <table style="border:1px gray solid;">
					<style>
						.input{
							color: black;
							font-weight: 100;
						}
					</style>
					
					<legend>Cotizacion codigo  <?php echo $rs_cotizacion['cod_cotizacion'] ?></legend>

						<form action="ver_cotizacion_pdf.php" method="post">
						<tr>
							<td class="input">codigo de cotizacion</td>
							<td><input type="text" name="cod" class="form-control" placeholder="codigo de Cotizacion" value="<?php echo $rs_cotizacion['cod_cotizacion']; ?>" required=""></td>
							<td class="input">cliente para la Cotizacion</td>
							<td>
								<input type="text" name="cli" class="" placeholder="cliente" required="" value="<?php echo $rs_cotizacion['cliente_cotizacion']; ?>">
							</td>
						</tr>
						
						<tr>
							<td class="input">observaciones de La Cotizacion</td>
							<td><input type="textarea" name="obs" class="form-control" placeholder="escribe las observaciones" value="<?php echo $rs_cotizacion['observaciones_cotizacion']; ?>"></input></td>
							<td class="input">Notas de La Cotizacion</td>
							<td><textarea type="textarea" name="not" class="form-control" placeholder="escribe las notas de la cotizacion" value="<?php echo $rs_cotizacion['notas_cotizacion']; ?>"></textarea></td>
						</tr>
						
						<tr>
							<td class="input">Vencimiento de La Cotizacion</td>
							<td><input type="text" name="venc" class="form-control" placeholder="vencimiento" value="<?php echo $rs_cotizacion['vencimiento_cotizacion']; ?>"></td>
						</tr>
						<tr>
							
						</tr>
						<tr>
							<td class="input">Impuesto</td>
							<td><input type="text" name="impuesto" class="form-control" placeholder="digita el impuesto" value="<?php echo $rs_cotizacion['impuesto_cotizacion']; ?>"></td>
						</tr>
					
						<tr>
							<td class="input">Producto o artefacto a cotizar</td>
							<td>
							    <input type="text" name="producto" class="form-control" placeholder="Producto" value="<?php echo $rs_cotizacion['producto_cotizacion']; ?>">
							</td>
							<td class="input">cantidad del producto</td>
							<td><input type="text" name="cant_prod" class="form-control" placeholder="digite la cantidad" required="" value="<?php echo $rs_cotizacion['cantidad_cotizacion']; ?>"></td>
						</tr>
						
						<tr>
								<td>
									<input type="submit" class="btn btn-success" value="Ver PDF e Imprimir">

								</td>
                                <td>
								    <a class="btn btn-danger" href="eliminar_cotizacion.php?id_cotizacion=<?php echo $rs_cotizacion['id_cotizacion']; ?>">Eliminar Cotizacion Guardada</a>
								</td>
							</tr>
						</form>
					</table>
                  <legend></legend>
                   <br>
                   <br>
                    <?php
                       } 
                    ?>
				</div>
				<div class="col-xs-4"></div>
			</div>
		</div>
	</aside>
	


	<footer></footer>

</body>
</html>