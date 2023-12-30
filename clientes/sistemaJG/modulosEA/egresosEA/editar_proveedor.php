<?php 
	
    session_start();
    if($_SESSION['rol'] != 1 and $_SESSION['rol'] !=2)
{
    header("location: ./");
}

	include "../../conexion.php";

	if(!empty($_POST))
	{
		$alert='';
		if(empty($_POST['IdProv']) || empty($_POST['proveedor']))
		{
			$alert='<p class="msg_error">RUC Cédula Pasaporte y Nombres son obligatorios.</p>';
		}else{

			$idproveedor = $_POST['id'];
			$IdProv 	= $_POST['IdProv'];
			$proveedor 	= $_POST['proveedor'];
			$email  	= $_POST['correo'];
			$telefono   = $_POST['telefono'];
			$direccion  = $_POST['direccion'];
			
			$sql_update = mysqli_query($conection,"UPDATE proveedor
															SET IdProv = $IdProv, proveedor='$proveedor', correo='$email', telefono='$telefono',direccion='$direccion'
															WHERE codproveedor= $idproveedor ");
				if($sql_update){
					$alert='<p class="msg_save">Proveedor actualizado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al actualizar el Proveedor.</p>';
				}

			}


		}

	

	//Mostrar Datos
	if(empty($_REQUEST['id']))
	{
		header('Location: lista_proveedor.php');
		mysqli_close($conection);
	}
	$idproveedor = $_REQUEST['id'];

	$sql= mysqli_query($conection,"SELECT * FROM proveedor WHERE codproveedor= $idproveedor and estatus = 1 ");
									
	mysqli_close($conection);
	$result_sql = mysqli_num_rows($sql);

	if($result_sql == 0){
		header('Location: lista_proveedor.php');
	}else{
		
		while ($data = mysqli_fetch_array($sql)) {
			# code...
			$idproveedor = $data['codproveedor'];
			$IdProv     = $data['IdProv'];
			$proveedor 	= $data['proveedor'];
			$correo  	= $data['correo'];
			$telefono 	= $data['telefono'];
			$direccion  = $data['direccion'];
		}
	}

 ?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">

	<title>Actualizar Proveedor EA</title>
	<link rel="stylesheet" href="../../css/style.css">
	<script src="../inventarioEA/js/jquery.min.js"></script>
	<script type="text/javascript" src="../inventarioEA/js/functions.js"></script>

	<?php include "../../../functions.php"; ?>

</head>
<body>
	<?php include "header.php"; ?>
	<section id="container">
		
		<div class="form_register">
			<h1>&#128214; Actualizar Proveedor</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post">
                <input type="hidden" name="id" value="<?php echo $idproveedor ?>">
				<label for="IdProv">RUC Cédula o Pasaporte</label>
				<input type="text" name="IdProv" id="IdProv" placeholder="Ruc Cédula o Pasaporte Proveedor"
                    value="<?php echo $IdProv ?>">
				<label for="proveedor">Nombre del Proveedor</label>
				<input type="text" name="proveedor" id="proveedor" placeholder="Nombre del Proveedor"
                    value="<?php echo $proveedor ?>">
				<label for="correo">Correo electrónico</label>
				<input type="email" name="correo" id="correo" placeholder="Correo electrónico"
                    value="<?php echo $correo ?>">
				<label for="telefono">Teléfono</label>
				<input type="number" name="telefono" id="telefono" placeholder="Teléfono"
                    value="<?php echo $telefono ?>">
				<label for="direccion">Dirección</label>
				<input type="texto" name="direccion" id="direccion" placeholder="Dirección"
                    value="<?php echo $direccion ?>">
				<button type="submit" class="btn_save">&#128452; Actualizar Proveedor</button>

			</form>


		</div>


	</section>
	<?php include "../../../footer.php"; ?>
</body>
</html>