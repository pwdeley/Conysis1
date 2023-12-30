<?php
session_start();

//$conexion = mysqli_connect("localhost","root","root", "test");
$conexion = mysqli_connect("162.241.60.169","estrat47_Admin","Pepito5824", "estrat47_test");

$nombres  = $_POST['nombres'];
$gusta = $_POST["gusta"];
$nogusta = $_POST["nogusta"];
$comentarios = $_POST["comentarios"];


$insertarSQL = "INSERT INTO visitantes(nombres,gusta,nogusta,comentarios) VALUES ('$nombres','$gusta','$nogusta','$comentarios')";
$resultado = mysqli_query($conexion, $insertarSQL);

if ($resultado) {
    echo "<script>alert('Gracias $nombres esperamos haber sido de ayuda'); window.location='identidaddigital.php'</script>";
} else {
    printf("Errormessage: %s\n", mysqli_error($conexion));

}