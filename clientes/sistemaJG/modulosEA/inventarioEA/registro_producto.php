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
		if(empty($_POST['proveedor']) || empty($_POST['producto']) || empty($_POST['precio']) || $_POST['precio'] <= 0 || empty($_POST['cantidad'] || $_POST['cantidad'] <= 0))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios / No se aceptan precios o cantidades negativas.</p>';
		}else{

			$proveedor 	= $_POST['proveedor'];
			$producto 	= $_POST['producto'];
			$precio 	= $_POST['precio'];
            $tipoIva 	= $_POST['tipoIva'];
			$cantidad 	= $_POST['cantidad'];
			$usuario_id	= $_SESSION['idUser'];

            $foto = $_FILES['foto'];
            $nombre_foto = $foto['name'];
            $type   = $foto['type'];
            $url_temp = $foto['tmp_name'];

            $imgProducto = 'img_producto.png';

            if($nombre_foto != '')
            {
                $destino = 'img/uploads/';
                $img_nombre = 'img_'.md5(date('d-m-Y H:m:s'));
                $imgProducto = $img_nombre.'.jpg';
                $src = $destino.$imgProducto;
            }
			
			$query_insert = mysqli_query($conection,"INSERT INTO producto(proveedor,descripcion,precio,tipoIva,existencia,usuario_id,foto)
																	VALUES('$proveedor','$producto','$precio','$tipoIva','$cantidad','$usuario_id','$imgProducto')");
				if($query_insert){
                    if($nombre_foto != '')
                    {
                        move_uploaded_file($url_temp,$src);
                    }
					$alert='<p class="msg_save">Producto creado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al crear el Producto.</p>';
				
			}
		}

	}

 ?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Registro Producto EA</title>
    <link rel="icon" href="../../imagenesEA/logoestratega.png" type="image/x">
	<link rel="stylesheet" href="../../css/style.css">
	<script src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/functions.js"></script>

	<?php include "../../../functions.php"; ?>


</head>
<body>
	<?php include "header.php"; ?>
	<section id="container">
		
		<div class="form_register">
			<h1>&#128181; Registro Producto EA</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post" enctype="multipart/form-data">
            
            	<label for="proveedor">Nombre del Proveedor</label>

               <?php
                $query_proveedor = mysqli_query($conection,"SELECT codproveedor, proveedor FROM proveedor 
                                                            WHERE estatus = 1 ORDER BY proveedor ASC"); 
                $result_proveedor = mysqli_num_rows($query_proveedor);
                mysqli_close($conection);
                ?>
                <select name="proveedor" id="proveedor">
                <?php
                    if($result_proveedor > 0) {
                        while ($proveedor = mysqli_fetch_array($query_proveedor)) {
                            # code...
                ?> 
                    <option value="<?php echo $proveedor['codproveedor']; ?>"><?php echo $proveedor['proveedor']; ?>
                    </option>
                <?php
                        }
                    }
                ?>
                </select>
                <label for="producto">Producto o Servicio</label>
				<input type="text" name="producto" id="producto" placeholder="Nombre del Producto">
				<label for="precio">Precio</label>
				<input type="number" name="precio" id="precio" placeholder="Precio del Producto">
				<label for="cantidad">Cantidad</label>
				<input type="number" name="cantidad" id="cantidad" placeholder="Cantidad del producto">
                <label for="tipoIva">Porcentaje de iva</label>
				<input type="radio" name="tipoIva" id="tipoIva" value="12">IVA 12%
                <input type="radio" name="tipoIva" id="tipoIva" value="0">IVA 0%

                <div class="photo">
	                <label for="foto">Foto</label>
                    <div class="prevPhoto">
                    <span class="delPhoto notBlock">X</span>
                    <label for="foto"></label>
                </div>
                <div class="upimg">
                    <input type="file" name="foto" id="foto">
                </div>
                <div id="form_alert"></div>
                </div>

				<button type="submit" class="btn_save">&#128452;Guardar Producto</button>

			</form>

		</div>

	</section>
	<?php include "../../../footer.php"; ?>
</body>
</html>