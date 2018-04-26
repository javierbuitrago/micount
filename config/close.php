<?php 

session_start();

$destruir=session_destroy();
if ($destruir) {
	header('location:../login.php');
}
?>