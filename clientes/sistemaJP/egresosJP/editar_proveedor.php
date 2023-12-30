<?php 
	
	session_start();

	include "../conexion.php";

	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['rucproveedor']) || empty($_POST['nombreprovee']))
		{
			$alert='<p class="msg_error">RUC y Razón Social son obligatorios.</p>';
		}else{


			$rucproveedor 	= $_POST['rucproveedor'];
			$nombreprovee 	= $_POST['nombreprovee'];
            $actividad 	= $_POST['actividad'];
			$direccion  = $_POST['direccion'];
            $usuario_id	= $_SESSION['idUser'];

			$result = 0;

			if(is_numeric($rucproveedor) and $rucproveedor !=0)
			{
			$query = mysqli_query($conection,"SELECT * FROM proveedor
													   WHERE (rucproveedor = '$rucproveedor' AND rucproveedor != $rucproveedor)");
			$result = mysqli_fetch_array($query);
			$result = count($result);										   
			}
			
			if($result > 0){
				$alert='<p class="msg_error">El RUC ingresado ya existe.</p>';
			}else{

				if($rucproveedor == '')
				{
					$rucproveedor = 0;
				}
					$sql_update = mysqli_query($conection,"UPDATE proveedor
															SET rucproveedor = $rucproveedor, nombreprovee='$nombreprovee', actividad='$actividad',direccion='$direccion'
															WHERE rucproveedor= $rucproveedor ");
					if($sql_update){
					$alert='<p class="msg_save">Proveedor actualizado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al actualizar el Proveedor.</p>';
				}

			}


		}

	}

	//Mostrar Datos
	if(empty($_REQUEST['id']))
	{
		header('Location: lista_proveedor.php');
		mysqli_close($conection);
	}
	$rucproveedor = $_REQUEST['id'];

	$sql= mysqli_query($conection,"SELECT * FROM proveedor WHERE rucproveedor= $rucproveedor and estatus = 1 ");
									
	mysqli_close($conection);
	$result_sql = mysqli_num_rows($sql);

	if($result_sql == 0){
		header('Location: lista_proveedor.php');
	}else{
		
		while ($data = mysqli_fetch_array($sql)) {
			# code...
			$rucproveedor  	= $data['rucproveedor'];
			$rucproveedor  = $data['rucproveedor'];
			$nombreprovee  	= $data['nombreprovee'];
			$actividad  = $data['actividad'];
			$direccion  = $data['direccion'];
		}
	}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">

	<title>Actualizar Proveedor EA</title>
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
			<h1>Actualizar Proveedor</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post">
				<input type="hidden" name="id" value="<?php echo $rucproveedor; ?>">
				<label for="rucproveedor">RUC Proveedor</label>
				<input type="text" name="rucproveedor" id="rucproveedor" placeholder="Aquí el número de Ruc del proveedor" value="<?php echo $rucproveedor; ?>">
				<label for="nombreprovee">Razón social del Proveedor</label>
				<input type="text" name="nombreprovee" id="nombreprovee" placeholder="Aquí los nombres completos del proveedor" value="<?php echo $nombreprovee; ?>">
				<label for="correo">Actividad Económica</label>
				<input type="text" name="actividad" id="actividad" placeholder="¿A qué se dedica el proveedor?" value="<?php echo $actividad; ?>">
				<label for="direccion">Dirección</label>
				<input type="texto" name="direccion" id="direccion" placeholder="Aquí la dirección del local donde se efectuó la compra" value="<?php echo $direccion; ?>">
				<input type="submit" value="Actualizar Proveedor" class="btn_save">

			</form>


		</div>


	</section>
	<?php include "../../footer.php"; ?>
</body>
</html>