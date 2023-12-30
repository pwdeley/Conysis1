<?php
session_start();
include "../conexion.php";



?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <title>Nómina General EA</title>
    <link rel="icon" href="../imagenesEA/logoestratega.png" type="image/x">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../css/jquery.min.js"></script>
    <script type="text/javascript" src="../css/functions.js"></script>

    <?php include "../../functions.php"; ?>

</head>
<body>

<?php include "../header.php"; ?>
<section id="container">

    <h1>&#128210; Nómina General EA</h1><br><br>

    <div>
        <h3>Si desea consultar una Nómina Mensual específica, favor ingrese las fechas:</h3>
        <form action="buscar_nomina.php" method="get" class="form_search_date">
            <label>De:  </label>
            <input type="date" name="fecha_de" id="fecha_de" required>
            <label>A:  </label>
            <input type="date" name="fecha_a" id="fecha_a" required>
            <button type="submit" class="btn_view"><i>&#129488;</i></button>
        </form>
    </div>
        <br><h3>Nómina Total del 1 de Ene a: <?php
        $fechanom = "SELECT MAX(fechaafectacion) as fechamax FROM nomina";
        $resultado = mysqli_query($conection, $fechanom);
        $row=mysqli_fetch_assoc($resultado);
        echo date_format (new DateTime($row["fechamax"]),'M-Y');


        ?></h3><br>
    <table>
        <tr>
            <th>Empleado</th>
            <th>Sueldo $</th>
            <th>Horas Extras $</th>
            <th>IESS Pers. $</th>
            <th>IESS Pat. $</th>
            <th>Décimo 3° $</th>
            <th>Décimo 4° $</th>
            <th>Fondo Reserv. $</th>
            <th>Prov. 13° $</th>
            <th>Prov. 14° $</th>
            <th>Prov.Fon.Resv.$</th>
            <th>Anticipos $</th>
            <th>Préstm.Quirgf.$</th>
            <th>Préstm.Hipt.$</th>
            <th>TOTAL PAGADO USD</th>
        </tr>


        <?php
        $suma1 = mysqli_query($conection,"SELECT SUM(sueldo) as mtotal1 FROM nomina WHERE empleado = 'ANDRADE TAMAYO MARIA' ");
        $row1 = mysqli_fetch_array($suma1,MYSQLI_ASSOC);
        $suma2 = mysqli_query($conection,"SELECT SUM(horaext25+horaext50+horaext100) as mtotal2 FROM nomina WHERE empleado = 'ANDRADE TAMAYO MARIA'  ");
        $row2 = mysqli_fetch_array($suma2,MYSQLI_ASSOC);
        $suma3 = mysqli_query($conection,"SELECT SUM(iesspers) as mtotal3 FROM nomina WHERE empleado = 'ANDRADE TAMAYO MARIA'  ");
        $row3 = mysqli_fetch_array($suma3,MYSQLI_ASSOC);
        $suma4 = mysqli_query($conection,"SELECT SUM(iesspatr) as mtotal4 FROM nomina WHERE empleado = 'ANDRADE TAMAYO MARIA'  ");
        $row4 = mysqli_fetch_array($suma4,MYSQLI_ASSOC);
        $suma5 = mysqli_query($conection,"SELECT SUM(gasto13) as mtotal5 FROM nomina WHERE empleado = 'ANDRADE TAMAYO MARIA'  ");
        $row5 = mysqli_fetch_array($suma5,MYSQLI_ASSOC);
        $suma6 = mysqli_query($conection,"SELECT SUM(gasto14) as mtotal6 FROM nomina WHERE empleado = 'ANDRADE TAMAYO MARIA'  ");
        $row6 = mysqli_fetch_array($suma6,MYSQLI_ASSOC);
        $suma7 = mysqli_query($conection,"SELECT SUM(gastofr) as mtotal7 FROM nomina WHERE empleado = 'ANDRADE TAMAYO MARIA'  ");
        $row7 = mysqli_fetch_array($suma7,MYSQLI_ASSOC);
        $suma8 = mysqli_query($conection,"SELECT SUM(prov13) as mtotal8 FROM nomina WHERE empleado = 'ANDRADE TAMAYO MARIA'  ");
        $row8 = mysqli_fetch_array($suma8,MYSQLI_ASSOC);
        $suma9 = mysqli_query($conection,"SELECT SUM(prov14) as mtotal9 FROM nomina WHERE empleado = 'ANDRADE TAMAYO MARIA'  ");
        $row9 = mysqli_fetch_array($suma9,MYSQLI_ASSOC);
        $suma10 = mysqli_query($conection,"SELECT SUM(provfr) as mtotal10 FROM nomina WHERE empleado = 'ANDRADE TAMAYO MARIA'  ");
        $row10 = mysqli_fetch_array($suma10,MYSQLI_ASSOC);
        $suma11= mysqli_query($conection,"SELECT SUM(anticipos) as mtotal11 FROM nomina WHERE empleado = 'ANDRADE TAMAYO MARIA'  ");
        $row11 = mysqli_fetch_array($suma11,MYSQLI_ASSOC);
        $suma12 = mysqli_query($conection,"SELECT SUM(prestamosqui) as mtotal12 FROM nomina WHERE empleado = 'ANDRADE TAMAYO MARIA'  ");
        $row12 = mysqli_fetch_array($suma12,MYSQLI_ASSOC);
        $suma13 = mysqli_query($conection,"SELECT SUM(prestamoship) as mtotal13 FROM nomina WHERE empleado = 'ANDRADE TAMAYO MARIA'  ");
        $row13 = mysqli_fetch_array($suma13,MYSQLI_ASSOC);
        $suma14 = mysqli_query($conection,"SELECT SUM(sueldo+horaext25+horaext50+horaext100+indemnizacion-
          iesspers+gasto13+gasto14+gastofr-anticipos-prestamosqui-prestamoship) as mtotal14 FROM nomina WHERE empleado = 'ANDRADE TAMAYO MARIA'  ");
        $row14 = mysqli_fetch_array($suma14,MYSQLI_ASSOC);

        ?>

        <tr>
            <td>ANDRADE TAMAYO MARIA</td>
            <td class="textright"><?php echo number_format(($row1["mtotal1"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row2["mtotal2"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row3["mtotal3"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row4["mtotal4"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row5["mtotal5"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row6["mtotal6"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row7["mtotal7"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row8["mtotal8"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row9["mtotal9"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row10["mtotal10"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row11["mtotal11"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row12["mtotal12"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row13["mtotal13"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row14["mtotal14"]),2,',', '.'); ?></td>

        </tr>

        <?php
        $suma1 = mysqli_query($conection,"SELECT SUM(sueldo) as mtotal1 FROM nomina WHERE empleado = 'ANDRADE TAMAYO ANA VALERIA'  ");
        $row1 = mysqli_fetch_array($suma1,MYSQLI_ASSOC);
        $suma2 = mysqli_query($conection,"SELECT SUM(horaext25+horaext50+horaext100) as mtotal2 FROM nomina WHERE empleado = 'ANDRADE TAMAYO ANA VALERIA'  ");
        $row2 = mysqli_fetch_array($suma2,MYSQLI_ASSOC);
        $suma3 = mysqli_query($conection,"SELECT SUM(iesspers) as mtotal3 FROM nomina WHERE empleado = 'ANDRADE TAMAYO ANA VALERIA'  ");
        $row3 = mysqli_fetch_array($suma3,MYSQLI_ASSOC);
        $suma4 = mysqli_query($conection,"SELECT SUM(iesspatr) as mtotal4 FROM nomina WHERE empleado = 'ANDRADE TAMAYO ANA VALERIA'  ");
        $row4 = mysqli_fetch_array($suma4,MYSQLI_ASSOC);
        $suma5 = mysqli_query($conection,"SELECT SUM(gasto13) as mtotal5 FROM nomina WHERE empleado = 'ANDRADE TAMAYO ANA VALERIA'  ");
        $row5 = mysqli_fetch_array($suma5,MYSQLI_ASSOC);
        $suma6 = mysqli_query($conection,"SELECT SUM(gasto14) as mtotal6 FROM nomina WHERE empleado = 'ANDRADE TAMAYO ANA VALERIA'  ");
        $row6 = mysqli_fetch_array($suma6,MYSQLI_ASSOC);
        $suma7 = mysqli_query($conection,"SELECT SUM(gastofr) as mtotal7 FROM nomina WHERE empleado = 'ANDRADE TAMAYO ANA VALERIA'  ");
        $row7 = mysqli_fetch_array($suma7,MYSQLI_ASSOC);
        $suma8 = mysqli_query($conection,"SELECT SUM(prov13) as mtotal8 FROM nomina WHERE empleado = 'ANDRADE TAMAYO ANA VALERIA'  ");
        $row8 = mysqli_fetch_array($suma8,MYSQLI_ASSOC);
        $suma9 = mysqli_query($conection,"SELECT SUM(prov14) as mtotal9 FROM nomina WHERE empleado = 'ANDRADE TAMAYO ANA VALERIA'  ");
        $row9 = mysqli_fetch_array($suma9,MYSQLI_ASSOC);
        $suma10 = mysqli_query($conection,"SELECT SUM(provfr) as mtotal10 FROM nomina WHERE empleado = 'ANDRADE TAMAYO ANA VALERIA'  ");
        $row10 = mysqli_fetch_array($suma10,MYSQLI_ASSOC);
        $suma11= mysqli_query($conection,"SELECT SUM(anticipos) as mtotal11 FROM nomina WHERE empleado = 'ANDRADE TAMAYO ANA VALERIA'  ");
        $row11 = mysqli_fetch_array($suma11,MYSQLI_ASSOC);
        $suma12 = mysqli_query($conection,"SELECT SUM(prestamosqui) as mtotal12 FROM nomina WHERE empleado = 'ANDRADE TAMAYO ANA VALERIA'  ");
        $row12 = mysqli_fetch_array($suma12,MYSQLI_ASSOC);
        $suma13 = mysqli_query($conection,"SELECT SUM(prestamoship) as mtotal13 FROM nomina WHERE empleado = 'ANDRADE TAMAYO ANA VALERIA'  ");
        $row13 = mysqli_fetch_array($suma13,MYSQLI_ASSOC);
        $suma14 = mysqli_query($conection,"SELECT SUM(sueldo+horaext25+horaext50+horaext100+indemnizacion-
          iesspers+gasto13+gasto14+gastofr-anticipos-prestamosqui-prestamoship) as mtotal14 FROM nomina WHERE empleado = 'ANDRADE TAMAYO ANA VALERIA'  ");
        $row14 = mysqli_fetch_array($suma14,MYSQLI_ASSOC);

        ?>

        <tr>
            <td>ANDRADE TAMAYO ANA VALERIA</td>
            <td class="textright"><?php echo number_format(($row1["mtotal1"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row2["mtotal2"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row3["mtotal3"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row4["mtotal4"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row5["mtotal5"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row6["mtotal6"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row7["mtotal7"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row8["mtotal8"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row9["mtotal9"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row10["mtotal10"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row11["mtotal11"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row12["mtotal12"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row13["mtotal13"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row14["mtotal14"]),2,',', '.'); ?></td>

        </tr>

        <?php
        $suma1 = mysqli_query($conection,"SELECT SUM(sueldo) as mtotal1 FROM nomina WHERE empleado = 'CALZADILLA CABELLO OCTAVIO RAFAEL'  ");
        $row1 = mysqli_fetch_array($suma1,MYSQLI_ASSOC);
        $suma2 = mysqli_query($conection,"SELECT SUM(horaext25+horaext50+horaext100) as mtotal2 FROM nomina WHERE empleado = 'CALZADILLA CABELLO OCTAVIO RAFAEL'  ");
        $row2 = mysqli_fetch_array($suma2,MYSQLI_ASSOC);
        $suma3 = mysqli_query($conection,"SELECT SUM(iesspers) as mtotal3 FROM nomina WHERE empleado = 'CALZADILLA CABELLO OCTAVIO RAFAEL'  ");
        $row3 = mysqli_fetch_array($suma3,MYSQLI_ASSOC);
        $suma4 = mysqli_query($conection,"SELECT SUM(iesspatr) as mtotal4 FROM nomina WHERE empleado = 'CALZADILLA CABELLO OCTAVIO RAFAEL'  ");
        $row4 = mysqli_fetch_array($suma4,MYSQLI_ASSOC);
        $suma5 = mysqli_query($conection,"SELECT SUM(gasto13) as mtotal5 FROM nomina WHERE empleado = 'CALZADILLA CABELLO OCTAVIO RAFAEL'  ");
        $row5 = mysqli_fetch_array($suma5,MYSQLI_ASSOC);
        $suma6 = mysqli_query($conection,"SELECT SUM(gasto14) as mtotal6 FROM nomina WHERE empleado = 'CALZADILLA CABELLO OCTAVIO RAFAEL'  ");
        $row6 = mysqli_fetch_array($suma6,MYSQLI_ASSOC);
        $suma7 = mysqli_query($conection,"SELECT SUM(gastofr) as mtotal7 FROM nomina WHERE empleado = 'CALZADILLA CABELLO OCTAVIO RAFAEL'  ");
        $row7 = mysqli_fetch_array($suma7,MYSQLI_ASSOC);
        $suma8 = mysqli_query($conection,"SELECT SUM(prov13) as mtotal8 FROM nomina WHERE empleado = 'CALZADILLA CABELLO OCTAVIO RAFAEL'  ");
        $row8 = mysqli_fetch_array($suma8,MYSQLI_ASSOC);
        $suma9 = mysqli_query($conection,"SELECT SUM(prov14) as mtotal9 FROM nomina WHERE empleado = 'CALZADILLA CABELLO OCTAVIO RAFAEL'  ");
        $row9 = mysqli_fetch_array($suma9,MYSQLI_ASSOC);
        $suma10 = mysqli_query($conection,"SELECT SUM(provfr) as mtotal10 FROM nomina WHERE empleado = 'CALZADILLA CABELLO OCTAVIO RAFAEL'  ");
        $row10 = mysqli_fetch_array($suma10,MYSQLI_ASSOC);
        $suma11= mysqli_query($conection,"SELECT SUM(anticipos) as mtotal11 FROM nomina WHERE empleado = 'CALZADILLA CABELLO OCTAVIO RAFAEL'  ");
        $row11 = mysqli_fetch_array($suma11,MYSQLI_ASSOC);
        $suma12 = mysqli_query($conection,"SELECT SUM(prestamosqui) as mtotal12 FROM nomina WHERE empleado = 'CALZADILLA CABELLO OCTAVIO RAFAEL'  ");
        $row12 = mysqli_fetch_array($suma12,MYSQLI_ASSOC);
        $suma13 = mysqli_query($conection,"SELECT SUM(prestamoship) as mtotal13 FROM nomina WHERE empleado = 'CALZADILLA CABELLO OCTAVIO RAFAEL'  ");
        $row13 = mysqli_fetch_array($suma13,MYSQLI_ASSOC);
        $suma14 = mysqli_query($conection,"SELECT SUM(sueldo+horaext25+horaext50+horaext100+indemnizacion-
          iesspers+gasto13+gasto14+gastofr-anticipos-prestamosqui-prestamoship) as mtotal14 FROM nomina WHERE empleado = 'CALZADILLA CABELLO OCTAVIO RAFAEL'  ");
        $row14 = mysqli_fetch_array($suma14,MYSQLI_ASSOC);

        ?>

        <tr>
            <td>CALZADILLA CABELLO OCTAVIO RAFAEL</td>
            <td class="textright"><?php echo number_format(($row1["mtotal1"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row2["mtotal2"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row3["mtotal3"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row4["mtotal4"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row5["mtotal5"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row6["mtotal6"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row7["mtotal7"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row8["mtotal8"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row9["mtotal9"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row10["mtotal10"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row11["mtotal11"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row12["mtotal12"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row13["mtotal13"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row14["mtotal14"]),2,',', '.'); ?></td>

        </tr>

        <?php
        $suma1 = mysqli_query($conection,"SELECT SUM(sueldo) as mtotal1 FROM nomina WHERE empleado = 'JARAMILLO CEVALLOS MARY LUZ'  ");
        $row1 = mysqli_fetch_array($suma1,MYSQLI_ASSOC);
        $suma2 = mysqli_query($conection,"SELECT SUM(horaext25+horaext50+horaext100) as mtotal2 FROM nomina WHERE empleado = 'JARAMILLO CEVALLOS MARY LUZ'  ");
        $row2 = mysqli_fetch_array($suma2,MYSQLI_ASSOC);
        $suma3 = mysqli_query($conection,"SELECT SUM(iesspers) as mtotal3 FROM nomina WHERE empleado = 'JARAMILLO CEVALLOS MARY LUZ'  ");
        $row3 = mysqli_fetch_array($suma3,MYSQLI_ASSOC);
        $suma4 = mysqli_query($conection,"SELECT SUM(iesspatr) as mtotal4 FROM nomina WHERE empleado = 'JARAMILLO CEVALLOS MARY LUZ'  ");
        $row4 = mysqli_fetch_array($suma4,MYSQLI_ASSOC);
        $suma5 = mysqli_query($conection,"SELECT SUM(gasto13) as mtotal5 FROM nomina WHERE empleado = 'JARAMILLO CEVALLOS MARY LUZ'  ");
        $row5 = mysqli_fetch_array($suma5,MYSQLI_ASSOC);
        $suma6 = mysqli_query($conection,"SELECT SUM(gasto14) as mtotal6 FROM nomina WHERE empleado = 'JARAMILLO CEVALLOS MARY LUZ'  ");
        $row6 = mysqli_fetch_array($suma6,MYSQLI_ASSOC);
        $suma7 = mysqli_query($conection,"SELECT SUM(gastofr) as mtotal7 FROM nomina WHERE empleado = 'JARAMILLO CEVALLOS MARY LUZ'  ");
        $row7 = mysqli_fetch_array($suma7,MYSQLI_ASSOC);
        $suma8 = mysqli_query($conection,"SELECT SUM(prov13) as mtotal8 FROM nomina WHERE empleado = 'JARAMILLO CEVALLOS MARY LUZ'  ");
        $row8 = mysqli_fetch_array($suma8,MYSQLI_ASSOC);
        $suma9 = mysqli_query($conection,"SELECT SUM(prov14) as mtotal9 FROM nomina WHERE empleado = 'JARAMILLO CEVALLOS MARY LUZ'  ");
        $row9 = mysqli_fetch_array($suma9,MYSQLI_ASSOC);
        $suma10 = mysqli_query($conection,"SELECT SUM(provfr) as mtotal10 FROM nomina WHERE empleado = 'JARAMILLO CEVALLOS MARY LUZ'  ");
        $row10 = mysqli_fetch_array($suma10,MYSQLI_ASSOC);
        $suma11= mysqli_query($conection,"SELECT SUM(anticipos) as mtotal11 FROM nomina WHERE empleado = 'JARAMILLO CEVALLOS MARY LUZ'  ");
        $row11 = mysqli_fetch_array($suma11,MYSQLI_ASSOC);
        $suma12 = mysqli_query($conection,"SELECT SUM(prestamosqui) as mtotal12 FROM nomina WHERE empleado = 'JARAMILLO CEVALLOS MARY LUZ'  ");
        $row12 = mysqli_fetch_array($suma12,MYSQLI_ASSOC);
        $suma13 = mysqli_query($conection,"SELECT SUM(prestamoship) as mtotal13 FROM nomina WHERE empleado = 'JARAMILLO CEVALLOS MARY LUZ'  ");
        $row13 = mysqli_fetch_array($suma13,MYSQLI_ASSOC);
        $suma14 = mysqli_query($conection,"SELECT SUM(sueldo+horaext25+horaext50+horaext100+indemnizacion-
          iesspers+gasto13+gasto14+gastofr-anticipos-prestamosqui-prestamoship) as mtotal14 FROM nomina WHERE empleado = 'JARAMILLO CEVALLOS MARY LUZ'  ");
        $row14 = mysqli_fetch_array($suma14,MYSQLI_ASSOC);

        ?>

        <tr>
            <td>JARAMILLO CEVALLOS MARY LUZ</td>
            <td class="textright"><?php echo number_format(($row1["mtotal1"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row2["mtotal2"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row3["mtotal3"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row4["mtotal4"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row5["mtotal5"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row6["mtotal6"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row7["mtotal7"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row8["mtotal8"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row9["mtotal9"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row10["mtotal10"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row11["mtotal11"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row12["mtotal12"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row13["mtotal13"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row14["mtotal14"]),2,',', '.'); ?></td>

        </tr>

        <?php
        $suma1 = mysqli_query($conection,"SELECT SUM(sueldo) as mtotal1 FROM nomina WHERE empleado = 'ORTEGA MARIN CARLA ROSSY'  ");
        $row1 = mysqli_fetch_array($suma1,MYSQLI_ASSOC);
        $suma2 = mysqli_query($conection,"SELECT SUM(horaext25+horaext50+horaext100) as mtotal2 FROM nomina WHERE empleado = 'ORTEGA MARIN CARLA ROSSY'  ");
        $row2 = mysqli_fetch_array($suma2,MYSQLI_ASSOC);
        $suma3 = mysqli_query($conection,"SELECT SUM(iesspers) as mtotal3 FROM nomina WHERE empleado = 'ORTEGA MARIN CARLA ROSSY'  ");
        $row3 = mysqli_fetch_array($suma3,MYSQLI_ASSOC);
        $suma4 = mysqli_query($conection,"SELECT SUM(iesspatr) as mtotal4 FROM nomina WHERE empleado = 'ORTEGA MARIN CARLA ROSSY'  ");
        $row4 = mysqli_fetch_array($suma4,MYSQLI_ASSOC);
        $suma5 = mysqli_query($conection,"SELECT SUM(gasto13) as mtotal5 FROM nomina WHERE empleado = 'ORTEGA MARIN CARLA ROSSY'  ");
        $row5 = mysqli_fetch_array($suma5,MYSQLI_ASSOC);
        $suma6 = mysqli_query($conection,"SELECT SUM(gasto14) as mtotal6 FROM nomina WHERE empleado = 'ORTEGA MARIN CARLA ROSSY'  ");
        $row6 = mysqli_fetch_array($suma6,MYSQLI_ASSOC);
        $suma7 = mysqli_query($conection,"SELECT SUM(gastofr) as mtotal7 FROM nomina WHERE empleado = 'ORTEGA MARIN CARLA ROSSY'  ");
        $row7 = mysqli_fetch_array($suma7,MYSQLI_ASSOC);
        $suma8 = mysqli_query($conection,"SELECT SUM(prov13) as mtotal8 FROM nomina WHERE empleado = 'ORTEGA MARIN CARLA ROSSY'  ");
        $row8 = mysqli_fetch_array($suma8,MYSQLI_ASSOC);
        $suma9 = mysqli_query($conection,"SELECT SUM(prov14) as mtotal9 FROM nomina WHERE empleado = 'ORTEGA MARIN CARLA ROSSY'  ");
        $row9 = mysqli_fetch_array($suma9,MYSQLI_ASSOC);
        $suma10 = mysqli_query($conection,"SELECT SUM(provfr) as mtotal10 FROM nomina WHERE empleado = 'ORTEGA MARIN CARLA ROSSY'  ");
        $row10 = mysqli_fetch_array($suma10,MYSQLI_ASSOC);
        $suma11= mysqli_query($conection,"SELECT SUM(anticipos) as mtotal11 FROM nomina WHERE empleado = 'ORTEGA MARIN CARLA ROSSY'  ");
        $row11 = mysqli_fetch_array($suma11,MYSQLI_ASSOC);
        $suma12 = mysqli_query($conection,"SELECT SUM(prestamosqui) as mtotal12 FROM nomina WHERE empleado = 'ORTEGA MARIN CARLA ROSSY'  ");
        $row12 = mysqli_fetch_array($suma12,MYSQLI_ASSOC);
        $suma13 = mysqli_query($conection,"SELECT SUM(prestamoship) as mtotal13 FROM nomina WHERE empleado = 'ORTEGA MARIN CARLA ROSSY'  ");
        $row13 = mysqli_fetch_array($suma13,MYSQLI_ASSOC);
        $suma14 = mysqli_query($conection,"SELECT SUM(sueldo+horaext25+horaext50+horaext100+indemnizacion-
          iesspers+gasto13+gasto14+gastofr-anticipos-prestamosqui-prestamoship) as mtotal14 FROM nomina WHERE empleado = 'ORTEGA MARIN CARLA ROSSY'  ");
        $row14 = mysqli_fetch_array($suma14,MYSQLI_ASSOC);

        ?>

        <tr>
            <td>ORTEGA MARIN CARLA ROSSY</td>
            <td class="textright"><?php echo number_format(($row1["mtotal1"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row2["mtotal2"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row3["mtotal3"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row4["mtotal4"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row5["mtotal5"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row6["mtotal6"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row7["mtotal7"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row8["mtotal8"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row9["mtotal9"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row10["mtotal10"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row11["mtotal11"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row12["mtotal12"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row13["mtotal13"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row14["mtotal14"]),2,',', '.'); ?></td>

        </tr>

        <?php
        $suma1 = mysqli_query($conection,"SELECT SUM(sueldo) as mtotal1 FROM nomina WHERE empleado = 'SANDOVAL JARAMILLO EDUARDO DAVID'  ");
        $row1 = mysqli_fetch_array($suma1,MYSQLI_ASSOC);
        $suma2 = mysqli_query($conection,"SELECT SUM(horaext25+horaext50+horaext100) as mtotal2 FROM nomina WHERE empleado = 'SANDOVAL JARAMILLO EDUARDO DAVID'  ");
        $row2 = mysqli_fetch_array($suma2,MYSQLI_ASSOC);
        $suma3 = mysqli_query($conection,"SELECT SUM(iesspers) as mtotal3 FROM nomina WHERE empleado = 'SANDOVAL JARAMILLO EDUARDO DAVID'  ");
        $row3 = mysqli_fetch_array($suma3,MYSQLI_ASSOC);
        $suma4 = mysqli_query($conection,"SELECT SUM(iesspatr) as mtotal4 FROM nomina WHERE empleado = 'SANDOVAL JARAMILLO EDUARDO DAVID'  ");
        $row4 = mysqli_fetch_array($suma4,MYSQLI_ASSOC);
        $suma5 = mysqli_query($conection,"SELECT SUM(gasto13) as mtotal5 FROM nomina WHERE empleado = 'SANDOVAL JARAMILLO EDUARDO DAVID'  ");
        $row5 = mysqli_fetch_array($suma5,MYSQLI_ASSOC);
        $suma6 = mysqli_query($conection,"SELECT SUM(gasto14) as mtotal6 FROM nomina WHERE empleado = 'SANDOVAL JARAMILLO EDUARDO DAVID'  ");
        $row6 = mysqli_fetch_array($suma6,MYSQLI_ASSOC);
        $suma7 = mysqli_query($conection,"SELECT SUM(gastofr) as mtotal7 FROM nomina WHERE empleado = 'SANDOVAL JARAMILLO EDUARDO DAVID'  ");
        $row7 = mysqli_fetch_array($suma7,MYSQLI_ASSOC);
        $suma8 = mysqli_query($conection,"SELECT SUM(prov13) as mtotal8 FROM nomina WHERE empleado = 'SANDOVAL JARAMILLO EDUARDO DAVID'  ");
        $row8 = mysqli_fetch_array($suma8,MYSQLI_ASSOC);
        $suma9 = mysqli_query($conection,"SELECT SUM(prov14) as mtotal9 FROM nomina WHERE empleado = 'SANDOVAL JARAMILLO EDUARDO DAVID'  ");
        $row9 = mysqli_fetch_array($suma9,MYSQLI_ASSOC);
        $suma10 = mysqli_query($conection,"SELECT SUM(provfr) as mtotal10 FROM nomina WHERE empleado = 'SANDOVAL JARAMILLO EDUARDO DAVID'  ");
        $row10 = mysqli_fetch_array($suma10,MYSQLI_ASSOC);
        $suma11= mysqli_query($conection,"SELECT SUM(anticipos) as mtotal11 FROM nomina WHERE empleado = 'SANDOVAL JARAMILLO EDUARDO DAVID'  ");
        $row11 = mysqli_fetch_array($suma11,MYSQLI_ASSOC);
        $suma12 = mysqli_query($conection,"SELECT SUM(prestamosqui) as mtotal12 FROM nomina WHERE empleado = 'SANDOVAL JARAMILLO EDUARDO DAVID'  ");
        $row12 = mysqli_fetch_array($suma12,MYSQLI_ASSOC);
        $suma13 = mysqli_query($conection,"SELECT SUM(prestamoship) as mtotal13 FROM nomina WHERE empleado = 'SANDOVAL JARAMILLO EDUARDO DAVID'  ");
        $row13 = mysqli_fetch_array($suma13,MYSQLI_ASSOC);
        $suma14 = mysqli_query($conection,"SELECT SUM(sueldo+horaext25+horaext50+horaext100+indemnizacion-
          iesspers+gasto13+gasto14+gastofr-anticipos-prestamosqui-prestamoship) as mtotal14 FROM nomina WHERE empleado = 'SANDOVAL JARAMILLO EDUARDO DAVID'  ");
        $row14 = mysqli_fetch_array($suma14,MYSQLI_ASSOC);

        ?>

        <tr>
            <td>SANDOVAL JARAMILLO EDUARDO DAVID</td>
            <td class="textright"><?php echo number_format(($row1["mtotal1"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row2["mtotal2"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row3["mtotal3"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row4["mtotal4"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row5["mtotal5"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row6["mtotal6"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row7["mtotal7"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row8["mtotal8"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row9["mtotal9"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row10["mtotal10"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row11["mtotal11"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row12["mtotal12"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row13["mtotal13"]),2,',', '.'); ?></td>
            <td class="textright"><?php echo number_format(($row14["mtotal14"]),2,',', '.'); ?></td>

        </tr>

<!-- Aquí ingresar más empleados si los hubiere..  -->


        <tr>
            <th>Total USD Nómina del año: </th>

            <?php
            $suma1 = mysqli_query($conection,"SELECT SUM(sueldo) as mtotal1 FROM nomina ");
            $row1 = mysqli_fetch_array($suma1,MYSQLI_ASSOC);
            $suma2 = mysqli_query($conection,"SELECT SUM(horaext25+horaext50+horaext100) as mtotal2 FROM nomina ");
            $row2 = mysqli_fetch_array($suma2,MYSQLI_ASSOC);
            $suma3 = mysqli_query($conection,"SELECT SUM(iesspers) as mtotal3 FROM nomina ");
            $row3 = mysqli_fetch_array($suma3,MYSQLI_ASSOC);
            $suma4 = mysqli_query($conection,"SELECT SUM(iesspatr) as mtotal4 FROM nomina ");
            $row4 = mysqli_fetch_array($suma4,MYSQLI_ASSOC);
            $suma5 = mysqli_query($conection,"SELECT SUM(gasto13) as mtotal5 FROM nomina ");
            $row5 = mysqli_fetch_array($suma5,MYSQLI_ASSOC);
            $suma6 = mysqli_query($conection,"SELECT SUM(gasto14) as mtotal6 FROM nomina ");
            $row6 = mysqli_fetch_array($suma6,MYSQLI_ASSOC);
            $suma7 = mysqli_query($conection,"SELECT SUM(gastofr) as mtotal7 FROM nomina ");
            $row7 = mysqli_fetch_array($suma7,MYSQLI_ASSOC);
            $suma8 = mysqli_query($conection,"SELECT SUM(prov13) as mtotal8 FROM nomina ");
            $row8 = mysqli_fetch_array($suma8,MYSQLI_ASSOC);
            $suma9 = mysqli_query($conection,"SELECT SUM(prov14) as mtotal9 FROM nomina ");
            $row9 = mysqli_fetch_array($suma9,MYSQLI_ASSOC);
            $suma10 = mysqli_query($conection,"SELECT SUM(provfr) as mtotal10 FROM nomina ");
            $row10 = mysqli_fetch_array($suma10,MYSQLI_ASSOC);
            $suma11= mysqli_query($conection,"SELECT SUM(anticipos) as mtotal11 FROM nomina ");
            $row11 = mysqli_fetch_array($suma11,MYSQLI_ASSOC);
            $suma12 = mysqli_query($conection,"SELECT SUM(prestamosqui) as mtotal12 FROM nomina ");
            $row12 = mysqli_fetch_array($suma12,MYSQLI_ASSOC);
            $suma13 = mysqli_query($conection,"SELECT SUM(prestamoship) as mtotal13 FROM nomina ");
            $row13 = mysqli_fetch_array($suma13,MYSQLI_ASSOC);
            $suma14 = mysqli_query($conection,"SELECT SUM(sueldo+horaext25+horaext50+horaext100+indemnizacion-
          iesspers+gasto13+gasto14+gastofr-anticipos-prestamosqui-prestamoship) as mtotal14 FROM nomina ");
            $row14 = mysqli_fetch_array($suma14,MYSQLI_ASSOC);

            ?>




            <th class="textright"><?php echo number_format(($row1["mtotal1"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row2["mtotal2"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row3["mtotal3"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row4["mtotal4"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row5["mtotal5"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row6["mtotal6"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row7["mtotal7"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row8["mtotal8"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row9["mtotal9"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row10["mtotal10"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row11["mtotal11"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row12["mtotal12"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row13["mtotal13"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row14["mtotal14"]),2,',', '.'); ?></th>

        </tr>



    </table>




</section>
<?php include "../../footer.php"; ?>
</body>

</html>