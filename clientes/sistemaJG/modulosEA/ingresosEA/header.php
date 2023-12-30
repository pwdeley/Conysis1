<?php 

	if(empty($_SESSION['active']))
	{
		header('location: ../../');
	}
 ?>

<link rel="stylesheet" href="../../css/estilosEAheader.css">
		
<header>
		<div class="menu-btn">
    <i>&#9776;  &#127946; EA GESTION DEPORTIVA&nbsp;&nbsp;&nbsp;</i>
     <a style="font-size: 16px; color:blue">   Quito, <?php echo fechaC(); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
     <img class="photouser" src="../../imagenesEA/user.png" alt="Usuario">
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
           <a href="lista_clientes.php" class="sub-item">&#128587; Clientes</a>
           <a href="nueva_venta.php" class="sub-item">&#9989; Ventas</a>
        </div>
       </div>
       <div class="item">
         <a class="sub-btn"><i>&#10051;</i>Egresos<i class="fas dropdown">&#10148;</i></a>
         <div class="sub-menu">
         <a href="../egresosEA/lista_proveedor.php" class="sub-item">&#128129; Proveedores</a>
           <a href="../egresosEA/nueva_compra.php" class="sub-item">&#128717; Compras</a>
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
           <a href="../inventarioEA/registro_producto.php" class="sub-item">&#128230; Nuevos Art.</a>
           <a href="../inventarioEA/lista_producto.php" class="sub-item">&#127857; Productos</a>
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

<div class="modal">
		<div class="bodyModal">
<!--		Formulario pasado a functions.js para pasar cualquier dato en html...

        <form action="" method="post" name="form_add_product" id="form_add_product" onsubmit="event.preventDefault(); sendDataProduct();">
				<h1><a style="font-size: 45pt;">&#128230;</a><br>Agregar Producto</h1><br>
				<h2 class="nameProducto"></h2><br>
				<input type="number" name="cantidad" id="txtCantidad" placeholder="Cantidad del Producto" required><br>
				<input type="text" name="precio" id="txtPrecio" placeholder="Precio del Producto" required>
				<input type="hidden" name="producto_id" id="producto_id" required>
				<input type="hidden" name="action" value="addProduct" required>
				<div class="alert alertAddProduct"></div>
				<button type="submit" class="btn_new"><a style="font-size: 10pt;">&#128229; </a>AGREGAR</button>
				<a href="#" class="btn_ok closeModal" style="font-size: 10pt" onclick="coloseModal();">&#128499; Cerrar</a>
			</form>
   -->

		</div>
	</div>