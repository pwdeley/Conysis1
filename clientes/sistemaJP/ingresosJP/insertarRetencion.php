<?php
	session_start();

	//$conexion = mysqli_connect("localhost","root","", "estrat47_sistemajp");
    $conexion = mysqli_connect("162.241.60.169","estrat47_Admin","Pepito5824", "estrat47_sistemaJP");

    $fechadeemis  = $_POST["fechadeemis"];
    $secuencial = $_POST["noretencion"];
    $autorizacionsri = $_POST["autorizacionsri"];
    $baseimp = $_POST["baseimponible"];
    $riva70 = $_POST["baseimponible"]*0.12*0.7*0;
    $rir2 = $_POST["baseimponible"]*0.02;
    $rucproveedor = $_POST["nit_proveedor"];
    $usuario_id = $_SESSION['idUser'];
    
    if($_FILES["archivo"]) {
        $nombre_base = basename($_FILES["archivo"]["name"]);
        $nombre_final = date("d-m-y"). "-". date("H-i-s"). "-" . $nombre_base;
        $ruta = "Retenciones/" . $nombre_final;
        $subirarchivo = move_uploaded_file($_FILES["archivo"]["tmp_name"], $ruta);
        if($subirarchivo){
            $insertarSQL = "INSERT INTO retenciones(rucretencion, fechaemis, noretencion, autorizacionsri, baseimp, riva70, rir2, archivo)
            VALUES ('$rucproveedor','$fechadeemis','$secuencial','$autorizacionsri','$baseimp','$riva70','$rir2','$ruta')";
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

