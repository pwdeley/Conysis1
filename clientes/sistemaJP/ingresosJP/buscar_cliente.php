<?php 
	session_start();
	include "../conexion.php";	

 ?>


<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	
	<title>Lista de clientes JP</title>
     <link rel="icon" href="../imagenesJP/logoestratega.png" type="image/x">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../css/jquery.min.js"></script>
    <script type="text/javascript" src="../css/functions.js"></script>
    
   
    <?php include "../../functions.php"; ?>


</head>
<body>
	<?php include "../header.php"; ?>
	<section id="container">
		<?php 

			$busqueda = strtolower($_REQUEST['busqueda']);
			if(empty($busqueda))
			{
				header("location: lista_clientes.php");
				mysqli_close($conection);
			}


		 ?>
		
		<h1>Lista de clientes</h1>
		<a href="registro_cliente.php" class="btn_new" target="_blank">Crear cliente</a>
		
		<form action="buscar_cliente.php" method="get" class="form_search">
			<input type="text" name="busqueda" id="busqueda" placeholder="Buscar" value="<?php echo $busqueda; ?>">
			<input type="submit" value="Buscar" class="btn_search">
		</form>

		<table>
			<tr>
				<th>ID</th>
				<th>RUC Cédula Pasaporte</th>
				<th>Razón Social</th>
				<th>Fecha de Creación</th>
				<th>Acciones</th>
			</tr>
		<?php 
			//Paginador
				$sql_registe = mysqli_query($conection,"SELECT COUNT(*) as total_registro FROM cliente 
																WHERE ( idcli LIKE '%$busqueda%' OR 
																		idCliente LIKE '%$busqueda%' OR 
																		DenoCli LIKE '%$busqueda%' OR 
																		dateadd LIKE '%$busqueda%') 
																AND estatus = 1  ");

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

			$query = mysqli_query($conection,"SELECT * FROM cliente WHERE 
										( idcli LIKE '%$busqueda%' OR 
											idCliente LIKE '%$busqueda%' OR 
											DenoCli LIKE '%$busqueda%' OR 
											dateadd LIKE '%$busqueda%' ) 
										AND
										estatus = 1 ORDER BY idcli ASC LIMIT $desde,$por_pagina 
				");
			mysqli_close($conection);
			$result = mysqli_num_rows($query);
			if($result > 0){

				while ($data = mysqli_fetch_array($query)) {
					
			?>
				<tr>
					<td><?php echo $data["idcli"]; ?></td>
                    <td><?php echo $data["idCliente"]; ?></td>
					<td><?php echo $data["DenoCli"]; ?></td>
					<td><?php echo $data["dateadd"]; ?></td>
					<td>
						<a class="link_edit" href="editar_cliente.php?id=<?php echo $data["idcli"]; ?>">Editar</a>

					<?php if($_SESSION['rol'] == 1/* || $_SESSION['rol'] == 2*/){ ?>
						|
						<a class="link_delete" href="eliminar_confirmar_cliente.php?id=<?php echo $data["idcli"]; ?>">Eliminar</a>
					<?php } ?>
						
					</td>
				</tr>
			
		<?php 
				}

			}
		 ?>


		</table>
<?php 
	
	if($total_registro != 0)
	{
 ?>
		<div class="paginador">
			<ul>
			<?php 
				if($pagina != 1)
				{
			 ?>
				<li><a href="?pagina=<?php echo 1; ?>&busqueda=<?php echo $busqueda; ?>">|<</a></li>
				<li><a href="?pagina=<?php echo $pagina-1; ?>&busqueda=<?php echo $busqueda; ?>"><<</a></li>
			<?php 
				}
				for ($i=1; $i <= $total_paginas; $i++) { 
					# code...
					if($i == $pagina)
					{
						echo '<li class="pageSelected">'.$i.'</li>';
					}else{
						echo '<li><a href="?pagina='.$i.'&busqueda='.$busqueda.'">'.$i.'</a></li>';
					}
				}

				if($pagina != $total_paginas)
				{
			 ?>
				<li><a href="?pagina=<?php echo $pagina + 1; ?>&busqueda=<?php echo $busqueda; ?>">>></a></li>
				<li><a href="?pagina=<?php echo $total_paginas; ?>&busqueda=<?php echo $busqueda; ?> ">>|</a></li>
			<?php } ?>
			</ul>
		</div>
<?php } ?>


	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>