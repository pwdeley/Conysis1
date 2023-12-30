<?php 
	session_start();
	
	include "../conexion.php";

	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['rucproveedor']) || empty($_POST['nombreprovee']))
		{
			$alert='<p class="msg_error">Ruc y Razón Social son obligatorios.</p>';
		}else{

			$rucproveedor 	= $_POST['rucproveedor'];
			$nombreprovee 	= $_POST['nombreprovee'];
			$actividad 	= $_POST['actividad'];
			$direccion 	= $_POST['direccion'];
			$usuario_id	= $_SESSION['idUser'];
			
			$result = 0;

			if(is_numeric($rucproveedor))
			{
				$query = mysqli_query($conection,"SELECT * FROM proveedor WHERE rucproveedor = '$rucproveedor' ");
				$result = mysqli_fetch_array($query);
			}
			if($result > 0){
				$alert='<p class="msg_error">El RUC ya existe.</p>';
			}else{

				$query_insert = mysqli_query($conection,"INSERT INTO proveedor(rucproveedor,nombreprovee,actividad,direccion,usuario_id)
																	VALUES('$rucproveedor','$nombreprovee','$actividad','$direccion','$usuario_id')");
				if($query_insert){
					$alert='<p class="msg_save">Proveedor creado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al crear el Proveedor.</p>';
				}
			}
		}
		mysqli_close($conection);
	}

 ?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	
	<title>Registro Proveedor EA</title>
	 <link rel="icon" href="../imagenesEA/logoestratega.png" type="image/x">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../css/jquery.min.js"></script>
    <script type="text/javascript" src="../css/functions.js"></script>
    
   
    <?php include "../../functions.php"; ?>


</head>
<body>
	<?php include "../header.php"; ?>
	<section id="container">
		
		<div class="form_register">
			<h1>&#129299;Registro Proveedor</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post">
				<label for="rucproveedor">RUC Proveedor</label>
				<input type="text" name="rucproveedor" id="rucproveedor" placeholder="Aquí el número de Ruc del proveedor">
				<label for="nombreprovee">Razón social del proveedor</label>
				<input type="text" name="nombreprovee" id="nombreprovee" placeholder="Aquí los nombres completos del proveedor">
				<label for="actividad">Actividad Económica</label>
				<input type="text" name="actividad" id="actividad" placeholder="¿A qué se dedica el proveedor?">
				<label for="direccion">Dirección</label>
				<input type="text" name="direccion" id="direccion" placeholder="Aquí la dirección del local donde se efectuó la compra">
				<button type="submit" class="btn_save">&#128452;Guardar Proveedor</button>

			</form>

		</div>

	</section>
	<?php include "../../footer.php"; ?>
</body>
</html>