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
        <?PHP
        if ($conexion){
        $consulta = "SELECT MAX(idvisitantes) AS nombres FROM visitantes WHERE nombres = idVisitantes ";
        $resultado = mysqli_query($conexion,$consulta);
        if($resultado){
            while ($row = $resultado->fetch_array()){
                $nombres = $row['nombres'];
        ?>
        <div>
          <br>  <h2><?php echo $nombres; ?></h2>
        </div>
        <?php }
        }
        }
        ?>
        <br><br><h3>Primero observa el siguiente video introductorio: </h3><br><br>

    </div>
<div style="text-align: center">
    <iframe width="860" height="615" src="https://www.youtube.com/embed/zBByVuvaNO4" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><br>
</div>
    <br><br><h3>A continuación, en el siguiente video interactivo, te aparecerán preguntas fáciles de responder,
        pero que te ayudarán de forma divertida a aprender.</h3><br><br>

    <iframe src="https://vizia.co/videos/9eab720950e6b1f35e63b9/embed" allowtransparency="true" frameborder="0" scrolling="no" width="960" height="715"></iframe><br><br>

    <form  action="insertarIdDigital2.php" class="datosID" method="POST" enctype="multipart/form-data">

        <div style="text-align: right">

        <h3>¿Deseas profundizar tu conocimiento en la competencia de identidad digital?</h3><br>
        <h3>Aquí algunos videos que te pueden ayudar:</h3><br><br>

        <p>Video pedagógico, trata sobre las partes que conforman la identidad digital y sus tendencias: &#128071;</p>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/SN5zBwVPktM" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><br>
        <br><br><p>Video entrevista, trata sobre la relación entre identidad digital e identidad real y sus consecuencias: &#128071;</p>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/RsiV_Wy0Wi8" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><br>
        <br><br><p>Video animado, trata de forma clara sobre como se construye tu huella digital en la red y sugerencias de seguridad: &#128071;</p>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/fLKPsy2_2Og" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe><br>
        </div>

        <div style="text-align: center">

        <br><br><h3>¿Aprendiste algo más de la Identidad Digital?</h3><br>
<h2>
    <table style="margin: 0 auto">
        <thead>
        <tr>
            Por favor indícanos en qué porcentaje te gustó esta aplicación web:<br><br>
            <td>&#128512; 100% <input type="checkbox" name="gusta" value="cien" > </td><br>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;75% <input type="checkbox" name="gusta" value="setentaycinco" ></td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;50% <input type="checkbox" name="gusta" value="cincuenta" ></td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;25% <input type="checkbox" name="gusta" value="veinteycinco" ></td>
            <td>&nbsp;&nbsp;&nbsp;&nbsp;No me gustó &#9785; <input type="checkbox" name="nogusta" value="nogusta" ></td><br><br>

        </tr>

        </thead>
    </table>
</h2>
    <textarea placeholder="Aquí tus comentarios..." name="comentarios" cols="40" rows="5" style="resize: both;"></textarea>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class="btn_save" style="width: 150px; height: 100px; background-color: #79ace9; color: #0E725D;"><h2>Enviar &#128747;</h2></button>
        </div>
    </form>
</section>

<footer>
    <p class="rights"><span>&copy;&nbsp;</span><span class="copyright-year"></span>. Derechos Reservados. Diseñado por Conysis 2021 <a>Contabilidad y Sistemas</a></p>
</footer>

</body>

</html>


