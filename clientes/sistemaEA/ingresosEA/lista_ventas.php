<?php 
	session_start();
	include "../conexion.php";



 ?>


<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	
	<title>Reporte Facturaci贸n EA</title>
	<link rel="icon" href="../imagenesEA/logoestratega.png" type="image/x">
	<link rel="stylesheet" href="../css/style.css">
	<script src="../css/jquery.min.js"></script>
	<script type="text/javascript" src="../css/functions.js"></script>

	<?php include "../../functions.php"; ?>

</head>
<body>
	
	<?php include "../header.php"; ?>
	<section id="container">
		
		<h1>&#128210; Listado de Ventas</h1>
		<a href="nueva_venta.php" class="btn_new">&#10133; Nueva Factura</a>
		
		<form action="buscar_venta.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" placeholder="N煤mero de Factura">
			<button type="submit" class="btn_search"><i>&#129488;</i></button>
		</form>

		<div>
			<h5>Buscar Facturas por Fechas</h5>
			<form action="buscar_venta.php" method="get" class="form_search_date">
				<label>De:  </label>
				<input type="date" name="fecha_de" id="fecha_de" required>
				<label>A:  </label>
				<input type="date" name="fecha_a" id="fecha_a" required>
				<button type="submit" class="btn_view"><i>&#129488;</i></button>
			</form>
		</div>

		<table>
			<tr>
			    <th>Factura No. 001-001</th>
				<th>Fecha</th>
				<th>Cliente</th>
                <th>Descripción</th>
                <th></th>
				<th class="textright">Subtotal Factura</th>
                <th>Estado</th>
                <th>Forma de Cobro</th>
				<th class="textright">Acciones</th>
			</tr>

		<?php 
			//Paginador
			$sql_registe = mysqli_query($conection,"SELECT COUNT(*) as total_registro FROM facturaV WHERE estatus != 10 ");
			$result_register = mysqli_fetch_array($sql_registe);
			$total_registro = $result_register['total_registro'];
        //echo $total_registro;
			$por_pagina = 20;

			if(empty($_GET['pagina']))
			{
				$pagina = 1;
			}else{
				$pagina = $_GET['pagina'];
			}

			$desde = ($pagina-1) * $por_pagina;
			$total_paginas = ceil($total_registro / $por_pagina);

    
            $query = mysqli_query($conection,"SELECT f.nofactura,f.fechaemis,f.precio1,f.cantidad1,
                                                        f.precio2,f.cantidad2,f.codcliente,
                                                        f.estatus,f.formacobro,f.codprod1,f.codprod2,
              cl.DenoCli as cliente
              FROM facturaV f
              INNER JOIN cliente cl
              ON f.codcliente = cl.idCliente
                WHERE f.estatus !=10
                ORDER BY f.nofactura DESC LIMIT $desde,$por_pagina");

            mysqli_close($conection);

            $result = mysqli_num_rows($query);
            if ($result > 0){
                while ($data = mysqli_fetch_array($query)) {
                    if($data["estatus"] == 1){
                        $estado = '<span class="pagada">Cobrada</span>';
                    }else{
                        $estado = '<span class="anulada">Anulada</span>';
                    }

        ?>
<!-- todo -->
        <tr id="row_<?php echo $data["nofactura"]; ?>">
            <td><?php echo $data["nofactura"]; ?></td>
            <td><?php echo date_format( new DateTime($data["fechaemis"]),'d-m-Y'); ?></td>
            <td><?php echo $data["cliente"]; ?></td>
            <td><?php
                if ($data["codprod1"] == 41) {
                    echo "Entrenamiento Formativo";
                }elseif ($data["codprod1"] == 42) {
                    echo "Implementos Deportivos";
                }elseif ($data["codprod1"] == 43) {
                    echo "Entradas Piscina";
                }elseif ($data["codprod1"] == 44) {
                    echo "Refrigerios";
                }elseif ($data["codprod1"] == 45) {
                    echo "Terapia Acuática";
                }
            ?></td>

            <td><?php
                if ($data["codprod2"] == 41) {
                    echo "Entrenamiento Formativo";
                }elseif ($data["codprod2"] == 42) {
                    echo "Implementos Deportivos";
                }elseif ($data["codprod2"] == 43) {
                    echo "Entradas Piscina";
                }elseif ($data["codprod2"] == 44) {
                    echo "Refrigerios";
                }elseif ($data["codprod2"] == 45) {
                    echo "Terapia Acuática";
                }




                ?></td>

            <td class="textright" id="subtotal"><span>$ </span><?php echo number_format(($data["precio1"]*$data["cantidad1"])
                + ($data["precio2"]*$data["cantidad2"]), 2, ',', '.'); ?></td>

            <td><?php echo $estado; ?></td>
            <?php
            if($data["formacobro"] == 'Tarjeta'){
                $formacobro = '<span class="EstiloTexto1">Tarjeta</span>';
            }else{
                $formacobro = '<span class="EstiloTexto">Efectivo</span>';
            }
            ?>
            <td><?php echo $formacobro; ?></td>

            <td>
                <div class="div_acciones">
                    <a class="link_edit" href="editar_factura.php?id=<?php echo $data["nofactura"]; ?>">&#128065; Editar</a>
                        |
                    <?php if($_SESSION['rol'] == 1 || $_SESSION['rol'] == 2){
                    if($data["estatus"] == 1)
                    {
                        ?>
                        <div class="div_factura">
                            <a class="link_delete" href="eliminar_confirmar_factura.php?id=<?php echo $data["nofactura"];
                            ?>">Eliminar &#128465;</a>
                        </div>
                    <?php }else{ ?>
                        <div class="div_factura">
                            <button type="button" class="btn_anular inactive"><i>&#128465;</i></button>
                        </div>
                    <?php }
                }

                ?>

                </div>

            </td>
        </tr>
<?php

                }
            }
            ?>

        </table>
        <table>
            <tr>
                <th>Total Facturas del año:</th>
                <th><?php echo $total_registro; ?></th>

            </tr>
<!--
            <tr>
                <th>Total Facturas:</th>  

                <th><?php



                     ?></th>

            </tr>
            -->
        </table>

	
		<div class="paginador">
			<ul>
			<?php

				if($pagina != 1)
				{
			 ?>
				<li><a href="?pagina=<?php echo 1; ?>">|<</a></li>
				<li><a href="?pagina=<?php echo $pagina-1; ?>"><<</a></li>
			<?php 
				}
				for ($i=1; $i <= $total_paginas; $i++) { 
					# code...
					if($i == $pagina)
					{
						echo '<li class="pageSelected">'.$i.'</li>';
					}else{
						echo '<li><a href="?pagina='.$i.'">'.$i.'</a></li>';
					}
				}

				if($pagina != $total_paginas)
				{
			 ?>
				<li><a href="?pagina=<?php echo $pagina + 1; ?>">>></a></li>
				<li><a href="?pagina=<?php echo $total_paginas; ?> ">>|</a></li>
			<?php } ?>
			</ul>
		</div>


	</section>
	<?php include "../../footer.php"; ?>
</body>

</html>