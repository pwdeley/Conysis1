<?php 
	session_start();
	include "../conexion.php";



 ?>


<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	
	<title>Retenciones Recibidas EA</title>
	<link rel="icon" href="../imagenesEA/logoestratega.png" type="image/x">
	<link rel="stylesheet" href="../css/style.css">
	<script src="../css/jquery.min.js"></script>
	<script type="text/javascript" src="../css/functions.js"></script>

	<?php include "../../functions.php"; ?>

</head>
<body>
	
	<?php include "../header.php"; ?>
	<section id="container">
		
		<h1>&#128210; Listado de Retenciones</h1>
		<a href="nueva_retencion.php" class="btn_new">&#10133; Nueva Retención</a>
		
		<form action="buscar_retencion.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" placeholder="Número de Retención">
			<button type="submit" class="btn_search"><i>&#129488;</i></button>
		</form>

		<div>
			<h5>Buscar Retenciones por Fechas</h5>
			<form action="buscar_retencion.php" method="get" class="form_search_date">
				<label>De:  </label>
				<input type="date" name="fecha_de" id="fecha_de" required>
				<label>A:  </label>
				<input type="date" name="fecha_a" id="fecha_a" required>
				<button type="submit" class="btn_view"><i>&#129488;</i></button>
			</form>
		</div>

		<table>
			<tr>
			    <th>Retencion No.</th>
				<th>Fecha</th>
				<th>Agente de Retención</th>
				<th class="textright">Base Imponible</th>
                <th class="textright">Ret.IVA 70%</th>
                <th class="textright">Ret.Renta 2%</th>
                <th class="textright">Archivo</th>

			</tr>

		<?php 
			//Paginador
			$sql_registe = mysqli_query($conection,"SELECT COUNT(*) as total_registro FROM retenciones ");
			$result_register = mysqli_fetch_array($sql_registe);
			$total_registro = $result_register['total_registro'];

			$por_pagina = 30;

			if(empty($_GET['pagina']))
			{
				$pagina = 1;
			}else{
				$pagina = $_GET['pagina'];
			}

			$desde = ($pagina-1) * $por_pagina;
			$total_paginas = ceil($total_registro / $por_pagina);

    
            $query = mysqli_query($conection,"SELECT r.rucretencion,r.fechaemis,r.noretencion,r.autorizacionsri,r.baseimp,r.riva70,r.rir2,r.archivo,
              p.nombreprovee as proveedor
              FROM retenciones r
              INNER JOIN proveedor p
              ON r.rucretencion = p.rucproveedor
                
                ORDER BY r.fechaemis DESC LIMIT $desde,$por_pagina");

            mysqli_close($conection);

            $result = mysqli_num_rows($query);
            if ($result > 0){
                while ($data = mysqli_fetch_array($query)) {
                    if($data["noretencion"] != 0){
                        $estado = '<span class="pagada">Contado</span>';
                    }else{
                        $estado = '<span class="anulada">Crédito</span>';
                    }

        ?>

        <tr id="row_<?php echo $data["noretencion"]; ?>">
            <td><?php echo $data["noretencion"]; ?></td>
            <td><?php echo date_format(new DateTime($data["fechaemis"]),'d-m-Y'); ?></td>
            <td><?php echo $data["proveedor"]; ?></td>

            <td class="textright" id="subtotal"><span>$ </span><?php echo number_format(($data["baseimp"]), 2, ',', '.'); ?></td>
            <td class="textright" id="subtotal"><span>$ </span><?php echo number_format(($data["riva70"]), 2, ',', '.'); ?></td>
            <td class="textright" id="subtotal"><span>$ </span><?php echo number_format(($data["rir2"]), 2, ',', '.'); ?></td>
            <td><img src=" <?php echo $data["archivo"] ?>" width="50" height="50" alt="" srcset=""></td>


        </tr>
<?php

                }
            }
            ?>

        </table>
        <table>
            <tr>
                <th>Total Facturas:</th>
                <th><?php echo $total_registro; ?></th>

            </tr>


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