<?php

	if(empty($_SESSION['active']))
	{
		header('location: ');
	}
 ?>

<link rel="stylesheet" href="../css/estilosEAheader.css">

<header>
		<div class="menu-btn">
    <i>&#9776;  &#127946; EA GESTION DEPORTIVA&nbsp;&nbsp;&nbsp;</i>
     <a style="font-size: 16px; color:blue">   Quito, <?php echo fechaC(); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
     <a href="../notasEA.php" class="sub-item">&#128221;Notas</a>
     <img class="photouser" src="../imagenesEA/user.png" alt="Usuario">
     <span style="font-size: 16px; color:red" class="user"><?php echo $_SESSION['user'].' -'.$_SESSION['rol']; ?></span>

   </div>
   <div class="side-bar">
     <div class="close-btn">
       <i>&#88; </i>
     </div>
     <div class="menu">
       <div class="item"><a href="../../index.php"><i>&#127946;</i>Cerrar Sesión</a></div>
       <div class="item">
         <a class="sub-btn"><i>&#10051;</i>Ingresos<i class="fas dropdown">&#10148;</i></a>
         <div class="sub-menu">
           <a href="../ingresosEA/lista_clientes.php" class="sub-item">&#128587; Clientes</a>
           <a href="../ingresosEA/nueva_venta.php" class="sub-item">&#9989; Ventas</a>
           <a href="../ingresosEA/lista_ventas.php" class="sub-item">&#128209; Reporte de Ventas</a>
        </div>
       </div>
       <div class="item">
         <a class="sub-btn"><i>&#10051;</i>Egresos<i class="fas dropdown">&#10148;</i></a>
         <div class="sub-menu">
         <a href="../egresosEA/lista_proveedor.php" class="sub-item">&#128129; Proveedores</a>
           <a href="../egresosEA/nueva_compra.php" class="sub-item">&#128717; Compras</a>
           <a href="../egresosEA/lista_compras.php" class="sub-item">&#128209; Reporte de Compras</a>
        </div>
       </div>
       <div class="item">
         <a class="sub-btn"><i>&#10051;</i>Empleados<i class="fas dropdown">&#10148;</i></a>
         <div class="sub-menu">
           <a href="../nominaEA/lista_empleados.php" class="sub-item">&#128106; Lista</a>
           <a href="../nominaEA/afectaciones.php" class="sub-item">&#128588; Afectaciones</a>
           <!-- <a href="../nominaEA/nominaindividual.php" class="sub-item">&#128583; Individual</a> -->
           <a href="../nominaEA/nominageneral.php" class="sub-item">&#128583; General</a>
           <a href="../nominaEA/costonomina.php" class="sub-item">&#128583; Costo</a>
        </div>
       </div>
	  <!--
	   <div class="item">
         <a class="sub-btn"><i>&#10051;</i>Inventario<i class="fas dropdown">&#10148;</i></a>
         <div class="sub-menu">
           <a href="../inventarioEA/registro_producto.php" class="sub-item">&#128230; Nuevos Art.</a>
           <a href="../inventarioEA/lista_producto.php" class="sub-item">&#127857; Productos</a>
        </div>
       </div>
       -->
                <div class="item">
             <a class="sub-btn"><i>&#10051;</i>Estados Financieros<i class="fas dropdown">&#10148;</i></a>
             <div class="sub-menu">
                 <a href="../estfinEA/balance_general.php" class="sub-item">&#128215; Balance General</a>
                 <a href="../estfinEA/resultados.php" class="sub-item">&#128210; Resultados</a>
                 <a href="../estfinEA/movimiento_patrimonial.php" class="sub-item">&#128366; Mov. Patrim.</a>
                 <a href="../estfinEA/flujo_efectivo.php" class="sub-item">&#128214; Flujo Efectivo</a>
             </div>
         </div>
   </div>
   </div>

   <script type="text/javascript">
   $(document).ready(function(){
     //jquery for toggle sub menus
     $('.sub-btn').click(function(){
       $(this).next('.sub-menu').slideToggle();
       $(this).find('.dropdown').toggleClass('rotate');
     });

     //jquery for expand and collapse the sidebar
     $('.menu-btn').click(function(){
       $('.side-bar').addClass('active');
       $('.menu-btn').css("visibility", "hidden");
     });

     $('.close-btn').click(function(){
       $('.side-bar').removeClass('active');
       $('.menu-btn').css("visibility", "visible");
     });
   });
   </script>

</header>

