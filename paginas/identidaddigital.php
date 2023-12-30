<?php 
    session_start();
//$conexion = mysqli_connect("localhost","root","root", "test");
$conexion = mysqli_connect("162.241.60.169","estrat47_Admin","Pepito5824", "estrat47_test");
 ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Identidad Digital EC</title>
    <link rel="icon" href="../imagenes/logoestratega.png" type="image/x">
    <link rel="stylesheet" href="../config/estilosidentidaddigital.css">

</head>
<body>

    <header>
        <nav>
            <a href="../index.php">Inicio</a>
            <a href="../paginas/nosotros.html">Nosotros</a>
            <a href="../paginas/metodologia.html">Metodología</a>
            <a href="../login/index.php">Login</a>
            <a href="../paginas/citas.html">Agende su cita</a>
            <a href="..">Identidad Digital</a>
        </nav>
    </header>

    <section>
        <div>
            <h1>&#128203; Identidad Digital</h1><br>
        </div>

        <div>
            <div>
                <h1>¿Quieres conocer sobre la Identidad Digital?</h1><br><br>
                <h3>De una manera fácil y divertida.</h3>
            </div>

        <form method="post" action="insertarIdDigital.php" enctype="multipart/form-data">
                <table class="table bg-info"  id="tabla">
                    <tr class="fila-fija">

                        <td>¿Cuál es tu nombre y apellido? <input required type="text" minlength="10" name="nombres" id="nombres" value="" placeholder="Tu nombre aquí..."></td><br><br>
                        <td><input type="submit" name="insertar" value="&#10133;&#128100; Empezar" class="btn_save"/></td>
                    </tr>
                </table>
        </form>
<br><br><br><h3>"Por favor ingresa tus nombres y apellidos completos para continuar..."</h3>
        </div>

    </section>

    <footer>
        <p class="rights"><span>&copy;&nbsp;</span><span class="copyright-year"></span>. Derechos Reservados. Diseñado por Conysis 2021 <a>Contabilidad y Sistemas</a></p>
    </footer>

</body>

</html>


