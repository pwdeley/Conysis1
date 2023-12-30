<?php
	session_start();

    $conexion = mysqli_connect("localhost","estratega","Pepito5824", "actualizacion");
	//$conexion = mysqli_connect("localhost","root","", "estrat47_sistemajp");
    //$conexion = mysqli_connect("162.241.60.169","estrat47_Admin","Pepito5824", "estrat47_sistemaJP");

    $id_emisor          = '1';
    $agente_retencion   = $_POST["nombre_proveedor"];
    $fechadeemis        = $_POST["fechadeemis"];
    $factura            = $_POST["nofactura"];
    $secuencial         = $_POST["noretencion"];
    $autorizacionsri    = $_POST["autorizacionsri"];
    $baseimp            = $_POST["baseimponible"];
    $riva               = $_POST["baseimponible"]*0.12*1.00;
    $rir                = $_POST["baseimponible"]*0.10;
    $rucproveedor       = $_POST["nit_proveedor"];
    $usuario_id         = $_SESSION['idUser'];
    
    if($_FILES["archivo"]) {
        $nombre_base = basename($_FILES["archivo"]["name"]);
        $nombre_final = date("d-m-y"). "-". date("H-i-s"). "-" . $nombre_base;
        $ruta = "Retenciones/" . $nombre_final;
        $subirarchivo = move_uploaded_file($_FILES["archivo"]["tmp_name"], $ruta);
        if($subirarchivo){
            $insertarSQL = "INSERT INTO retenciones(id_emisor,rucretencion, razonSocialAgenteRetencion, fechaemis, noretencion, autorizacionsri, baseimp, riva, rir, facturaQueAplica, archivo)
            VALUES ('$id_emisor','$rucproveedor','$agente_retencion','$fechadeemis','$secuencial','$autorizacionsri','$baseimp','$riva','$rir','$factura','$ruta')";
            $resultado = mysqli_query($conexion,$insertarSQL);
           
            if($resultado) {
                echo "<script>alert('Retención procesada con éxito'); window.location='nueva_retencion.php'</script>";
            } else {
                printf("Errormessage: %s\n", mysqli_error($conexion));
            }
             
        }
    } else {
        echo "Error al subir el archivo, favor enviar mensaje a Estratega.";
    }

