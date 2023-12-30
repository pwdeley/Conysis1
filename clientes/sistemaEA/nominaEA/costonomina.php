<?php
session_start();
include "../conexion.php";


$fecha_de = '2021-01-01';
$fecha_a = '2021-01-31';

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <title>Costo Nomina EA</title>
    <link rel="icon" href="../imagenesEA/logoestratega.png" type="image/x">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../css/jquery.min.js"></script>
    <script type="text/javascript" src="../css/functions.js"></script>

    <?php include "../../functions.php"; ?>

</head>
<body>

<?php include "../header.php"; ?>
<section id="container">

    <h1>&#128210; Costo Nómina Mensual EA</h1><br><br>

    <div>

        <form>
            <label>Enero 2021 </label>
        </form>
    </div>

    <table>
        <tr>
            <th>Empleado</th>
            <th>Sueldo $</th>
            <th>Horas Extras $</th>
            <th>IESS Pat. $</th>
            <th>Décimos $</th>
            <th>Fondo Reserv. $</th>
            <th>COSTO TOTAL USD</th>
        </tr>

        <?php
        //Paginador

        $sql_registe = mysqli_query($conection,"SELECT * FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        while($sistemas = mysqli_fetch_row($sql_registe)){
            ?>

            <tr>
                <td><?php echo $sistemas[2] ?></td>
                <td class="textright"><?php echo $sistemas[3] ?></td>
                <td class="textright"><?php echo number_format(($sistemas[4] + $sistemas[5] + $sistemas[6]),2,',','.')?></td>
                <td class="textright"><?php echo $sistemas[9] ?></td>
                <td class="textright"><?php echo number_format(($sistemas[10] + $sistemas[11] + $sistemas[13] + $sistemas[14]),2,',','.')?></td>
                <td class="textright"><?php echo number_format(($sistemas[12] + $sistemas[15]),2,',','.')?></td>
                <td class="textright"><?php echo number_format(($sistemas[3] + $sistemas[4] + $sistemas[5] + $sistemas[6] +
                        $sistemas[9] + $sistemas[10] + $sistemas[11] + $sistemas[13] + $sistemas[14] +
                        + $sistemas[12] + $sistemas[15] ),2,',','.')?></td>
            </tr>


        <?php } ?>
        <?php
        $suma1 = mysqli_query($conection,"SELECT SUM(sueldo) as mtotal1 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row1 = mysqli_fetch_array($suma1,MYSQLI_ASSOC);
        $suma2 = mysqli_query($conection,"SELECT SUM(horaext25+horaext50+horaext100) as mtotal2 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row2 = mysqli_fetch_array($suma2,MYSQLI_ASSOC);
        $suma3 = mysqli_query($conection,"SELECT SUM(iesspatr) as mtotal3 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row3 = mysqli_fetch_array($suma3,MYSQLI_ASSOC);
        $suma4 = mysqli_query($conection,"SELECT SUM(gasto13+gasto14+prov13+prov14) as mtotal4 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row4 = mysqli_fetch_array($suma4,MYSQLI_ASSOC);
        $suma5 = mysqli_query($conection,"SELECT SUM(gastofr+provfr) as mtotal5 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row5 = mysqli_fetch_array($suma5,MYSQLI_ASSOC);
        $suma6 = mysqli_query($conection,"SELECT SUM(sueldo+horaext25+horaext50+horaext100+indemnizacion+
          iesspatr+gasto13+gasto14+prov13+prov14+gastofr+provfr) as mtotal6 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row6 = mysqli_fetch_array($suma6,MYSQLI_ASSOC);

        ?>
        <tr>
            <th>Total USD Nómina del: <?php echo date_format (new DateTime($fecha_de),'d-m-Y'); ?> - <?php echo date_format (new DateTime($fecha_a),'d-m-Y'); ?> </th>
            <th class="textright"><?php echo number_format(($row1["mtotal1"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row2["mtotal2"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row3["mtotal3"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row4["mtotal4"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row5["mtotal5"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row6["mtotal6"]),2,',', '.'); ?></th>

        </tr>

        <tr>
            <th> Total Empleados Contabilizados: <?php
                $sql_registe = mysqli_query ($conection, "SELECT COUNT(*) as total_registro FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a' ");
                $result_register = mysqli_fetch_array ($sql_registe);
                $total_registro = $result_register ['total_registro'];
                echo $total_registro;
                ?> </th>
        </tr>

    </table>
<br><br>
    <?php
    $fecha_de = '2021-02-01';
    $fecha_a = '2021-02-28';
    ?>

    <div>

        <form>
            <label>Febrero 2021 </label>
        </form>
    </div>

    <table>
        <tr>
            <th>Empleado</th>
            <th>Sueldo $</th>
            <th>Horas Extras $</th>
            <th>IESS Pat. $</th>
            <th>Décimos $</th>
            <th>Fondo Reserv. $</th>
            <th>COSTO TOTAL USD</th>
        </tr>

        <?php
        //Paginador

        $sql_registe = mysqli_query($conection,"SELECT * FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        while($sistemas = mysqli_fetch_row($sql_registe)){
            ?>

            <tr>
                <td><?php echo $sistemas[2] ?></td>
                <td class="textright"><?php echo $sistemas[3] ?></td>
                <td class="textright"><?php echo number_format(($sistemas[4] + $sistemas[5] + $sistemas[6]),2,',','.')?></td>
                <td class="textright"><?php echo $sistemas[9] ?></td>
                <td class="textright"><?php echo number_format(($sistemas[10] + $sistemas[11] + $sistemas[13] + $sistemas[14]),2,',','.')?></td>
                <td class="textright"><?php echo number_format(($sistemas[12] + $sistemas[15]),2,',','.')?></td>
                <td class="textright"><?php echo number_format(($sistemas[3] + $sistemas[4] + $sistemas[5] + $sistemas[6] +
                        $sistemas[9] + $sistemas[10] + $sistemas[11] + $sistemas[13] + $sistemas[14] +
                        + $sistemas[12] + $sistemas[15] ),2,',','.')?></td>
            </tr>


        <?php } ?>
        <?php
        $suma1 = mysqli_query($conection,"SELECT SUM(sueldo) as mtotal1 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row1 = mysqli_fetch_array($suma1,MYSQLI_ASSOC);
        $suma2 = mysqli_query($conection,"SELECT SUM(horaext25+horaext50+horaext100) as mtotal2 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row2 = mysqli_fetch_array($suma2,MYSQLI_ASSOC);
        $suma3 = mysqli_query($conection,"SELECT SUM(iesspatr) as mtotal3 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row3 = mysqli_fetch_array($suma3,MYSQLI_ASSOC);
        $suma4 = mysqli_query($conection,"SELECT SUM(gasto13+gasto14+prov13+prov14) as mtotal4 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row4 = mysqli_fetch_array($suma4,MYSQLI_ASSOC);
        $suma5 = mysqli_query($conection,"SELECT SUM(gastofr+provfr) as mtotal5 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row5 = mysqli_fetch_array($suma5,MYSQLI_ASSOC);
        $suma6 = mysqli_query($conection,"SELECT SUM(sueldo+horaext25+horaext50+horaext100+indemnizacion+
          iesspatr+gasto13+gasto14+prov13+prov14+gastofr+provfr) as mtotal6 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row6 = mysqli_fetch_array($suma6,MYSQLI_ASSOC);

        ?>
        <tr>
            <th>Total USD Nómina del: <?php echo date_format (new DateTime($fecha_de),'d-m-Y'); ?> - <?php echo date_format (new DateTime($fecha_a),'d-m-Y'); ?> </th>
            <th class="textright"><?php echo number_format(($row1["mtotal1"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row2["mtotal2"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row3["mtotal3"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row4["mtotal4"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row5["mtotal5"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row6["mtotal6"]),2,',', '.'); ?></th>

        </tr>

        <tr>
            <th> Total Empleados Contabilizados: <?php
                $sql_registe = mysqli_query ($conection, "SELECT COUNT(*) as total_registro FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a' ");
                $result_register = mysqli_fetch_array ($sql_registe);
                $total_registro = $result_register ['total_registro'];
                echo $total_registro;
                ?> </th>
        </tr>

    </table>

    <br><br>
    <?php
    $fecha_de = '2021-03-01';
    $fecha_a = '2021-03-31';
    ?>

    <div>

        <form>
            <label>Marzo 2021 </label>
        </form>
    </div>

    <table>
        <tr>
            <th>Empleado</th>
            <th>Sueldo $</th>
            <th>Horas Extras $</th>
            <th>IESS Pat. $</th>
            <th>Décimos $</th>
            <th>Fondo Reserv. $</th>
            <th>COSTO TOTAL USD</th>
        </tr>

        <?php
        //Paginador

        $sql_registe = mysqli_query($conection,"SELECT * FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        while($sistemas = mysqli_fetch_row($sql_registe)){
            ?>

            <tr>
                <td><?php echo $sistemas[2] ?></td>
                <td class="textright"><?php echo $sistemas[3] ?></td>
                <td class="textright"><?php echo number_format(($sistemas[4] + $sistemas[5] + $sistemas[6]),2,',','.')?></td>
                <td class="textright"><?php echo $sistemas[9] ?></td>
                <td class="textright"><?php echo number_format(($sistemas[10] + $sistemas[11] + $sistemas[13] + $sistemas[14]),2,',','.')?></td>
                <td class="textright"><?php echo number_format(($sistemas[12] + $sistemas[15]),2,',','.')?></td>
                <td class="textright"><?php echo number_format(($sistemas[3] + $sistemas[4] + $sistemas[5] + $sistemas[6] +
                        $sistemas[9] + $sistemas[10] + $sistemas[11] + $sistemas[13] + $sistemas[14] +
                        + $sistemas[12] + $sistemas[15] ),2,',','.')?></td>
            </tr>


        <?php } ?>
        <?php
        $suma1 = mysqli_query($conection,"SELECT SUM(sueldo) as mtotal1 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row1 = mysqli_fetch_array($suma1,MYSQLI_ASSOC);
        $suma2 = mysqli_query($conection,"SELECT SUM(horaext25+horaext50+horaext100) as mtotal2 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row2 = mysqli_fetch_array($suma2,MYSQLI_ASSOC);
        $suma3 = mysqli_query($conection,"SELECT SUM(iesspatr) as mtotal3 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row3 = mysqli_fetch_array($suma3,MYSQLI_ASSOC);
        $suma4 = mysqli_query($conection,"SELECT SUM(gasto13+gasto14+prov13+prov14) as mtotal4 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row4 = mysqli_fetch_array($suma4,MYSQLI_ASSOC);
        $suma5 = mysqli_query($conection,"SELECT SUM(gastofr+provfr) as mtotal5 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row5 = mysqli_fetch_array($suma5,MYSQLI_ASSOC);
        $suma6 = mysqli_query($conection,"SELECT SUM(sueldo+horaext25+horaext50+horaext100+indemnizacion+
          iesspatr+gasto13+gasto14+prov13+prov14+gastofr+provfr) as mtotal6 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row6 = mysqli_fetch_array($suma6,MYSQLI_ASSOC);

        ?>
        <tr>
            <th>Total USD Nómina del: <?php echo date_format (new DateTime($fecha_de),'d-m-Y'); ?> - <?php echo date_format (new DateTime($fecha_a),'d-m-Y'); ?> </th>
            <th class="textright"><?php echo number_format(($row1["mtotal1"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row2["mtotal2"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row3["mtotal3"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row4["mtotal4"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row5["mtotal5"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row6["mtotal6"]),2,',', '.'); ?></th>

        </tr>

        <tr>
            <th> Total Empleados Contabilizados: <?php
                $sql_registe = mysqli_query ($conection, "SELECT COUNT(*) as total_registro FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a' ");
                $result_register = mysqli_fetch_array ($sql_registe);
                $total_registro = $result_register ['total_registro'];
                echo $total_registro;
                ?> </th>
        </tr>

    </table>

    <br><br>
    <?php
    $fecha_de = '2021-04-01';
    $fecha_a = '2021-04-30';
    ?>

    <div>

        <form>
            <label>Abril 2021 </label>
        </form>
    </div>

    <table>
        <tr>
            <th>Empleado</th>
            <th>Sueldo $</th>
            <th>Horas Extras $</th>
            <th>IESS Pat. $</th>
            <th>Décimos $</th>
            <th>Fondo Reserv. $</th>
            <th>COSTO TOTAL USD</th>
        </tr>

        <?php
        //Paginador

        $sql_registe = mysqli_query($conection,"SELECT * FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        while($sistemas = mysqli_fetch_row($sql_registe)){
            ?>

            <tr>
                <td><?php echo $sistemas[2] ?></td>
                <td class="textright"><?php echo $sistemas[3] ?></td>
                <td class="textright"><?php echo number_format(($sistemas[4] + $sistemas[5] + $sistemas[6]),2,',','.')?></td>
                <td class="textright"><?php echo $sistemas[9] ?></td>
                <td class="textright"><?php echo number_format(($sistemas[10] + $sistemas[11] + $sistemas[13] + $sistemas[14]),2,',','.')?></td>
                <td class="textright"><?php echo number_format(($sistemas[12] + $sistemas[15]),2,',','.')?></td>
                <td class="textright"><?php echo number_format(($sistemas[3] + $sistemas[4] + $sistemas[5] + $sistemas[6] +
                        $sistemas[9] + $sistemas[10] + $sistemas[11] + $sistemas[13] + $sistemas[14] +
                        + $sistemas[12] + $sistemas[15] ),2,',','.')?></td>
            </tr>


        <?php } ?>
        <?php
        $suma1 = mysqli_query($conection,"SELECT SUM(sueldo) as mtotal1 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row1 = mysqli_fetch_array($suma1,MYSQLI_ASSOC);
        $suma2 = mysqli_query($conection,"SELECT SUM(horaext25+horaext50+horaext100) as mtotal2 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row2 = mysqli_fetch_array($suma2,MYSQLI_ASSOC);
        $suma3 = mysqli_query($conection,"SELECT SUM(iesspatr) as mtotal3 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row3 = mysqli_fetch_array($suma3,MYSQLI_ASSOC);
        $suma4 = mysqli_query($conection,"SELECT SUM(gasto13+gasto14+prov13+prov14) as mtotal4 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row4 = mysqli_fetch_array($suma4,MYSQLI_ASSOC);
        $suma5 = mysqli_query($conection,"SELECT SUM(gastofr+provfr) as mtotal5 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row5 = mysqli_fetch_array($suma5,MYSQLI_ASSOC);
        $suma6 = mysqli_query($conection,"SELECT SUM(sueldo+horaext25+horaext50+horaext100+indemnizacion+
          iesspatr+gasto13+gasto14+prov13+prov14+gastofr+provfr) as mtotal6 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row6 = mysqli_fetch_array($suma6,MYSQLI_ASSOC);

        ?>
        <tr>
            <th>Total USD Nómina del: <?php echo date_format (new DateTime($fecha_de),'d-m-Y'); ?> - <?php echo date_format (new DateTime($fecha_a),'d-m-Y'); ?> </th>
            <th class="textright"><?php echo number_format(($row1["mtotal1"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row2["mtotal2"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row3["mtotal3"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row4["mtotal4"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row5["mtotal5"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row6["mtotal6"]),2,',', '.'); ?></th>

        </tr>

        <tr>
            <th> Total Empleados Contabilizados: <?php
                $sql_registe = mysqli_query ($conection, "SELECT COUNT(*) as total_registro FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a' ");
                $result_register = mysqli_fetch_array ($sql_registe);
                $total_registro = $result_register ['total_registro'];
                echo $total_registro;
                ?> </th>
        </tr>

    </table>

    <br><br>
    <?php
    $fecha_de = '2021-05-01';
    $fecha_a = '2021-05-31';
    ?>

    <div>

        <form>
            <label>Mayo 2021 </label>
        </form>
    </div>

    <table>
        <tr>
            <th>Empleado</th>
            <th>Sueldo $</th>
            <th>Horas Extras $</th>
            <th>IESS Pat. $</th>
            <th>Décimos $</th>
            <th>Fondo Reserv. $</th>
            <th>COSTO TOTAL USD</th>
        </tr>

        <?php
        //Paginador

        $sql_registe = mysqli_query($conection,"SELECT * FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        while($sistemas = mysqli_fetch_row($sql_registe)){
            ?>

            <tr>
                <td><?php echo $sistemas[2] ?></td>
                <td class="textright"><?php echo $sistemas[3] ?></td>
                <td class="textright"><?php echo number_format(($sistemas[4] + $sistemas[5] + $sistemas[6]),2,',','.')?></td>
                <td class="textright"><?php echo $sistemas[9] ?></td>
                <td class="textright"><?php echo number_format(($sistemas[10] + $sistemas[11] + $sistemas[13] + $sistemas[14]),2,',','.')?></td>
                <td class="textright"><?php echo number_format(($sistemas[12] + $sistemas[15]),2,',','.')?></td>
                <td class="textright"><?php echo number_format(($sistemas[3] + $sistemas[4] + $sistemas[5] + $sistemas[6] +
                        $sistemas[9] + $sistemas[10] + $sistemas[11] + $sistemas[13] + $sistemas[14] +
                        + $sistemas[12] + $sistemas[15] ),2,',','.')?></td>
            </tr>


        <?php } ?>
        <?php
        $suma1 = mysqli_query($conection,"SELECT SUM(sueldo) as mtotal1 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row1 = mysqli_fetch_array($suma1,MYSQLI_ASSOC);
        $suma2 = mysqli_query($conection,"SELECT SUM(horaext25+horaext50+horaext100) as mtotal2 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row2 = mysqli_fetch_array($suma2,MYSQLI_ASSOC);
        $suma3 = mysqli_query($conection,"SELECT SUM(iesspatr) as mtotal3 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row3 = mysqli_fetch_array($suma3,MYSQLI_ASSOC);
        $suma4 = mysqli_query($conection,"SELECT SUM(gasto13+gasto14+prov13+prov14) as mtotal4 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row4 = mysqli_fetch_array($suma4,MYSQLI_ASSOC);
        $suma5 = mysqli_query($conection,"SELECT SUM(gastofr+provfr) as mtotal5 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row5 = mysqli_fetch_array($suma5,MYSQLI_ASSOC);
        $suma6 = mysqli_query($conection,"SELECT SUM(sueldo+horaext25+horaext50+horaext100+indemnizacion+
          iesspatr+gasto13+gasto14+prov13+prov14+gastofr+provfr) as mtotal6 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row6 = mysqli_fetch_array($suma6,MYSQLI_ASSOC);

        ?>
        <tr>
            <th>Total USD Nómina del: <?php echo date_format (new DateTime($fecha_de),'d-m-Y'); ?> - <?php echo date_format (new DateTime($fecha_a),'d-m-Y'); ?> </th>
            <th class="textright"><?php echo number_format(($row1["mtotal1"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row2["mtotal2"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row3["mtotal3"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row4["mtotal4"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row5["mtotal5"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row6["mtotal6"]),2,',', '.'); ?></th>

        </tr>

        <tr>
            <th> Total Empleados Contabilizados: <?php
                $sql_registe = mysqli_query ($conection, "SELECT COUNT(*) as total_registro FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a' ");
                $result_register = mysqli_fetch_array ($sql_registe);
                $total_registro = $result_register ['total_registro'];
                echo $total_registro;
                ?> </th>
        </tr>

    </table>

    <br><br>
    <?php
    $fecha_de = '2021-06-01';
    $fecha_a = '2021-06-30';
    ?>

    <div>

        <form>
            <label>Junio 2021 </label>
        </form>
    </div>

    <table>
        <tr>
            <th>Empleado</th>
            <th>Sueldo $</th>
            <th>Horas Extras $</th>
            <th>IESS Pat. $</th>
            <th>Décimos $</th>
            <th>Fondo Reserv. $</th>
            <th>COSTO TOTAL USD</th>
        </tr>

        <?php
        //Paginador

        $sql_registe = mysqli_query($conection,"SELECT * FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        while($sistemas = mysqli_fetch_row($sql_registe)){
            ?>

            <tr>
                <td><?php echo $sistemas[2] ?></td>
                <td class="textright"><?php echo $sistemas[3] ?></td>
                <td class="textright"><?php echo number_format(($sistemas[4] + $sistemas[5] + $sistemas[6]),2,',','.')?></td>
                <td class="textright"><?php echo $sistemas[9] ?></td>
                <td class="textright"><?php echo number_format(($sistemas[10] + $sistemas[11] + $sistemas[13] + $sistemas[14]),2,',','.')?></td>
                <td class="textright"><?php echo number_format(($sistemas[12] + $sistemas[15]),2,',','.')?></td>
                <td class="textright"><?php echo number_format(($sistemas[3] + $sistemas[4] + $sistemas[5] + $sistemas[6] +
                        $sistemas[9] + $sistemas[10] + $sistemas[11] + $sistemas[13] + $sistemas[14] +
                        + $sistemas[12] + $sistemas[15] ),2,',','.')?></td>
            </tr>


        <?php } ?>
        <?php
        $suma1 = mysqli_query($conection,"SELECT SUM(sueldo) as mtotal1 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row1 = mysqli_fetch_array($suma1,MYSQLI_ASSOC);
        $suma2 = mysqli_query($conection,"SELECT SUM(horaext25+horaext50+horaext100) as mtotal2 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row2 = mysqli_fetch_array($suma2,MYSQLI_ASSOC);
        $suma3 = mysqli_query($conection,"SELECT SUM(iesspatr) as mtotal3 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row3 = mysqli_fetch_array($suma3,MYSQLI_ASSOC);
        $suma4 = mysqli_query($conection,"SELECT SUM(gasto13+gasto14+prov13+prov14) as mtotal4 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row4 = mysqli_fetch_array($suma4,MYSQLI_ASSOC);
        $suma5 = mysqli_query($conection,"SELECT SUM(gastofr+provfr) as mtotal5 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row5 = mysqli_fetch_array($suma5,MYSQLI_ASSOC);
        $suma6 = mysqli_query($conection,"SELECT SUM(sueldo+horaext25+horaext50+horaext100+indemnizacion+
          iesspatr+gasto13+gasto14+prov13+prov14+gastofr+provfr) as mtotal6 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row6 = mysqli_fetch_array($suma6,MYSQLI_ASSOC);

        ?>
        <tr>
            <th>Total USD Nómina del: <?php echo date_format (new DateTime($fecha_de),'d-m-Y'); ?> - <?php echo date_format (new DateTime($fecha_a),'d-m-Y'); ?> </th>
            <th class="textright"><?php echo number_format(($row1["mtotal1"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row2["mtotal2"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row3["mtotal3"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row4["mtotal4"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row5["mtotal5"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row6["mtotal6"]),2,',', '.'); ?></th>

        </tr>

        <tr>
            <th> Total Empleados Contabilizados: <?php
                $sql_registe = mysqli_query ($conection, "SELECT COUNT(*) as total_registro FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a' ");
                $result_register = mysqli_fetch_array ($sql_registe);
                $total_registro = $result_register ['total_registro'];
                echo $total_registro;
                ?> </th>
        </tr>

    </table>

    <br><br>
    <?php
    $fecha_de = '2021-07-01';
    $fecha_a = '2021-07-31';
    ?>

    <div>

        <form>
            <label>Julio 2021 </label>
        </form>
    </div>

    <table>
        <tr>
            <th>Empleado</th>
            <th>Sueldo $</th>
            <th>Horas Extras $</th>
            <th>IESS Pat. $</th>
            <th>Décimos $</th>
            <th>Fondo Reserv. $</th>
            <th>COSTO TOTAL USD</th>
        </tr>

        <?php
        //Paginador

        $sql_registe = mysqli_query($conection,"SELECT * FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        while($sistemas = mysqli_fetch_row($sql_registe)){
            ?>

            <tr>
                <td><?php echo $sistemas[2] ?></td>
                <td class="textright"><?php echo $sistemas[3] ?></td>
                <td class="textright"><?php echo number_format(($sistemas[4] + $sistemas[5] + $sistemas[6]),2,',','.')?></td>
                <td class="textright"><?php echo $sistemas[9] ?></td>
                <td class="textright"><?php echo number_format(($sistemas[10] + $sistemas[11] + $sistemas[13] + $sistemas[14]),2,',','.')?></td>
                <td class="textright"><?php echo number_format(($sistemas[12] + $sistemas[15]),2,',','.')?></td>
                <td class="textright"><?php echo number_format(($sistemas[3] + $sistemas[4] + $sistemas[5] + $sistemas[6] +
                        $sistemas[9] + $sistemas[10] + $sistemas[11] + $sistemas[13] + $sistemas[14] +
                        + $sistemas[12] + $sistemas[15] ),2,',','.')?></td>
            </tr>


        <?php } ?>
        <?php
        $suma1 = mysqli_query($conection,"SELECT SUM(sueldo) as mtotal1 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row1 = mysqli_fetch_array($suma1,MYSQLI_ASSOC);
        $suma2 = mysqli_query($conection,"SELECT SUM(horaext25+horaext50+horaext100) as mtotal2 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row2 = mysqli_fetch_array($suma2,MYSQLI_ASSOC);
        $suma3 = mysqli_query($conection,"SELECT SUM(iesspatr) as mtotal3 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row3 = mysqli_fetch_array($suma3,MYSQLI_ASSOC);
        $suma4 = mysqli_query($conection,"SELECT SUM(gasto13+gasto14+prov13+prov14) as mtotal4 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row4 = mysqli_fetch_array($suma4,MYSQLI_ASSOC);
        $suma5 = mysqli_query($conection,"SELECT SUM(gastofr+provfr) as mtotal5 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row5 = mysqli_fetch_array($suma5,MYSQLI_ASSOC);
        $suma6 = mysqli_query($conection,"SELECT SUM(sueldo+horaext25+horaext50+horaext100+indemnizacion+
          iesspatr+gasto13+gasto14+prov13+prov14+gastofr+provfr) as mtotal6 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row6 = mysqli_fetch_array($suma6,MYSQLI_ASSOC);

        ?>
        <tr>
            <th>Total USD Nómina del: <?php echo date_format (new DateTime($fecha_de),'d-m-Y'); ?> - <?php echo date_format (new DateTime($fecha_a),'d-m-Y'); ?> </th>
            <th class="textright"><?php echo number_format(($row1["mtotal1"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row2["mtotal2"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row3["mtotal3"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row4["mtotal4"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row5["mtotal5"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row6["mtotal6"]),2,',', '.'); ?></th>

        </tr>

        <tr>
            <th> Total Empleados Contabilizados: <?php
                $sql_registe = mysqli_query ($conection, "SELECT COUNT(*) as total_registro FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a' ");
                $result_register = mysqli_fetch_array ($sql_registe);
                $total_registro = $result_register ['total_registro'];
                echo $total_registro;
                ?> </th>
        </tr>

    </table>

    <br><br>
    <?php
    $fecha_de = '2021-08-01';
    $fecha_a = '2021-08-31';
    ?>

    <div>

        <form>
            <label>Agosto 2021 </label>
        </form>
    </div>

    <table>
        <tr>
            <th>Empleado</th>
            <th>Sueldo $</th>
            <th>Horas Extras $</th>
            <th>IESS Pat. $</th>
            <th>Décimos $</th>
            <th>Fondo Reserv. $</th>
            <th>COSTO TOTAL USD</th>
        </tr>

        <?php
        //Paginador

        $sql_registe = mysqli_query($conection,"SELECT * FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        while($sistemas = mysqli_fetch_row($sql_registe)){
            ?>

            <tr>
                <td><?php echo $sistemas[2] ?></td>
                <td class="textright"><?php echo $sistemas[3] ?></td>
                <td class="textright"><?php echo number_format(($sistemas[4] + $sistemas[5] + $sistemas[6]),2,',','.')?></td>
                <td class="textright"><?php echo $sistemas[9] ?></td>
                <td class="textright"><?php echo number_format(($sistemas[10] + $sistemas[11] + $sistemas[13] + $sistemas[14]),2,',','.')?></td>
                <td class="textright"><?php echo number_format(($sistemas[12] + $sistemas[15]),2,',','.')?></td>
                <td class="textright"><?php echo number_format(($sistemas[3] + $sistemas[4] + $sistemas[5] + $sistemas[6] +
                        $sistemas[9] + $sistemas[10] + $sistemas[11] + $sistemas[13] + $sistemas[14] +
                        + $sistemas[12] + $sistemas[15] ),2,',','.')?></td>
            </tr>


        <?php } ?>
        <?php
        $suma1 = mysqli_query($conection,"SELECT SUM(sueldo) as mtotal1 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row1 = mysqli_fetch_array($suma1,MYSQLI_ASSOC);
        $suma2 = mysqli_query($conection,"SELECT SUM(horaext25+horaext50+horaext100) as mtotal2 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row2 = mysqli_fetch_array($suma2,MYSQLI_ASSOC);
        $suma3 = mysqli_query($conection,"SELECT SUM(iesspatr) as mtotal3 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row3 = mysqli_fetch_array($suma3,MYSQLI_ASSOC);
        $suma4 = mysqli_query($conection,"SELECT SUM(gasto13+gasto14+prov13+prov14) as mtotal4 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row4 = mysqli_fetch_array($suma4,MYSQLI_ASSOC);
        $suma5 = mysqli_query($conection,"SELECT SUM(gastofr+provfr) as mtotal5 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row5 = mysqli_fetch_array($suma5,MYSQLI_ASSOC);
        $suma6 = mysqli_query($conection,"SELECT SUM(sueldo+horaext25+horaext50+horaext100+indemnizacion+
          iesspatr+gasto13+gasto14+prov13+prov14+gastofr+provfr) as mtotal6 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row6 = mysqli_fetch_array($suma6,MYSQLI_ASSOC);

        ?>
        <tr>
            <th>Total USD Nómina del: <?php echo date_format (new DateTime($fecha_de),'d-m-Y'); ?> - <?php echo date_format (new DateTime($fecha_a),'d-m-Y'); ?> </th>
            <th class="textright"><?php echo number_format(($row1["mtotal1"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row2["mtotal2"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row3["mtotal3"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row4["mtotal4"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row5["mtotal5"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row6["mtotal6"]),2,',', '.'); ?></th>

        </tr>

        <tr>
            <th> Total Empleados Contabilizados: <?php
                $sql_registe = mysqli_query ($conection, "SELECT COUNT(*) as total_registro FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a' ");
                $result_register = mysqli_fetch_array ($sql_registe);
                $total_registro = $result_register ['total_registro'];
                echo $total_registro;
                ?> </th>
        </tr>

    </table>

    <br><br>
    <?php
    $fecha_de = '2021-09-01';
    $fecha_a = '2021-09-30';
    ?>

    <div>

        <form>
            <label>Septiembre 2021 </label>
        </form>
    </div>

    <table>
        <tr>
            <th>Empleado</th>
            <th>Sueldo $</th>
            <th>Horas Extras $</th>
            <th>IESS Pat. $</th>
            <th>Décimos $</th>
            <th>Fondo Reserv. $</th>
            <th>COSTO TOTAL USD</th>
        </tr>

        <?php
        //Paginador

        $sql_registe = mysqli_query($conection,"SELECT * FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        while($sistemas = mysqli_fetch_row($sql_registe)){
            ?>

            <tr>
                <td><?php echo $sistemas[2] ?></td>
                <td class="textright"><?php echo $sistemas[3] ?></td>
                <td class="textright"><?php echo number_format(($sistemas[4] + $sistemas[5] + $sistemas[6]),2,',','.')?></td>
                <td class="textright"><?php echo $sistemas[9] ?></td>
                <td class="textright"><?php echo number_format(($sistemas[10] + $sistemas[11] + $sistemas[13] + $sistemas[14]),2,',','.')?></td>
                <td class="textright"><?php echo number_format(($sistemas[12] + $sistemas[15]),2,',','.')?></td>
                <td class="textright"><?php echo number_format(($sistemas[3] + $sistemas[4] + $sistemas[5] + $sistemas[6] +
                        $sistemas[9] + $sistemas[10] + $sistemas[11] + $sistemas[13] + $sistemas[14] +
                        + $sistemas[12] + $sistemas[15] ),2,',','.')?></td>
            </tr>


        <?php } ?>
        <?php
        $suma1 = mysqli_query($conection,"SELECT SUM(sueldo) as mtotal1 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row1 = mysqli_fetch_array($suma1,MYSQLI_ASSOC);
        $suma2 = mysqli_query($conection,"SELECT SUM(horaext25+horaext50+horaext100) as mtotal2 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row2 = mysqli_fetch_array($suma2,MYSQLI_ASSOC);
        $suma3 = mysqli_query($conection,"SELECT SUM(iesspatr) as mtotal3 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row3 = mysqli_fetch_array($suma3,MYSQLI_ASSOC);
        $suma4 = mysqli_query($conection,"SELECT SUM(gasto13+gasto14+prov13+prov14) as mtotal4 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row4 = mysqli_fetch_array($suma4,MYSQLI_ASSOC);
        $suma5 = mysqli_query($conection,"SELECT SUM(gastofr+provfr) as mtotal5 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row5 = mysqli_fetch_array($suma5,MYSQLI_ASSOC);
        $suma6 = mysqli_query($conection,"SELECT SUM(sueldo+horaext25+horaext50+horaext100+indemnizacion+
          iesspatr+gasto13+gasto14+prov13+prov14+gastofr+provfr) as mtotal6 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row6 = mysqli_fetch_array($suma6,MYSQLI_ASSOC);

        ?>
        <tr>
            <th>Total USD Nómina del: <?php echo date_format (new DateTime($fecha_de),'d-m-Y'); ?> - <?php echo date_format (new DateTime($fecha_a),'d-m-Y'); ?> </th>
            <th class="textright"><?php echo number_format(($row1["mtotal1"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row2["mtotal2"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row3["mtotal3"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row4["mtotal4"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row5["mtotal5"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row6["mtotal6"]),2,',', '.'); ?></th>

        </tr>

        <tr>
            <th> Total Empleados Contabilizados: <?php
                $sql_registe = mysqli_query ($conection, "SELECT COUNT(*) as total_registro FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a' ");
                $result_register = mysqli_fetch_array ($sql_registe);
                $total_registro = $result_register ['total_registro'];
                echo $total_registro;
                ?> </th>
        </tr>

    </table>

    <br><br>
    <?php
    $fecha_de = '2021-10-01';
    $fecha_a = '2021-10-31';
    ?>

    <div>

        <form>
            <label>Octubre 2021 </label>
        </form>
    </div>

    <table>
        <tr>
            <th>Empleado</th>
            <th>Sueldo $</th>
            <th>Horas Extras $</th>
            <th>IESS Pat. $</th>
            <th>Décimos $</th>
            <th>Fondo Reserv. $</th>
            <th>COSTO TOTAL USD</th>
        </tr>

        <?php
        //Paginador

        $sql_registe = mysqli_query($conection,"SELECT * FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        while($sistemas = mysqli_fetch_row($sql_registe)){
            ?>

            <tr>
                <td><?php echo $sistemas[2] ?></td>
                <td class="textright"><?php echo $sistemas[3] ?></td>
                <td class="textright"><?php echo number_format(($sistemas[4] + $sistemas[5] + $sistemas[6]),2,',','.')?></td>
                <td class="textright"><?php echo $sistemas[9] ?></td>
                <td class="textright"><?php echo number_format(($sistemas[10] + $sistemas[11] + $sistemas[13] + $sistemas[14]),2,',','.')?></td>
                <td class="textright"><?php echo number_format(($sistemas[12] + $sistemas[15]),2,',','.')?></td>
                <td class="textright"><?php echo number_format(($sistemas[3] + $sistemas[4] + $sistemas[5] + $sistemas[6] +
                        $sistemas[9] + $sistemas[10] + $sistemas[11] + $sistemas[13] + $sistemas[14] +
                        + $sistemas[12] + $sistemas[15] ),2,',','.')?></td>
            </tr>


        <?php } ?>
        <?php
        $suma1 = mysqli_query($conection,"SELECT SUM(sueldo) as mtotal1 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row1 = mysqli_fetch_array($suma1,MYSQLI_ASSOC);
        $suma2 = mysqli_query($conection,"SELECT SUM(horaext25+horaext50+horaext100) as mtotal2 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row2 = mysqli_fetch_array($suma2,MYSQLI_ASSOC);
        $suma3 = mysqli_query($conection,"SELECT SUM(iesspatr) as mtotal3 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row3 = mysqli_fetch_array($suma3,MYSQLI_ASSOC);
        $suma4 = mysqli_query($conection,"SELECT SUM(gasto13+gasto14+prov13+prov14) as mtotal4 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row4 = mysqli_fetch_array($suma4,MYSQLI_ASSOC);
        $suma5 = mysqli_query($conection,"SELECT SUM(gastofr+provfr) as mtotal5 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row5 = mysqli_fetch_array($suma5,MYSQLI_ASSOC);
        $suma6 = mysqli_query($conection,"SELECT SUM(sueldo+horaext25+horaext50+horaext100+indemnizacion+
          iesspatr+gasto13+gasto14+prov13+prov14+gastofr+provfr) as mtotal6 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row6 = mysqli_fetch_array($suma6,MYSQLI_ASSOC);

        ?>
        <tr>
            <th>Total USD Nómina del: <?php echo date_format (new DateTime($fecha_de),'d-m-Y'); ?> - <?php echo date_format (new DateTime($fecha_a),'d-m-Y'); ?> </th>
            <th class="textright"><?php echo number_format(($row1["mtotal1"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row2["mtotal2"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row3["mtotal3"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row4["mtotal4"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row5["mtotal5"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row6["mtotal6"]),2,',', '.'); ?></th>

        </tr>

        <tr>
            <th> Total Empleados Contabilizados: <?php
                $sql_registe = mysqli_query ($conection, "SELECT COUNT(*) as total_registro FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a' ");
                $result_register = mysqli_fetch_array ($sql_registe);
                $total_registro = $result_register ['total_registro'];
                echo $total_registro;
                ?> </th>
        </tr>

    </table>

    <br><br>
    <?php
    $fecha_de = '2021-11-01';
    $fecha_a = '2021-11-30';
    ?>

    <div>

        <form>
            <label>Noviembre 2021 </label>
        </form>
    </div>

    <table>
        <tr>
            <th>Empleado</th>
            <th>Sueldo $</th>
            <th>Horas Extras $</th>
            <th>IESS Pat. $</th>
            <th>Décimos $</th>
            <th>Fondo Reserv. $</th>
            <th>COSTO TOTAL USD</th>
        </tr>

        <?php
        //Paginador

        $sql_registe = mysqli_query($conection,"SELECT * FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        while($sistemas = mysqli_fetch_row($sql_registe)){
            ?>

            <tr>
                <td><?php echo $sistemas[2] ?></td>
                <td class="textright"><?php echo $sistemas[3] ?></td>
                <td class="textright"><?php echo number_format(($sistemas[4] + $sistemas[5] + $sistemas[6]),2,',','.')?></td>
                <td class="textright"><?php echo $sistemas[9] ?></td>
                <td class="textright"><?php echo number_format(($sistemas[10] + $sistemas[11] + $sistemas[13] + $sistemas[14]),2,',','.')?></td>
                <td class="textright"><?php echo number_format(($sistemas[12] + $sistemas[15]),2,',','.')?></td>
                <td class="textright"><?php echo number_format(($sistemas[3] + $sistemas[4] + $sistemas[5] + $sistemas[6] +
                        $sistemas[9] + $sistemas[10] + $sistemas[11] + $sistemas[13] + $sistemas[14] +
                        + $sistemas[12] + $sistemas[15] ),2,',','.')?></td>
            </tr>


        <?php } ?>
        <?php
        $suma1 = mysqli_query($conection,"SELECT SUM(sueldo) as mtotal1 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row1 = mysqli_fetch_array($suma1,MYSQLI_ASSOC);
        $suma2 = mysqli_query($conection,"SELECT SUM(horaext25+horaext50+horaext100) as mtotal2 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row2 = mysqli_fetch_array($suma2,MYSQLI_ASSOC);
        $suma3 = mysqli_query($conection,"SELECT SUM(iesspatr) as mtotal3 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row3 = mysqli_fetch_array($suma3,MYSQLI_ASSOC);
        $suma4 = mysqli_query($conection,"SELECT SUM(gasto13+gasto14+prov13+prov14) as mtotal4 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row4 = mysqli_fetch_array($suma4,MYSQLI_ASSOC);
        $suma5 = mysqli_query($conection,"SELECT SUM(gastofr+provfr) as mtotal5 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row5 = mysqli_fetch_array($suma5,MYSQLI_ASSOC);
        $suma6 = mysqli_query($conection,"SELECT SUM(sueldo+horaext25+horaext50+horaext100+indemnizacion+
          iesspatr+gasto13+gasto14+prov13+prov14+gastofr+provfr) as mtotal6 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row6 = mysqli_fetch_array($suma6,MYSQLI_ASSOC);

        ?>
        <tr>
            <th>Total USD Nómina del: <?php echo date_format (new DateTime($fecha_de),'d-m-Y'); ?> - <?php echo date_format (new DateTime($fecha_a),'d-m-Y'); ?> </th>
            <th class="textright"><?php echo number_format(($row1["mtotal1"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row2["mtotal2"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row3["mtotal3"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row4["mtotal4"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row5["mtotal5"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row6["mtotal6"]),2,',', '.'); ?></th>

        </tr>

        <tr>
            <th> Total Empleados Contabilizados: <?php
                $sql_registe = mysqli_query ($conection, "SELECT COUNT(*) as total_registro FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a' ");
                $result_register = mysqli_fetch_array ($sql_registe);
                $total_registro = $result_register ['total_registro'];
                echo $total_registro;
                ?> </th>
        </tr>

    </table>

    <br><br>
    <?php
    $fecha_de = '2021-12-01';
    $fecha_a = '2021-12-31';
    ?>

    <div>

        <form>
            <label>Diciembre 2021 </label>
        </form>
    </div>

    <table>
        <tr>
            <th>Empleado</th>
            <th>Sueldo $</th>
            <th>Horas Extras $</th>
            <th>IESS Pat. $</th>
            <th>Décimos $</th>
            <th>Fondo Reserv. $</th>
            <th>COSTO TOTAL USD</th>
        </tr>

        <?php
        //Paginador

        $sql_registe = mysqli_query($conection,"SELECT * FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        while($sistemas = mysqli_fetch_row($sql_registe)){
            ?>

            <tr>
                <td><?php echo $sistemas[2] ?></td>
                <td class="textright"><?php echo $sistemas[3] ?></td>
                <td class="textright"><?php echo number_format(($sistemas[4] + $sistemas[5] + $sistemas[6]),2,',','.')?></td>
                <td class="textright"><?php echo $sistemas[9] ?></td>
                <td class="textright"><?php echo number_format(($sistemas[10] + $sistemas[11] + $sistemas[13] + $sistemas[14]),2,',','.')?></td>
                <td class="textright"><?php echo number_format(($sistemas[12] + $sistemas[15]),2,',','.')?></td>
                <td class="textright"><?php echo number_format(($sistemas[3] + $sistemas[4] + $sistemas[5] + $sistemas[6] +
                        $sistemas[9] + $sistemas[10] + $sistemas[11] + $sistemas[13] + $sistemas[14] +
                        + $sistemas[12] + $sistemas[15] ),2,',','.')?></td>
            </tr>


        <?php } ?>
        <?php
        $suma1 = mysqli_query($conection,"SELECT SUM(sueldo) as mtotal1 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row1 = mysqli_fetch_array($suma1,MYSQLI_ASSOC);
        $suma2 = mysqli_query($conection,"SELECT SUM(horaext25+horaext50+horaext100) as mtotal2 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row2 = mysqli_fetch_array($suma2,MYSQLI_ASSOC);
        $suma3 = mysqli_query($conection,"SELECT SUM(iesspatr) as mtotal3 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row3 = mysqli_fetch_array($suma3,MYSQLI_ASSOC);
        $suma4 = mysqli_query($conection,"SELECT SUM(gasto13+gasto14+prov13+prov14) as mtotal4 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row4 = mysqli_fetch_array($suma4,MYSQLI_ASSOC);
        $suma5 = mysqli_query($conection,"SELECT SUM(gastofr+provfr) as mtotal5 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row5 = mysqli_fetch_array($suma5,MYSQLI_ASSOC);
        $suma6 = mysqli_query($conection,"SELECT SUM(sueldo+horaext25+horaext50+horaext100+indemnizacion+
          iesspatr+gasto13+gasto14+prov13+prov14+gastofr+provfr) as mtotal6 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row6 = mysqli_fetch_array($suma6,MYSQLI_ASSOC);

        ?>
        <tr>
            <th>Total USD Nómina del: <?php echo date_format (new DateTime($fecha_de),'d-m-Y'); ?> - <?php echo date_format (new DateTime($fecha_a),'d-m-Y'); ?> </th>
            <th class="textright"><?php echo number_format(($row1["mtotal1"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row2["mtotal2"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row3["mtotal3"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row4["mtotal4"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row5["mtotal5"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row6["mtotal6"]),2,',', '.'); ?></th>

        </tr>

        <tr>
            <th> Total Empleados Contabilizados: <?php
                $sql_registe = mysqli_query ($conection, "SELECT COUNT(*) as total_registro FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a' ");
                $result_register = mysqli_fetch_array ($sql_registe);
                $total_registro = $result_register ['total_registro'];
                echo $total_registro;
                ?> </th>
        </tr>

    </table>

    <br><br>
    <?php
    $fecha_de = '2021-01-01';
    $fecha_a = '2021-12-31';
    ?>

    <div>

        <form>
            <label>Total Registrado 2021 </label>
        </form>
    </div>

    <table>
        <tr>
            <th>Empleado</th>
            <th>Sueldo $</th>
            <th>Horas Extras $</th>
            <th>IESS Pat. $</th>
            <th>Décimos $</th>
            <th>Fondo Reserv. $</th>
            <th>COSTO TOTAL USD</th>
        </tr>


            <tr>
                <td>ANDRADE TAMAYO MARIA</td>
                <td class="textright">
                    <?php
                    $sql_registe = mysqli_query($conection,"SELECT SUM(sueldo) AS suma_sueldo FROM nomina WHERE empleado = 'ANDRADE TAMAYO MARIA'");
                    $row = mysqli_fetch_assoc($sql_registe);
                    $sum = $row['suma_sueldo'];
                    echo number_format(($row['suma_sueldo']),2,',', '.')  ;
                    ?>
                </td>
                <td class="textright">
                    <?php
                    $sql_registe = mysqli_query($conection,"SELECT SUM(horaext25+horaext50+horaext100) AS suma_hextr FROM nomina WHERE empleado = 'ANDRADE TAMAYO MARIA'");
                    $row = mysqli_fetch_assoc($sql_registe);
                    $sum = $row['suma_hextr'];
                    echo number_format(($row['suma_hextr']),2,',', '.')  ;
                    ?>
                </td>
                <td class="textright">
                    <?php
                    $sql_registe = mysqli_query($conection,"SELECT SUM(iesspatr) AS suma_iesspatr FROM nomina WHERE empleado = 'ANDRADE TAMAYO MARIA'");
                    $row = mysqli_fetch_assoc($sql_registe);
                    $sum = $row['suma_iesspatr'];
                    echo number_format(($row['suma_iesspatr']),2,',', '.')  ;
                    ?>
                </td>
                <td class="textright">
                    <?php
                    $sql_registe = mysqli_query($conection,"SELECT SUM(gasto13+gasto14+prov13+prov14) AS suma_decimos FROM nomina WHERE empleado = 'ANDRADE TAMAYO MARIA'");
                    $row = mysqli_fetch_assoc($sql_registe);
                    $sum = $row['suma_decimos'];
                    echo number_format(($row['suma_decimos']),2,',', '.')  ;
                    ?>
                </td>
                <td class="textright">
                    <?php
                    $sql_registe = mysqli_query($conection,"SELECT SUM(gastofr+provfr) AS suma_fondos FROM nomina WHERE empleado = 'ANDRADE TAMAYO MARIA'");
                    $row = mysqli_fetch_assoc($sql_registe);
                    $sum = $row['suma_fondos'];
                    echo number_format(($row['suma_fondos']),2,',', '.')  ;
                    ?>
                </td>
                <td class="textright"><?php
                    $sql_registe = mysqli_query($conection,"SELECT SUM(sueldo+horaext25+horaext50+horaext100+iesspatr+
                    gasto13+gasto14+prov13+prov14+gastofr+provfr) AS suma_total FROM nomina WHERE empleado = 'ANDRADE TAMAYO MARIA'");
                    $row = mysqli_fetch_assoc($sql_registe);
                    $sum = $row['suma_total'];
                    echo number_format(($row['suma_total']),2,',', '.')  ;
                    ?></td>
            </tr>

        <tr>
            <td>ANDRADE TAMAYO ANA VALERIA</td>
            <td class="textright">
                <?php
                $sql_registe = mysqli_query($conection,"SELECT SUM(sueldo) AS suma_sueldo FROM nomina WHERE empleado = 'ANDRADE TAMAYO ANA VALERIA'");
                $row = mysqli_fetch_assoc($sql_registe);
                $sum = $row['suma_sueldo'];
                echo number_format(($row['suma_sueldo']),2,',', '.')  ;
                ?>
            </td>
            <td class="textright">
                <?php
                $sql_registe = mysqli_query($conection,"SELECT SUM(horaext25+horaext50+horaext100) AS suma_hextr FROM nomina WHERE empleado = 'ANDRADE TAMAYO ANA VALERIA'");
                $row = mysqli_fetch_assoc($sql_registe);
                $sum = $row['suma_hextr'];
                echo number_format(($row['suma_hextr']),2,',', '.')  ;
                ?>
            </td>
            <td class="textright">
                <?php
                $sql_registe = mysqli_query($conection,"SELECT SUM(iesspatr) AS suma_iesspatr FROM nomina WHERE empleado = 'ANDRADE TAMAYO ANA VALERIA'");
                $row = mysqli_fetch_assoc($sql_registe);
                $sum = $row['suma_iesspatr'];
                echo number_format(($row['suma_iesspatr']),2,',', '.')  ;
                ?>
            </td>
            <td class="textright">
                <?php
                $sql_registe = mysqli_query($conection,"SELECT SUM(gasto13+gasto14+prov13+prov14) AS suma_decimos FROM nomina WHERE empleado = 'ANDRADE TAMAYO ANA VALERIA'");
                $row = mysqli_fetch_assoc($sql_registe);
                $sum = $row['suma_decimos'];
                echo number_format(($row['suma_decimos']),2,',', '.')  ;
                ?>
            </td>
            <td class="textright">
                <?php
                $sql_registe = mysqli_query($conection,"SELECT SUM(gastofr+provfr) AS suma_fondos FROM nomina WHERE empleado = 'ANDRADE TAMAYO ANA VALERIA'");
                $row = mysqli_fetch_assoc($sql_registe);
                $sum = $row['suma_fondos'];
                echo number_format(($row['suma_fondos']),2,',', '.')  ;
                ?>
            </td>
            <td class="textright"><?php
                $sql_registe = mysqli_query($conection,"SELECT SUM(sueldo+horaext25+horaext50+horaext100+iesspatr+
                    gasto13+gasto14+prov13+prov14+gastofr+provfr) AS suma_total FROM nomina WHERE empleado = 'ANDRADE TAMAYO ANA VALERIA'");
                $row = mysqli_fetch_assoc($sql_registe);
                $sum = $row['suma_total'];
                echo number_format(($row['suma_total']),2,',', '.')  ;
                ?></td>
        </tr>

        <tr>
            <td>CALZADILLA CABELLO OCTAVIO RAFAEL</td>
            <td class="textright">
                <?php
                $sql_registe = mysqli_query($conection,"SELECT SUM(sueldo) AS suma_sueldo FROM nomina WHERE empleado = 'CALZADILLA CABELLO OCTAVIO RAFAEL'");
                $row = mysqli_fetch_assoc($sql_registe);
                $sum = $row['suma_sueldo'];
                echo number_format(($row['suma_sueldo']),2,',', '.')  ;
                ?>
            </td>
            <td class="textright">
                <?php
                $sql_registe = mysqli_query($conection,"SELECT SUM(horaext25+horaext50+horaext100) AS suma_hextr FROM nomina WHERE empleado = 'CALZADILLA CABELLO OCTAVIO RAFAEL'");
                $row = mysqli_fetch_assoc($sql_registe);
                $sum = $row['suma_hextr'];
                echo number_format(($row['suma_hextr']),2,',', '.')  ;
                ?>
            </td>
            <td class="textright">
                <?php
                $sql_registe = mysqli_query($conection,"SELECT SUM(iesspatr) AS suma_iesspatr FROM nomina WHERE empleado = 'CALZADILLA CABELLO OCTAVIO RAFAEL'");
                $row = mysqli_fetch_assoc($sql_registe);
                $sum = $row['suma_iesspatr'];
                echo number_format(($row['suma_iesspatr']),2,',', '.')  ;
                ?>
            </td>
            <td class="textright">
                <?php
                $sql_registe = mysqli_query($conection,"SELECT SUM(gasto13+gasto14+prov13+prov14) AS suma_decimos FROM nomina WHERE empleado = 'CALZADILLA CABELLO OCTAVIO RAFAEL'");
                $row = mysqli_fetch_assoc($sql_registe);
                $sum = $row['suma_decimos'];
                echo number_format(($row['suma_decimos']),2,',', '.')  ;
                ?>
            </td>
            <td class="textright">
                <?php
                $sql_registe = mysqli_query($conection,"SELECT SUM(gastofr+provfr) AS suma_fondos FROM nomina WHERE empleado = 'CALZADILLA CABELLO OCTAVIO RAFAEL'");
                $row = mysqli_fetch_assoc($sql_registe);
                $sum = $row['suma_fondos'];
                echo number_format(($row['suma_fondos']),2,',', '.')  ;
                ?>
            </td>
            <td class="textright"><?php
                $sql_registe = mysqli_query($conection,"SELECT SUM(sueldo+horaext25+horaext50+horaext100+iesspatr+
                    gasto13+gasto14+prov13+prov14+gastofr+provfr) AS suma_total FROM nomina WHERE empleado = 'CALZADILLA CABELLO OCTAVIO RAFAEL'");
                $row = mysqli_fetch_assoc($sql_registe);
                $sum = $row['suma_total'];
                echo number_format(($row['suma_total']),2,',', '.')  ;
                ?></td>
        </tr>

        <tr>
            <td>JARAMILLO CEVALLOS MARY LUZ</td>
            <td class="textright">
                <?php
                $sql_registe = mysqli_query($conection,"SELECT SUM(sueldo) AS suma_sueldo FROM nomina WHERE empleado = 'JARAMILLO CEVALLOS MARY LUZ'");
                $row = mysqli_fetch_assoc($sql_registe);
                $sum = $row['suma_sueldo'];
                echo number_format(($row['suma_sueldo']),2,',', '.')  ;
                ?>
            </td>
            <td class="textright">
                <?php
                $sql_registe = mysqli_query($conection,"SELECT SUM(horaext25+horaext50+horaext100) AS suma_hextr FROM nomina WHERE empleado = 'JARAMILLO CEVALLOS MARY LUZ'");
                $row = mysqli_fetch_assoc($sql_registe);
                $sum = $row['suma_hextr'];
                echo number_format(($row['suma_hextr']),2,',', '.')  ;
                ?>
            </td>
            <td class="textright">
                <?php
                $sql_registe = mysqli_query($conection,"SELECT SUM(iesspatr) AS suma_iesspatr FROM nomina WHERE empleado = 'JARAMILLO CEVALLOS MARY LUZ'");
                $row = mysqli_fetch_assoc($sql_registe);
                $sum = $row['suma_iesspatr'];
                echo number_format(($row['suma_iesspatr']),2,',', '.')  ;
                ?>
            </td>
            <td class="textright">
                <?php
                $sql_registe = mysqli_query($conection,"SELECT SUM(gasto13+gasto14+prov13+prov14) AS suma_decimos FROM nomina WHERE empleado = 'JARAMILLO CEVALLOS MARY LUZ'");
                $row = mysqli_fetch_assoc($sql_registe);
                $sum = $row['suma_decimos'];
                echo number_format(($row['suma_decimos']),2,',', '.')  ;
                ?>
            </td>
            <td class="textright">
                <?php
                $sql_registe = mysqli_query($conection,"SELECT SUM(gastofr+provfr) AS suma_fondos FROM nomina WHERE empleado = 'JARAMILLO CEVALLOS MARY LUZ'");
                $row = mysqli_fetch_assoc($sql_registe);
                $sum = $row['suma_fondos'];
                echo number_format(($row['suma_fondos']),2,',', '.')  ;
                ?>
            </td>
            <td class="textright"><?php
                $sql_registe = mysqli_query($conection,"SELECT SUM(sueldo+horaext25+horaext50+horaext100+iesspatr+
                    gasto13+gasto14+prov13+prov14+gastofr+provfr) AS suma_total FROM nomina WHERE empleado = 'JARAMILLO CEVALLOS MARY LUZ'");
                $row = mysqli_fetch_assoc($sql_registe);
                $sum = $row['suma_total'];
                echo number_format(($row['suma_total']),2,',', '.')  ;
                ?></td>
        </tr>

        <tr>
            <td>ORTEGA MARIN CARLA ROSSY</td>
            <td class="textright">
                <?php
                $sql_registe = mysqli_query($conection,"SELECT SUM(sueldo) AS suma_sueldo FROM nomina WHERE empleado = 'ORTEGA MARIN CARLA ROSSY'");
                $row = mysqli_fetch_assoc($sql_registe);
                $sum = $row['suma_sueldo'];
                echo number_format(($row['suma_sueldo']),2,',', '.')  ;
                ?>
            </td>
            <td class="textright">
                <?php
                $sql_registe = mysqli_query($conection,"SELECT SUM(horaext25+horaext50+horaext100) AS suma_hextr FROM nomina WHERE empleado = 'ORTEGA MARIN CARLA ROSSY'");
                $row = mysqli_fetch_assoc($sql_registe);
                $sum = $row['suma_hextr'];
                echo number_format(($row['suma_hextr']),2,',', '.')  ;
                ?>
            </td>
            <td class="textright">
                <?php
                $sql_registe = mysqli_query($conection,"SELECT SUM(iesspatr) AS suma_iesspatr FROM nomina WHERE empleado = 'ORTEGA MARIN CARLA ROSSY'");
                $row = mysqli_fetch_assoc($sql_registe);
                $sum = $row['suma_iesspatr'];
                echo number_format(($row['suma_iesspatr']),2,',', '.')  ;
                ?>
            </td>
            <td class="textright">
                <?php
                $sql_registe = mysqli_query($conection,"SELECT SUM(gasto13+gasto14+prov13+prov14) AS suma_decimos FROM nomina WHERE empleado = 'ORTEGA MARIN CARLA ROSSY'");
                $row = mysqli_fetch_assoc($sql_registe);
                $sum = $row['suma_decimos'];
                echo number_format(($row['suma_decimos']),2,',', '.')  ;
                ?>
            </td>
            <td class="textright">
                <?php
                $sql_registe = mysqli_query($conection,"SELECT SUM(gastofr+provfr) AS suma_fondos FROM nomina WHERE empleado = 'ORTEGA MARIN CARLA ROSSY'");
                $row = mysqli_fetch_assoc($sql_registe);
                $sum = $row['suma_fondos'];
                echo number_format(($row['suma_fondos']),2,',', '.')  ;
                ?>
            </td>
            <td class="textright"><?php
                $sql_registe = mysqli_query($conection,"SELECT SUM(sueldo+horaext25+horaext50+horaext100+iesspatr+
                    gasto13+gasto14+prov13+prov14+gastofr+provfr) AS suma_total FROM nomina WHERE empleado = 'ORTEGA MARIN CARLA ROSSY'");
                $row = mysqli_fetch_assoc($sql_registe);
                $sum = $row['suma_total'];
                echo number_format(($row['suma_total']),2,',', '.')  ;
                ?></td>
        </tr>

        <tr>
            <td>SANDOVAL JARAMILLO EDUARDO DAVID</td>
            <td class="textright">
                <?php
                $sql_registe = mysqli_query($conection,"SELECT SUM(sueldo) AS suma_sueldo FROM nomina WHERE empleado = 'SANDOVAL JARAMILLO EDUARDO DAVID'");
                $row = mysqli_fetch_assoc($sql_registe);
                $sum = $row['suma_sueldo'];
                echo number_format(($row['suma_sueldo']),2,',', '.')  ;
                ?>
            </td>
            <td class="textright">
                <?php
                $sql_registe = mysqli_query($conection,"SELECT SUM(horaext25+horaext50+horaext100) AS suma_hextr FROM nomina WHERE empleado = 'SANDOVAL JARAMILLO EDUARDO DAVID'");
                $row = mysqli_fetch_assoc($sql_registe);
                $sum = $row['suma_hextr'];
                echo number_format(($row['suma_hextr']),2,',', '.')  ;
                ?>
            </td>
            <td class="textright">
                <?php
                $sql_registe = mysqli_query($conection,"SELECT SUM(iesspatr) AS suma_iesspatr FROM nomina WHERE empleado = 'SANDOVAL JARAMILLO EDUARDO DAVID'");
                $row = mysqli_fetch_assoc($sql_registe);
                $sum = $row['suma_iesspatr'];
                echo number_format(($row['suma_iesspatr']),2,',', '.')  ;
                ?>
            </td>
            <td class="textright">
                <?php
                $sql_registe = mysqli_query($conection,"SELECT SUM(gasto13+gasto14+prov13+prov14) AS suma_decimos FROM nomina WHERE empleado = 'SANDOVAL JARAMILLO EDUARDO DAVID'");
                $row = mysqli_fetch_assoc($sql_registe);
                $sum = $row['suma_decimos'];
                echo number_format(($row['suma_decimos']),2,',', '.')  ;
                ?>
            </td>
            <td class="textright">
                <?php
                $sql_registe = mysqli_query($conection,"SELECT SUM(gastofr+provfr) AS suma_fondos FROM nomina WHERE empleado = 'SANDOVAL JARAMILLO EDUARDO DAVID'");
                $row = mysqli_fetch_assoc($sql_registe);
                $sum = $row['suma_fondos'];
                echo number_format(($row['suma_fondos']),2,',', '.')  ;
                ?>
            </td>
            <td class="textright"><?php
                $sql_registe = mysqli_query($conection,"SELECT SUM(sueldo+horaext25+horaext50+horaext100+iesspatr+
                    gasto13+gasto14+prov13+prov14+gastofr+provfr) AS suma_total FROM nomina WHERE empleado = 'SANDOVAL JARAMILLO EDUARDO DAVID'");
                $row = mysqli_fetch_assoc($sql_registe);
                $sum = $row['suma_total'];
                echo number_format(($row['suma_total']),2,',', '.')  ;
                ?></td>
        </tr>

        <?php
        $suma1 = mysqli_query($conection,"SELECT SUM(sueldo) as mtotal1 FROM nomina ");
        $row1 = mysqli_fetch_array($suma1,MYSQLI_ASSOC);
        $suma2 = mysqli_query($conection,"SELECT SUM(horaext25+horaext50+horaext100) as mtotal2 FROM nomina ");
        $row2 = mysqli_fetch_array($suma2,MYSQLI_ASSOC);
        $suma3 = mysqli_query($conection,"SELECT SUM(iesspatr) as mtotal3 FROM nomina ");
        $row3 = mysqli_fetch_array($suma3,MYSQLI_ASSOC);
        $suma4 = mysqli_query($conection,"SELECT SUM(gasto13+gasto14+prov13+prov14) as mtotal4 FROM nomina ");
        $row4 = mysqli_fetch_array($suma4,MYSQLI_ASSOC);
        $suma5 = mysqli_query($conection,"SELECT SUM(gastofr+provfr) as mtotal5 FROM nomina ");
        $row5 = mysqli_fetch_array($suma5,MYSQLI_ASSOC);
        $suma6 = mysqli_query($conection,"SELECT SUM(sueldo+horaext25+horaext50+horaext100+indemnizacion+
          iesspatr+gasto13+gasto14+prov13+prov14+gastofr+provfr) as mtotal6 FROM nomina ");
        $row6 = mysqli_fetch_array($suma6,MYSQLI_ASSOC);

        ?>
        <tr>
            <th>Total USD Nómina del: <?php echo date_format (new DateTime($fecha_de),'d-m-Y'); ?> - <?php echo date_format (new DateTime($fecha_a),'d-m-Y'); ?> </th>
            <th class="textright"><?php echo number_format(($row1["mtotal1"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row2["mtotal2"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row3["mtotal3"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row4["mtotal4"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row5["mtotal5"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row6["mtotal6"]),2,',', '.'); ?></th>

        </tr>

        <tr>
            <th> Total Registros Contabilizados: <?php
                $sql_registe = mysqli_query ($conection, "SELECT COUNT(*) as total_registro FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a' ");
                $result_register = mysqli_fetch_array ($sql_registe);
                $total_registro = $result_register ['total_registro'];
                echo $total_registro;
                ?> </th>
        </tr>

    </table>


</section>
<?php include "../../footer.php"; ?>
</body>

</html>