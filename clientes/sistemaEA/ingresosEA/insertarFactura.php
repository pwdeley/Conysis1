<?php
    $conexion = mysqli_connect("162.241.60.169", "estrat47_Admin", "Pepito5824", "estrat47_sistemaEA");   

    $idCliente = $_POST["idCliente"];
    $DenoCli = $_POST["DenoCli"];
    $direccionCl = $_POST["direccionCl"];
    $telefonoCl = $_POST["telefonoCl"];
    $emailCl = $_POST["emailCl"];

    if($_FILES["facturas"]) {
        $nombre_base = basename($_FILES["facturas"]["name"]);
        $nombre_final = date("d-m-y"). "-". date("H-i-s"). "-" . $nombre_base;
        $ruta = "facturas/" . $nombre_final;
        $subirarchivo = move_uploaded_file($_FILES["facturas"]["tmp_name"], $ruta);
        if($subirarchivo){
            $insertarSQL = "INSERT INTO clientesEA(idCliente, DenoCli, direccionCl, telefonoCl, emailCl, archivo)
            VALUES ('$idCliente','$DenoCli','$direccionCl','$telefonoCl','$emailCl','$ruta')";
            $resultado = mysqli_query($conexion,$insertarSQL);
            if($resultado) {
                echo "<script>alert('Factura guardada con éxito'); window.location='clientesEA.php'</script>";
            } else {
                printf("Errormessage: %s\n", mysqli_error($conexion));
            }
        }
    } else {
        echo "Error al subir el archivo, favor enviar mensaje al Estratega.";
    }

