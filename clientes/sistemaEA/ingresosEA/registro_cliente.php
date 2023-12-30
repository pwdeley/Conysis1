<?php 
	session_start();
	
	include "../conexion.php";

	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['idCliente']) || empty($_POST['DenoCli']))
		{
			$alert='<p class="msg_error">Ruc/Cédula/Pasaporte y Nombres son obligatorios.</p>';
		}else{

			$idCliente 	= $_POST['idCliente'];
			$DenoCli 	= $_POST['DenoCli'];
			$correo 	= $_POST['correo'];
			$telefono 	= $_POST['telefono'];
			$direccion 	= $_POST['direccion'];
			$usuario_id	= $_SESSION['idUser'];
			
			$result = 0;

			if(is_numeric($idCliente))
			{
				$query = mysqli_query($conection,"SELECT * FROM cliente WHERE idCliente = '$idCliente' ");
				$result = mysqli_fetch_array($query);
			}
			if($result > 0){
				$alert='<p class="msg_error">El RUC Cédula o Pasaporte ya existe.</p>';
			}else{

				$query_insert = mysqli_query($conection,"INSERT INTO cliente(idCliente,DenoCli,correo,telefono,direccion,usuario_id)
																	VALUES('$idCliente','$DenoCli','$correo','$telefono','$direccion','$usuario_id')");
				if($query_insert){
					$alert='<p class="msg_save">Cliente creado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al crear el Cliente.</p>';
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
	
	<title>Registro Cliente EA</title>
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
			<h1>&#129299;Registro Cliente</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post">
				<label for="idCliente">RUC Cédula o Pasaporte</label>
				<input type="text" name="idCliente" id="idCliente" placeholder="Ruc Cédula o Pasaporte">
				<label for="DenoCli">Nombres</label>
				<input type="text" name="DenoCli" id="DenoCli" placeholder="Nombres completos">
				<label for="correo">Correo electrónico</label>
				<input type="email" name="correo" id="correo" placeholder="Correo electrónico">
				<label for="telefono">Teléfono</label>
				<input type="number" name="telefono" id="telefono" placeholder="Teléfono">
				<label for="direccion">Dirección</label>
				<input type="text" name="direccion" id="direccion" placeholder="Dirección">
				<button type="submit" class="btn_save">&#128452;Guardar Cliente</button>

			</form>

		</div>

	</section>
	<?php include "includes/footer.php"; ?>
</body>
</html>