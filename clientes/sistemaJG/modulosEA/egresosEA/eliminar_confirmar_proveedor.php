<?php 
	session_start();
	if($_SESSION['rol'] != 1/* en caso de habilitar al usuario con rol 2, poner: and $_SESSION['rol'] !=2 */)
	{
		header("location: ./");
	}
	include "../../conexion.php";

	if(!empty($_POST))
	{
		if(empty($_POST['idproveedor']))
		{
			header("location: lista_proveedor.php");
			mysqli_close($conection);	
		}
		
		$idproveedor = $_POST['idproveedor'];

		//$query_delete = mysqli_query($conection,"DELETE FROM usuario WHERE idusuario =$idusuario ");
		$query_delete = mysqli_query($conection,"UPDATE proveedor SET estatus = 0 WHERE codproveedor = $idproveedor ");
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

		$idproveedor = $_REQUEST['id'];

		$query = mysqli_query($conection,"SELECT * FROM proveedor WHERE codproveedor = $idproveedor ");
		mysqli_close($conection);
		$result = mysqli_num_rows($query);

		if($result > 0){
			while ($data = mysqli_fetch_array($query)) {
				# code...
				$IdProv = $data['IdProv'];  /*Opcional*/
				$proveedor = $data['proveedor'];
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
	<link rel="stylesheet" href="../../css/style.css">
	<script src="../inventarioEA/js/jquery.min.js"></script>
	<script type="text/javascript" src="../inventarioEA/js/functions.js"></script>

	<?php include "../../../functions.php"; ?>

</head>
<body>
	<?php include "header.php"; ?>
	<section id="container">
		<div class="data_delete">
            <a style="color: red; font-size: 80px">.&#128695;.</a>
			<h2>¿Está seguro de eliminar el siguiente registro?</h2>
			<p>Nombre del Proveedor: <span><?php echo $proveedor; ?></span></p>
			<p>RUC o Cédula: <span><?php echo $IdProv; ?></span></p>

			<form method="post" action="">
				<input type="hidden" name="idproveedor" value="<?php echo $idproveedor; ?>">
				<a href="lista_proveedor.php" class="btn_cancel">&#128683; Cancelar</a>
				<button type="submit" class="btn_ok">&#128465; Eliminar</button>
			</form>
		</div>


	</section>
	<?php include "../../../footer.php"; ?>
</body>
</html>