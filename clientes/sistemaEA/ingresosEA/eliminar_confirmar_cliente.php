<?php 
	session_start();
	if($_SESSION['rol'] != 1/* en caso de habilitar al usuario con rol 2, poner: and $_SESSION['rol'] !=2 */)
	{
		header("location: ./");
	}
	include "../conexion.php";

	if(!empty($_POST))
	{
		if(empty($_POST['idcli']))
		{
			header("location: lista_clientes.php");
			mysqli_close($conection);	
		}
		
		$idcli = $_POST['idcli'];

		//$query_delete = mysqli_query($conection,"DELETE FROM usuario WHERE idusuario =$idusuario ");
		$query_delete = mysqli_query($conection,"UPDATE cliente SET estatus = 0 WHERE idcli = $idcli ");
		mysqli_close($conection);
		if($query_delete){
			header("location: lista_clientes.php");
		}else{
			echo "Error al eliminar";
		}

	}




	if(empty($_REQUEST['id']))
	{
		header("location: lista_clientes.php");
		mysqli_close($conection);
	}else{

		$idcli = $_REQUEST['id'];

		$query = mysqli_query($conection,"SELECT * FROM cliente WHERE idcli = $idcli ");
		mysqli_close($conection);
		$result = mysqli_num_rows($query);

		if($result > 0){
			while ($data = mysqli_fetch_array($query)) {
				# code...
				$idCliente = $data['idCliente'];
				$DenoCli = $data['DenoCli'];
			}
		}else{
			header("location: lista_clientes.php");
		}


	}


 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	
	<title>Eliminar Cliente EA</title>
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
			<p>Nombre del cliente: <span><?php echo $DenoCli; ?></span></p>
			<p>RUC Cédula Pasaporte: <span><?php echo $idCliente; ?></span></p>

			<form method="post" action="">
				<input type="hidden" name="idcli" value="<?php echo $idcli; ?>">
				<a href="lista_clientes.php" class="btn_cancel">Cancelar</a>
				<input type="submit" value="Eliminar" class="btn_ok">
			</form>
		</div>


	</section>
	<?php include "../../footer.php"; ?>
</body>
</html>