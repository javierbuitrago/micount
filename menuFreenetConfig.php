<div id="main">

	<header>
		<a href="#"><img id="logo" src="../img/imgmain/Logo.png"></a>
					
<div id="menu">
        <ul class="menu">
            
            <li><a href="../inicio_sistema.php"><img src="../img/iconta/inicio icon.png">Inicio</a></li>
            <li><a href="../ingresos/entradas.php"><img src="../img/iconta/ingresos icon.png">Ingresos</a>
                <ul class="submenu">
                    <li><a href="../ingresos/facturas.php">Facturas</a></li>
                    <li><a href="../ingresos/crearFactura.php">Nueva Factura</a></li>
                    <li><a href="../ingresos/facturas.php">Facturas recurrentes</a></li>
                    <li><a href="../ingresos/crearFactura.php">Pagos recibidos</a></li>
                    <li><a href="../ingresos/facturas.php">Notas de credito</a></li>
                    <li><a href="../ingresos/crearFactura.php">Cotizaciones</a></li>
                    <li><a href="../ingresos/facturas.php">Remisiones</a></li>
                    <li><a href="../ingresos/crearFactura.php">POS</a></li>
                    
                </ul>
            </li>
            
           
            <li><a href="../gastos.php"><img src="../img/iconta/gastos icon.png">Gastos</a>
                <ul class="submenu">
                    <li><a href="#">Pagos</a></li>
                    <li><a href="#">Facturas de Proveedores</a></li>
                    <li><a href="">Pagos recurrentes</a></li>
                    <li><a href="#">Notas debito</a></li>
                    <li><a href="facturas.php">Ordenes de compra</a></li>
                  
                </ul>
            </li>
              <li><a href="../contactos/contactos.php"><img src="../img/iconta/contactos icon.png">Contactos</a>
                <ul class="submenu">
                    <li><a href="../contactos/contactos.php">Contactos</a></li>
                    <li><a href="../contactos/crearContacto.php">Nuevo Contacto</a></li>
                    <li><a href="../contactos/clientes.php">Clientes</a></li>
                    <li><a href="../contactos/proveedores.php">Proveedores</a></li>
                    
                </ul>
           </li>
           
           <li><a href="../items/inventario.php"><img src="../img/iconta/inventario icon.png">Inventario</a>
                <ul class="submenu">
                    <li><a href="#">Items de venta</a></li>
                    <li><a href="#">Valor de Inventario</a></li>
                    <li><a href="#">Ajustes a Inventario</a></li>
                    <li><a href="#">Gestion de Items</a></li>
                    <li><a href="#">Lista de Precios</a></li>
                    <li><a href="#">Bodegas</a></li>

                </ul>
            </li>
            
           
           <li><a href="../finanzas.php"><img src="../img/iconta/banco icon.png">Bancos</a>
           
           </li>
           
           <li><a href="#"><img src="../img/iconta/categorias icon.png">Categorias</a>
                <ul class="submenu">
                    <li><a href="../categorias.php">Categorias</a></li>
                    <li><a href="../setCategorias.php">Ajustes de Categorias</a></li>
                                        
                </ul>
            </li>
            <li><a href="../perfil.php"><img id="irepor" src="../img/iconta/reportes icon.png">Reportes</a>
               <ul class="submenu">
                    <li><a href="../ventas.php">Ventas</a></li>
                    <li><a href="../ventas.php">Administrativos</a></li>
                    <li><a href="../mis_cotizaciones.php">Contables</a></li>
                    <li><a href="../ventas.php">Para Trabajar</a></li>
                    
                </ul>
           </li>
           <li><a href=""><img src="../img/iconta/configuracion icon.png">Configuracion</a>
                
                <ul class="submenu">

                    <li><a href="perfil.php">usuario: <?php if (@$_SESSION['usuario']) {
                        echo $_SESSION['usuario'];
                    }
                    else{echo "no identificado";} ?></a></li>
                    <li><a href="conf_fact.php">Facturacion</a></li>
                    <li><a href="conf_coti.php">Plantillas</a></li>
                    <li><a href="close.php">Impuestos</a></li>
                     <li><a href="conf_emp.php">Empresa</a></li>
                    <li><a href="conf_coti.php">Notificaciones y correos</a></li>
                    <li><a href="../config/close.php">Historial</a></li>
                     <li><a href="conf_fact.php">Integracion con apps</a></li>
                    <li><a href="conf_coti.php">Suscricion - planes</a></li>

                </ul>
           </li>
           
        </ul>
        
   </div>
				
					
	</header>
	<div class="session">Usuario : ADMIN <a href="config/close.php"><span class="btn-salir"> Salir </span></div></a>