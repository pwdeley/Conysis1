<?php
	session_start();

    $conexion = mysqli_connect("162.241.60.169","estrat47_Admin","Pepito5824", "estrat47_sistemaJP");   

    $fechaemis  = $_POST["fechaemis"];
    $codigoprod1 = $_POST["txt_cod_producto1"];
    $codigoprod2 = $_POST["txt_cod_producto2"];
    //$nombreprod = $_POST["txt_descripcion"];
    $precioventa1 = $_POST["txt_precio1"];
    $precioventa2 = $_POST["txt_precio2"];
    $cantidadv1   = $_POST["txt_cant_producto1"];
    $cantidadv2   = $_POST["txt_cant_producto2"];
    $ruccliente = $_POST["nit_cliente"];
    $usuario_id = $_SESSION['idUser'];
    
//    if ( isset($_POST['txt_iva_total']) || isset($_POST['txt_precio_total']) )
  //  {
  //  $iva        = $_POST['txt_iva_total'];
  //  $subtotal   = $_POST['txt_precio_total'];
  //  }

    if($_FILES["archivo"]) {
        $nombre_base = basename($_FILES["archivo"]["name"]);
        $nombre_final = date("d-m-y"). "-". date("H-i-s"). "-" . $nombre_base;
        $ruta = "facturas/" . $nombre_final;
        $subirarchivo = move_uploaded_file($_FILES["archivo"]["tmp_name"], $ruta);
        if($subirarchivo){
            $insertarSQL = "INSERT INTO facturaV(usuario, codcliente, fechaemis, codprod1, codprod2, precio1, cantidad1, precio2, cantidad2, archivo)
            VALUES ('$usuario_id','$ruccliente','$fechaemis','$codigoprod1','$codigoprod2','$precioventa1','$cantidadv1','$precioventa2','$cantidadv2','$ruta')";
            $resultado = mysqli_query($conexion,$insertarSQL);
           
            if($resultado) {
                echo "<script>alert('Factura guardada con éxito'); window.location='nueva_venta.php'</script>";
            } else {
                printf("Errormessage: %s\n", mysqli_error($conexion));
            }
             
        }
    } else {
        echo "Error al subir el archivo, favor enviar mensaje a Estratega.";
    }

