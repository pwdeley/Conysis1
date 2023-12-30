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
		if(empty($_POST['proveedor']) || empty($_POST['producto']) || empty($_POST['precio']) || empty($_POST['id']) || empty($_POST['foto_actual']) || empty($_POST['foto_remove']))
		{
			$alert='<p class="msg_error">Todos los campos son obligatorios / No se aceptan precios o cantidades negativas.</p>';
		}else{

			$codproducto= $_POST['id'];
			$proveedor 	= $_POST['proveedor'];
			$producto 	= $_POST['producto'];
			$precio 	= $_POST['precio'];
            $tipoIva 	= $_POST['tipoIva'];
			$imgProducto= $_POST['foto_actual'];
            $imgRemove	= $_POST['foto_remove'];

            $foto       = $_FILES['foto'];
            $nombre_foto= $foto['name'];
            $type       = $foto['type'];
            $url_temp   = $foto['tmp_name'];

            $upd = '';

            if($nombre_foto != '')
            {
                $destino = 'img/uploads/';
                $img_nombre = 'img_'.md5(date('d-m-Y H:m:s'));
                $imgProducto = $img_nombre.'.jpg';
                $src = $destino.$imgProducto;
            }else{
                if($_POST['foto_actual'] != $_POST['foto_remove']){
                    $imgProducto = 'img_producto.png';
                }

            }
			
			$query_update = mysqli_query($conection,"UPDATE producto
                                                    SET descripcion = '$producto',
                                                        proveedor   = $proveedor,
                                                        precio      = $precio,
                                                        tipoIva      = $tipoIva,
                                                        foto        = '$imgProducto'

													WHERE codproducto = $codproducto");
				if($query_update){

                    if(($nombre_foto != '' && ($_POST['foto_actual'] != 'img_producto.png')) || ($_POST['foto_actual'] != $_POST['foto_remove']))
                    {
                        unlink('img/uploads/' .$_POST['foto_actual']);
                    }

                    if($nombre_foto != '')
                    {
                        move_uploaded_file($url_temp,$src);
                    }
					$alert='<p class="msg_save">Producto actualizado correctamente.</p>';
				}else{
					$alert='<p class="msg_error">Error al actualizar el Producto.</p>';
				
			}
		}

	}

    //Validar Producto
    if(empty($_REQUEST['id'])){
        header("location: lista_producto.php");
    }else{
        $id_producto = $_REQUEST['id'];
        if(!is_numeric($id_producto)){
            header("location: lista_producto.php");
        }

        $query_producto = mysqli_query($conection,"SELECT p.codproducto,p.descripcion,p.precio,p.tipoIva,p.foto,pr.codproveedor,pr.proveedor 
                                                    FROM producto p 
                                                    INNER JOIN proveedor pr 
                                                    ON p.proveedor = pr.codproveedor 
                                                    WHERE p.codproducto = $id_producto AND p.estatus = 1");
        $result_producto = mysqli_num_rows($query_producto);

        $foto = '';
        $classRemove = 'notBlock';

        if($result_producto > 0 ){
            $data_producto = mysqli_fetch_assoc($query_producto);

            if($data_producto['foto'] != 'img_producto.png'){
                $classRemove = '';
                $foto = '<img id="img" src="img/uploads/'.$data_producto['foto'].'" alt="Producto">';
            }

            
        }else{
            header("location: lista_producto.php");
        }


    }
    

 ?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<title>Actualizar Producto EA</title>
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
			<h1>&#128181; Actualizar Producto EA</h1>
			<hr>
			<div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

			<form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $data_producto['codproducto']; ?>">
            <input type="hidden" id="foto_actual" name="foto_actual" value="<?php echo $data_producto['foto']; ?>">
            <input type="hidden" id="foto_remove" name="foto_remove" value="<?php echo $data_producto['foto']; ?>">

            	<label for="proveedor">Nombre del Proveedor</label>

               <?php
                $query_proveedor = mysqli_query($conection,"SELECT codproveedor, proveedor FROM proveedor 
                                                            WHERE estatus = 1 ORDER BY proveedor ASC"); 
                $result_proveedor = mysqli_num_rows($query_proveedor);
                mysqli_close($conection);
                ?>
                <select name="proveedor" id="proveedor" class="notItemOne">
                    <option value="<?php echo $data_producto['codproveedor']; ?>" selected><?php echo $data_producto['proveedor']; ?></option>

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
                <label for="producto">Producto</label>
				<input type="text" name="producto" id="producto" placeholder="Nombre del Producto" value="<?php echo $data_producto['descripcion']; ?>">
				<label for="precio">Precio</label>
				<input type="number" name="precio" id="precio" placeholder="Precio del Producto"  value="<?php echo $data_producto['precio']; ?>">
                <label for="tipoIva">Porcentaje de iva</label>
				<input type="radio" name="tipoIva" id="tipoIva" value="doce">IVA 12%
                <input type="radio" name="tipoIva" id="tipoIva" value="cero">IVA 0%

                <div class="photo">
	                <label for="foto">Foto</label>
                    <div class="prevPhoto">
                    <span class="delPhoto <?php echo $classRemove; ?>">X</span>
                    <label for="foto"></label>
                    <?php echo $foto; ?>
                </div>
                <div class="upimg">
                    <input type="file" name="foto" id="foto">
                </div>
                <div id="form_alert"></div>
                </div>

				<button type="submit" class="btn_save">&#128452; Actualizar Producto</button>

			</form>

		</div>

	</section>
	<?php include "../../../footer.php"; ?>
</body>
</html>