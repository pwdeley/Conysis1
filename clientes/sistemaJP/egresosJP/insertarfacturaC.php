<?php
	session_start();

	//$conexion = mysqli_connect("localhost","root","", "estrat47_sistemaea");
    $conexion = mysqli_connect("162.241.60.169","estrat47_Admin","Pepito5824", "estrat47_sistemaJP");

    $fechadeemis  = $_POST["fechadeemis"];
    $establecimiento = $_POST["establecimiento"];
    $ptoemis = $_POST["ptoemis"];
    $secuencial = $_POST["secuencial"];
    $autorizacionsri = $_POST["autorizacionsri"];
    $noobjetoiva = $_POST["noobjetoiva1"] + $_POST["noobjetoiva2"];
    $ivacero = $_POST["ivacero1"] + $_POST["ivacero2"];
    $baseiva = $_POST["txt_precio1"] + $_POST["txt_precio2"];
    $ivacompras = ($_POST["txt_precio1"])*.12 + ($_POST["txt_precio2"])*0.12;
    $formadepago = $_POST["formadepago"];
    $productoc1 = $_POST["productoc1"];
    $productoc2 = $_POST["productoc2"];
    $rucproveedor = $_POST["nit_proveedor"];
    $usuario_id = $_SESSION['idUser'];
    
    if($_FILES["archivo"]) {
        $nombre_base = basename($_FILES["archivo"]["name"]);
        $nombre_final = date("d-m-y"). "-". date("H-i-s"). "-" . $nombre_base;
        $ruta = "facturasC/" . $nombre_final;
        $subirarchivo = move_uploaded_file($_FILES["archivo"]["tmp_name"], $ruta);
        if($subirarchivo){
            $insertarSQL = "INSERT INTO facturaC(rucprovd, fechadeemis, establecimiento, ptoemis, secuencial, autorizacionsri, noobjetoiva, ivacero, baseiva, ivacompras, formadepago, productoc1, productoc2, archivo)
            VALUES ('$rucproveedor','$fechadeemis','$establecimiento','$ptoemis','$secuencial','$autorizacionsri','$noobjetoiva','$ivacero','$baseiva','$ivacompras','$formadepago','$productoc1','$productoc2','$ruta')";
            $resultado = mysqli_query($conexion,$insertarSQL);
           
            if($resultado) {
                echo "<script>alert('Factura guardada con éxito'); window.location='nueva_compra.php'</script>";
            } else {
                printf("Errormessage: %s\n", mysqli_error($conexion));
            }
             
        }
    } else {
        echo "Error al subir el archivo, favor enviar mensaje a Estratega.";
    }

