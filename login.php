<?php 
session_start();
require_once('conexion/conexion.php');
if ($_POST) {
	$usuario=$_POST['usuario']? $_POST['usuario'] : '';
	$clave=$_POST['clave']? $_POST['clave'] : '';
	$_SESSION['usuario'] = $usuario;
	$_SESSION['clave'] = $clave;

	$sql="SELECT * FROM usuarios WHERE usuario in(?) and clave in(?)";
	$statement = $pdo->prepare($sql);
	$statement->execute(array($usuario,$clave));
	@$result = $statement->fetchAll();
	
	foreach (@$result as $r) {
				@$ident=$r['identificacion'];
				@$_SESSION['ident']=$ident;
				@$_SESSION['nombre']=$r['nombre'];
			}

}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fn Conta</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="shortcut icon" href="img/imgmain/favicon-ilove.png" type="image/x-icon">
    <link rel="icon" type="image/png" href="img/imgmain/favicon-ilove.png"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto:100i,300,400,400i,700,900i" rel="stylesheet">
</head>
<body>
	<main>
		<header>
			<img calss="logo" src="img/imgmain/Logo.png">
		<nav id="menu">

				<ul class="menuUL">
				    <li class="texMenu"><a href="index.php">INICIO</a></li>
				    <li class="texMenu"><a href="#">ACERCA</a>
				      <ul class="submenu">
				        <li><a href="#">Nosotros</a></li>
				        <li><a href="#">Vision</a></li>
				        <li><a href="#">Mision</a></li>
				      </ul>
				    </li>
				    <li class="texMenu"><a href="#">CONTACTENOS</a></li>
				</ul>

		</nav>	
			
				
		</header>
		
	<div class="container_form">
                <form action="" method="post" class="form">
                <div class="cuadroLo">
                    <input type="text" class="inp" name="usuario" required="required" placeholder="usuario" value="<?php echo @$usuario; ?>">
                    <input type="password" class="inp" name="clave" required="required" placeholder="clave" value="<?php echo @$clave; ?>">
                    <input class="btn-login2" type="submit" value="ingresar">
                    <?php 

                    if ($_POST) {
                        if ($result) {
                        header('location: inicio_sistema.php');
                        }
                        else
                        {
                            echo "<br>";
                            echo "<style>.campo{border-color:crimson;}";
                            echo "</style>";
                            echo "<strong style='color:crimson;'>No eres un Usuario Registrado.</strong>";

                        }
                    }

                    ?>
                    </div>
                </form>
           </div>
		
		<footer class="foot">Copyright@ 2018 Freenet.</footer>
	</main>
    
</body>
</html>

