<?php 
if($_GET){
    require_once 'conexion/conexion.php';
    #consulta
    $sql_delete = "DELETE FROM cotizaciones WHERE id_cotizacion=$_GET[id_cotizacion]";
    $statement = $pdo->query($sql_delete);
    
    if($statement)
    {
        echo "
            <script>
                alert('Cotizacion Eliminada');
                location.href = ('mis_cotizaciones.php?delete=true');
            </script>
        ";
    }
    
}
?>