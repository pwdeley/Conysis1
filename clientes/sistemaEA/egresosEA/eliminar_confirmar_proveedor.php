<?php 
	session_start();
	if($_SESSION['rol'] != 1/* en caso de habilitar al usuario con rol 2, poner: and $_SESSION['rol'] !=2 */)
	{
		header("location: ./");
	}
	include "../conexion.php";

	if(!empty($_POST))
	{
		if(empty($_POST['rucproveedor']))
		{
			header("location: lista_proveedor.php");
			mysqli_close($conection);	
		}
		
		$rucproveedor = $_POST['rucproveedor'];

		//$query_delete = mysqli_query($conection,"DELETE FROM usuario WHERE idusuario =$idusuario ");
		$query_delete = mysqli_query($conection,"UPDATE proveedor SET estatus = 0 WHERE rucproveedor = $rucproveedor ");
		mysqli_close($conection);
		if($query_delete){
			header("location: lista_proveedor.php");
		}else{
			echo "Error al eliminar";
		}

	}




	if(empty($_REQUEST['id']))
	{
		header("location: lista_proveedor.php");
		mysqli_close($conection);
	}else{

		$rucproveedor = $_REQUEST['id'];

		$query = mysqli_query($conection,"SELECT * FROM proveedor WHERE rucproveedor = $rucproveedor ");
		mysqli_close($conection);
		$result = mysqli_num_rows($query);

		if($result > 0){
			while ($data = mysqli_fetch_array($query)) {
				# code...
				$rucproveedor = $data['rucproveedor'];
				$nombreprovee = $data['nombreprovee'];
			}
		}else{
			header("location: lista_proveedor.php");
		}


	}


 ?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	
	<title>Eliminar Proveedor EA</title>
	<link rel="icon" href="../imagenesJP/logoestratega.png" type="image/x">
	<link rel="stylesheet" href="../css/style.css">
	<script src="../css/jquery.min.js"></script>
	<script type="text/javascript" src="../css/functions.js"></script>

	<?php include "../../functions.php"; ?>

</head>
<body>
	<?php include "../header.php"; ?>
	<section id="container">
		<div class="data_delete">
			<h2>¿Está seguro de eliminar el siguiente registro?</h2>
			<p>Nombre del Proveedor: <span><?php echo $nombreprovee; ?></span></p>
			<p>RUC del Proveedor: <span><?php echo $rucproveedor; ?></span></p>

			<form method="post" action="">
				<input type="hidden" name="rucproveedor" value="<?php echo $rucproveedor; ?>">
				<a href="lista_proveedor.php" class="btn_cancel">Cancelar</a>
				<input type="submit" value="Eliminar" class="btn_ok">
			</form>
		</div>


	</section>
	<?php include "../../footer.php"; ?>
</body>
</html>