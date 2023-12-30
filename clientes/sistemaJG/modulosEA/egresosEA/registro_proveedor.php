<?php 
	session_start();
	
	if($_SESSION['rol'] != 1 and $_SESSION['rol'] != 2)
    {
        header("location: ./");
    }
         
    include "../../conexion.php";

	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['IdProv']) || empty($_POST['proveedor']))
		{
			$alert='<p class="msg_error">Ruc/Cédula/Pasaporte y Nombres son obligatorios.</p>';
		}else{

			$IdProv 	= $_POST['IdProv'];
			$proveedor 	= $_POST['proveedor'];
			$correo 	= $_POST['correo'];
			$telefono 	= $_POST['telefono'];
			$direccion 	= $_POST['direccion'];
			$usuario_id	= $_SESSION['idUser'];
			
			$query_insert = mysqli_query($conection,"INSERT INTO proveedor(IdProv,proveedor,correo,telefono,direccion,usuario_id)
																	VALUES('$IdProv','$proveedor','$correo','$telefono','$direccion','$usuario_id')");
				if($query_insert){
					$alert='<p class="msg_save">Proveedor creado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al guardar el Proveedor.</p>';
				
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
	<link rel="icon" href="../../imagenesEA/logoestratega.png" type="image/x">
	<link rel="stylesheet" href="../../css/style.css">
	<script src="../inventarioEA/js/jquery.min.js"></script>
	<script type="text/javascript" src="../inventarioEA/js/functions.js"></script>

	<?php include "../../../functions.php"; ?>

</head>
<body>
	<?php include "header.php"; ?>
	<section id="container">
		
		<div class="form_register">
			<h1>&#128589;Registro Proveedor EA</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post">
				<label for="IdProv">RUC Cédula o Pasaporte</label>
				<input type="text" name="IdProv" id="IdProv" placeholder="Ruc Cédula o Pasaporte">
				<label for="proveedor">Nombre del Proveedor</label>
				<input type="text" name="proveedor" id="proveedor" placeholder="Nombre del Proveedor">
				<label for="correo">Correo electrónico</label>
				<input type="email" name="correo" id="correo" placeholder="Correo electrónico">
				<label for="telefono">Teléfono</label>
				<input type="number" name="telefono" id="telefono" placeholder="Teléfono">
				<label for="direccion">Dirección</label>
				<input type="text" name="direccion" id="direccion" placeholder="Dirección">
				<button type="submit" class="btn_save">&#128452;Guardar Proveedor</button>

			</form>

		</div>

	</section>
	<?php include "../../../footer.php"; ?>
</body>
</html>