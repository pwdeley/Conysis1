<?php 
	
	session_start();

	include "../../conexion.php";

	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['idCliente']) || empty($_POST['DenoCli']))
		{
			$alert='<p class="msg_error">RUC Cédula Pasaporte y Nombres son obligatorios.</p>';
		}else{

			$idcli 		= $_POST['id'];
			$idCliente 	= $_POST['idCliente'];
			$DenoCli 	= $_POST['DenoCli'];
			$email  	= $_POST['correo'];
			$telefono   = $_POST['telefono'];
			$direccion  = $_POST['direccion'];
			
			$result = 0;

			if(is_numeric($idCliente) and $idCliente !=0)
			{
			$query = mysqli_query($conection,"SELECT * FROM cliente
													   WHERE (idCliente = '$idCliente' AND idcli != $idcli)");
			$result = mysqli_fetch_array($query);
			$result = count($result);										   
			}
			
			if($result > 0){
				$alert='<p class="msg_error">El RUC Cédula Pasaporte ingresado ya existe.</p>';
			}else{

				if($idCliente == '')
				{
					$idCliente = 0;
				}
					$sql_update = mysqli_query($conection,"UPDATE cliente
															SET idCliente = $idCliente, DenoCli='$DenoCli', correo='$email', telefono='$telefono',direccion='$direccion'
															WHERE idcli= $idcli ");
					if($sql_update){
					$alert='<p class="msg_save">Cliente actualizado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al actualizar el Cliente.</p>';
				}

			}


		}

	}

	//Mostrar Datos
	if(empty($_REQUEST['id']))
	{
		header('Location: lista_clientes.php');
		mysqli_close($conection);
	}
	$idcli = $_REQUEST['id'];

	$sql= mysqli_query($conection,"SELECT * FROM cliente WHERE idcli= $idcli and estatus = 1 ");
									
	mysqli_close($conection);
	$result_sql = mysqli_num_rows($sql);

	if($result_sql == 0){
		header('Location: lista_clientes.php');
	}else{
		
		while ($data = mysqli_fetch_array($sql)) {
			# code...
			$idcli  	= $data['idcli'];
			$idCliente  = $data['idCliente'];
			$DenoCli  	= $data['DenoCli'];
			$correo  	= $data['correo'];
			$telefono 	= $data['telefono'];
			$direccion  = $data['direccion'];
		}
	}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	
	<title>Actualizar Cliente EA</title>
	<link rel="icon" href="../../imagenesEA/logoestratega.png" type="image/x">
	<link rel="stylesheet" href="../../css/style.css">
	<script src="../inventarioEA/js/jquery.min.js"></script>
	<script type="text/javascript" src="../inventarioEA/js/functions.js"></script>


</head>
<body>
<?php include "header.php"; ?>
	<section id="container">
		
		<div class="form_register">
			<h1>Actualizar cliente</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post">
				<input type="hidden" name="id" value="<?php echo $idcli; ?>">
				<label for="idCliente">RUC Cédula o Pasaporte</label>
				<input type="text" name="idCliente" id="idCliente" placeholder="Ruc Cédula o Pasaporte" value="<?php echo $idCliente; ?>">
				<label for="DenoCli">Nombres</label>
				<input type="text" name="DenoCli" id="DenoCli" placeholder="Nombres completos" value="<?php echo $DenoCli; ?>">
				<label for="correo">Correo electrónico</label>
				<input type="email" name="correo" id="correo" placeholder="Correo electrónico" value="<?php echo $correo; ?>">
				<label for="telefono">Teléfono</label>
				<input type="number" name="telefono" id="telefono" placeholder="Teléfono" value="<?php echo $telefono; ?>">
				<label for="direccion">Dirección</label>
				<input type="texto" name="direccion" id="direccion" placeholder="Dirección" value="<?php echo $direccion; ?>">
				<input type="submit" value="Actualizar Cliente" class="btn_save">

			</form>


		</div>


	</section>
	<?php include "../../../footer.php"; ?>
</body>
</html>