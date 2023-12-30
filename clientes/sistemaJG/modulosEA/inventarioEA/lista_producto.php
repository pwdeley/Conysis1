<?php 
	session_start();
	include "../../conexion.php";	
 ?>


<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Lista de Productos EA</title>
	<link rel="icon" href="../../imagenesEA/logoestratega.png" type="image/x">
	<link rel="stylesheet" href="../../css/style.css">
	<script src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/functions.js"></script>

	<?php include "../../../functions.php"; ?>


</head>
<body>
	<?php include "header.php"; ?>
	<section id="container">
		
		<h1>&#128210;Lista de Productos o Servicios</h1>
		<a href="registro_producto.php" class="btn_new">&#10133; Crear Nuevos Productos</a>
		
		<form action="buscar_productos.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" placeholder="Buscar">
			<button type="submit" class="btn_search">&#128269; Buscar</button>
		</form>

		<table>
			<tr>
			    <th>Código</th>
                <th>Descripción</th>
                <th>Precio</th>
				<th>IVA</th>
			
                <th>Existencia</th>
				<th>
				<?php
               		$query_proveedor = mysqli_query($conection,"SELECT codproveedor, proveedor FROM proveedor 
                                                            WHERE estatus = 1 ORDER BY proveedor ASC"); 
                	$result_proveedor = mysqli_num_rows($query_proveedor);
               
                ?>
                <select name="proveedor" id="search_proveedor">
                	<?php
                    	if($result_proveedor > 0) 
						{
                        	while ($proveedor = mysqli_fetch_array($query_proveedor)) {
                            # code...
                	?> 
                    		<option value="<?php echo $proveedor['codproveedor']; ?>"><?php echo $proveedor['proveedor']; ?></option>
                	<?php
                    	    }
                    	}
                	?>
                </select>
								
				</th>
				<th>Foto</th>
				<th>Acciones</th>
			</tr>
		<?php 
			//Paginador
			$sql_registe = mysqli_query($conection,"SELECT COUNT(*) as total_registro FROM producto WHERE estatus = 1 ");
			$result_register = mysqli_fetch_array($sql_registe);
			$total_registro = $result_register['total_registro'];

			$por_pagina = 5;

			if(empty($_GET['pagina']))
			{
				$pagina = 1;
			}else{
				$pagina = $_GET['pagina'];
			}

			$desde = ($pagina-1) * $por_pagina;
			$total_paginas = ceil($total_registro / $por_pagina);

			$query = mysqli_query($conection,"SELECT p.codproducto, p.descripcion, p.precio, p.tipoIva,p.existencia, pr.proveedor, p.foto 
                                            FROM producto p
                                            INNER JOIN proveedor pr
                                            ON p.proveedor = pr.codproveedor
                                            WHERE p.estatus = 1 ORDER BY p.codproducto DESC LIMIT $desde,$por_pagina 
				");

			mysqli_close($conection);

			$result = mysqli_num_rows($query);
			if($result > 0){

				while ($data = mysqli_fetch_array($query)) {
                    if($data['foto'] != 'img_producto.png'){
                        $foto = 'img/uploads/'.$data['foto'];
                    }else{
                        $foto = 'img/'.$data['foto'];
                    }
					
			?>
				<tr>
                    <td><?php echo $data["codproducto"]; ?></td>
                    <td><?php echo $data["descripcion"]; ?></td>
                    <td><?php echo $data["precio"]; ?></td>
					<td><?php echo $data["tipoIva"]; ?></td>
                    <td><?php echo $data["existencia"]; ?></td>
					<td><?php echo $data["proveedor"]; ?></td>
					<td class="img_producto"><img src="<?php echo $foto; ?>" alt="<?php echo $data["descripcion"]; ?>"></td>

					<?php if($_SESSION['rol'] == 1 /*para incluir a usuarios rol 2 o 3 que puedan eliminar clientes: || $_SESSION['rol'] == 2  */){ ?>

					<td>
                        <a class="link_add add_product" product="<?php echo $data["codproducto"]; ?>" href="#">&#10133; Agregar</a>
                        |
						<a class="link_edit" href="editar_producto.php?id=<?php echo $data["codproducto"]; ?>">&#128221; Editar</a>
						|
						<a class="link_delete" href="eliminar_confirmar_producto.php?id=<?php echo $data["codproducto"]; ?>">&#128465; Eliminar</a>
				
                	</td>
                    <?php } ?>
                </tr>
			<?php 
				}

			}
		 ?>


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
	<?php include "../../../footer.php"; ?>
</body>
</html>