<?php 

	if(empty($_SESSION['active']))
	{
		header('location: ');
	}
 ?>

<link rel="stylesheet" href="../css/estilosEAheader.css">
		
<header>
		<div class="menu-btn">
    <i>&#9776;  &#128135; Javier Paredes Peluqueria & Make up&nbsp;&nbsp;&nbsp;</i>
     <a style="font-size: 16px; color:blue">   Quito, <?php echo fechaC(); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
     <img class="photouser" src="../imagenesJP/user.png" alt="Usuario">
     <span style="font-size: 16px; color:red" class="user"><?php echo $_SESSION['user'].' -'.$_SESSION['rol']; ?></span>
 
	
   </div>
   <div class="side-bar">
     <div class="close-btn">
       <i>&#88; </i>
     </div>
     <div class="menu">
       <div class="item"><a href="../../index.php"><i>&#128135;</i>Cerrar Sesión</a></div>
       <div class="item">
         <a class="sub-btn"><i>&#10051;</i>Ingresos<i class="fas dropdown">&#10148;</i></a>
         <div class="sub-menu">
           <a href="../ingresosJP/lista_clientes.php" class="sub-item">&#128587; Clientes</a>
           <a href="../ingresosJP/nueva_venta.php" class="sub-item">&#9989; Ventas</a>
           <a href="../ingresosJP/nueva_retencion.php" class="sub-item">&#9757; Retenciones</a>
           <a href="../ingresosJP/lista_ventas.php" class="sub-item">&#128209; Reporte de Ventas</a>
           <a href="../ingresosJP/lista_retencion.php" class="sub-item">&#128181; Reporte Retenciones</a>
        </div>
       </div>
       <div class="item">
         <a class="sub-btn"><i>&#10051;</i>Egresos<i class="fas dropdown">&#10148;</i></a>
         <div class="sub-menu">
         <a href="../egresosJP/lista_proveedor.php" class="sub-item">&#128129; Proveedores</a>
         <a href="../egresosJP/nueva_compra.php" class="sub-item">&#128717; Compras</a>
         <a href="../egresosJP/lista_compras.php" class="sub-item">&#128209; Reporte de Compras</a>
        </div>
       </div>
       <div class="item">
         <a class="sub-btn"><i>&#10051;</i>Empleados<i class="fas dropdown">&#10148;</i></a>
         <div class="sub-menu">
           <a href="#" class="sub-item">&#128106; Información</a>
           <a href="#" class="sub-item">&#128588; Descuentos</a>
           <a href="#" class="sub-item">&#128583; Nómina</a>
        </div>
       </div>
	   <div class="item">
         <a class="sub-btn"><i>&#10051;</i>Inventario<i class="fas dropdown">&#10148;</i></a>
         <div class="sub-menu">
           <a href="../inventarioJP/registro_producto.php" class="sub-item">&#128230; Nuevos Art.</a>
           <a href="../inventarioJP/lista_producto.php" class="sub-item">&#127857; Productos</a>
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

