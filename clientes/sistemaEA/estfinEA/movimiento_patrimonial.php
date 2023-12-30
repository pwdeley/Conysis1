<?php
session_start();
include "../conexion.php";

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <title>Movimiento Patrimonial EA</title>
    <link rel="icon" href="../imagenesEA/logoestratega.png" type="image/x">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../css/jquery.min.js"></script>
    <script type="text/javascript" src="../css/functions.js"></script>

    <?php include "../../functions.php"; ?>

</head>
<body>

<?php include "../header.php"; ?>
<section id="container">

    <h1>&#128210; Movimiento Patrimonial EA 2018</h1><br><br>

    <table>
        <tr>
            <th>Fecha Mov.</th>
            <th>Movimiento</th>
            <th>Capital(301)</th>
            <th>Reserva Legal (30401)</th>
            <th>Ganancias Acumuladas (30601)</th>
            <th>- Pérdidas Acumuladas (30602)</th>
            <th>Ganancia Neta Período (30701)</th>
            <th>- Pérdida Neta Período (30702)</th>
            <th>TOTAL PATRIMONIO</th>
        </tr>

        <?php

        $sql_registe = mysqli_query($conection,"SELECT * FROM movpatrim WHERE fechapatrim BETWEEN '2018-07-29' AND '2018-12-31' ");
        while($sistemas = mysqli_fetch_row($sql_registe)){
            ?>

            <tr>
                <td><?php echo date_format (new DateTime($sistemas[1]),'d-m-Y');?></td>
                <td><?php echo $sistemas[2] ?></td>
                <td class="textright"><?php echo number_format($sistemas[3],2,',','.'); ?></td>
                <td class="textright"><?php echo number_format($sistemas[4],2,',','.'); ?></td>
                <td class="textright"><?php echo number_format($sistemas[5],2,',','.'); ?></td>
                <td class="textright"><?php echo number_format($sistemas[6],2,',','.'); ?></td>
                <td class="textright"><?php echo number_format($sistemas[7],2,',','.'); ?></td>
                <td class="textright"><?php echo number_format($sistemas[8],2,',','.'); ?></td>
                <td class="textright"><?php echo number_format($sistemas[3] + $sistemas[4] + $sistemas[5] - $sistemas[6] + $sistemas[7] - $sistemas[8],2,',','.'); ?></td>

            </tr>


        <?php } ?>
        <?php
        $suma1 = mysqli_query($conection,"SELECT SUM(capital) as mtotal1 FROM movpatrim WHERE fechapatrim BETWEEN '2018-07-29' AND '2018-12-31'");
        $row1 = mysqli_fetch_array($suma1,MYSQLI_ASSOC);
        $suma2 = mysqli_query($conection,"SELECT SUM(reservalegal) as mtotal2 FROM movpatrim WHERE fechapatrim BETWEEN '2018-07-29' AND '2018-12-31'");
        $row2 = mysqli_fetch_array($suma2,MYSQLI_ASSOC);
        $suma3 = mysqli_query($conection,"SELECT SUM(ganacuml) as mtotal3 FROM movpatrim WHERE fechapatrim BETWEEN '2018-07-29' AND '2018-12-31' ");
        $row3 = mysqli_fetch_array($suma3,MYSQLI_ASSOC);
        $suma4 = mysqli_query($conection,"SELECT SUM(perdacml) as mtotal4 FROM movpatrim WHERE fechapatrim BETWEEN '2018-07-29' AND '2018-12-31' ");
        $row4 = mysqli_fetch_array($suma4,MYSQLI_ASSOC);
        $suma5 = mysqli_query($conection,"SELECT SUM(ganejer) as mtotal5 FROM movpatrim WHERE fechapatrim BETWEEN '2018-07-29' AND '2018-12-31' ");
        $row5 = mysqli_fetch_array($suma5,MYSQLI_ASSOC);
        $suma6 = mysqli_query($conection,"SELECT SUM(perdejer) as mtotal6 FROM movpatrim WHERE fechapatrim BETWEEN '2018-07-29' AND '2018-12-31' ");
        $row6 = mysqli_fetch_array($suma6,MYSQLI_ASSOC);
        ?>

        <tr>
            <th>Total Movimiento </th>
            <th>Ptrimonial USD: </th>
            <th class="textright"><?php echo number_format($row1["mtotal1"],2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format($row2["mtotal2"],2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format($row3["mtotal3"],2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(-$row4["mtotal4"],2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format($row5["mtotal5"],2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(-$row6["mtotal6"],2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row1["mtotal1"]+$row2["mtotal2"]+$row3["mtotal3"]-$row4["mtotal4"]+$row5["mtotal5"]-$row6["mtotal6"]),2,',', '.'); ?></th>
        </tr>


    </table>
<br><br>

    <h1>&#128210; Movimiento Patrimonial EA 2019</h1><br><br>
    <table>
        <tr>
            <th>Fecha Mov.</th>
            <th>Movimiento</th>
            <th>Capital(301)</th>
            <th>Reserva Legal (30401)</th>
            <th>Ganancias Acumuladas (30601)</th>
            <th>- Pérdidas Acumuladas (30602)</th>
            <th>Ganancia Neta Período (30701)</th>
            <th>- Pérdida Neta Período (30702)</th>
            <th>TOTAL PATRIMONIO</th>
        </tr>

        <?php

        $sql_registe = mysqli_query($conection,"SELECT * FROM movpatrim WHERE fechapatrim BETWEEN '2019-01-01' AND '2019-12-31' ");
        while($sistemas = mysqli_fetch_row($sql_registe)){
            ?>

            <tr>
                <td><?php echo date_format (new DateTime($sistemas[1]),'d-m-Y');?></td>
                <td><?php echo $sistemas[2] ?></td>
                <td class="textright"><?php echo number_format($sistemas[3],2,',','.'); ?></td>
                <td class="textright"><?php echo number_format($sistemas[4],2,',','.'); ?></td>
                <td class="textright"><?php echo number_format($sistemas[5],2,',','.'); ?></td>
                <td class="textright"><?php echo number_format($sistemas[6],2,',','.'); ?></td>
                <td class="textright"><?php echo number_format($sistemas[7],2,',','.'); ?></td>
                <td class="textright"><?php echo number_format($sistemas[8],2,',','.'); ?></td>
                <td class="textright"><?php echo number_format($sistemas[3] + $sistemas[4] + $sistemas[5] - $sistemas[6] + $sistemas[7] - $sistemas[8],2,',','.'); ?></td>

            </tr>


        <?php } ?>
        <?php
        $suma1 = mysqli_query($conection,"SELECT SUM(capital) as mtotal1 FROM movpatrim WHERE fechapatrim BETWEEN '2018-07-29' AND '2019-12-31'");
        $row1 = mysqli_fetch_array($suma1,MYSQLI_ASSOC);
        $suma2 = mysqli_query($conection,"SELECT SUM(reservalegal) as mtotal2 FROM movpatrim WHERE fechapatrim BETWEEN '2019-01-01' AND '2019-12-31'");
        $row2 = mysqli_fetch_array($suma2,MYSQLI_ASSOC);
        $suma3 = mysqli_query($conection,"SELECT SUM(ganacuml) as mtotal3 FROM movpatrim WHERE fechapatrim BETWEEN '2019-01-01' AND '2019-12-31' ");
        $row3 = mysqli_fetch_array($suma3,MYSQLI_ASSOC);
        $suma4 = mysqli_query($conection,"SELECT SUM(perdacml) as mtotal4 FROM movpatrim WHERE fechapatrim BETWEEN '2019-01-01' AND '2019-12-31' ");
        $row4 = mysqli_fetch_array($suma4,MYSQLI_ASSOC);
        $suma5 = mysqli_query($conection,"SELECT SUM(ganejer) as mtotal5 FROM movpatrim WHERE fechapatrim BETWEEN '2019-01-01' AND '2019-12-31' ");
        $row5 = mysqli_fetch_array($suma5,MYSQLI_ASSOC);
        $suma6 = mysqli_query($conection,"SELECT SUM(perdejer) as mtotal6 FROM movpatrim WHERE fechapatrim BETWEEN '2019-01-01' AND '2019-12-31' ");
        $row6 = mysqli_fetch_array($suma6,MYSQLI_ASSOC);
        ?>

        <tr>
            <th>Total Movimiento </th>
            <th>Ptrimonial USD: </th>
            <th class="textright"><?php echo number_format($row1["mtotal1"],2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format($row2["mtotal2"],2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format($row3["mtotal3"],2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(-$row4["mtotal4"],2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format($row5["mtotal5"],2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(-$row6["mtotal6"],2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row1["mtotal1"]+$row2["mtotal2"]+$row3["mtotal3"]-$row4["mtotal4"]+$row5["mtotal5"]-$row6["mtotal6"]),2,',', '.'); ?></th>
        </tr>


    </table>


    <br><br>

    <h1>&#128210; Movimiento Patrimonial EA 2020</h1><br><br>
    <table>
        <tr>
            <th>Fecha Mov.</th>
            <th>Movimiento</th>
            <th>Capital(301)</th>
            <th>Reserva Legal (30401)</th>
            <th>Ganancias Acumuladas (30601)</th>
            <th>- Pérdidas Acumuladas (30602)</th>
            <th>Ganancia Neta Período (30701)</th>
            <th>- Pérdida Neta Período (30702)</th>
            <th>TOTAL PATRIMONIO</th>
        </tr>

        <?php

        $sql_registe = mysqli_query($conection,"SELECT * FROM movpatrim WHERE fechapatrim BETWEEN '2020-01-01' AND '2020-12-31' ");
        while($sistemas = mysqli_fetch_row($sql_registe)){
            ?>

            <tr>
                <td><?php echo date_format (new DateTime($sistemas[1]),'d-m-Y');?></td>
                <td><?php echo $sistemas[2] ?></td>
                <td class="textright"><?php echo number_format($sistemas[3],2,',','.'); ?></td>
                <td class="textright"><?php echo number_format($sistemas[4],2,',','.'); ?></td>
                <td class="textright"><?php echo number_format($sistemas[5],2,',','.'); ?></td>
                <td class="textright"><?php echo number_format($sistemas[6],2,',','.'); ?></td>
                <td class="textright"><?php echo number_format($sistemas[7],2,',','.'); ?></td>
                <td class="textright"><?php echo number_format($sistemas[8],2,',','.'); ?></td>
                <td class="textright"><?php echo number_format($sistemas[3] + $sistemas[4] + $sistemas[5] - $sistemas[6] + $sistemas[7] - $sistemas[8],2,',','.'); ?></td>

            </tr>


        <?php } ?>
        <?php
        $suma1 = mysqli_query($conection,"SELECT SUM(capital) as mtotal1 FROM movpatrim WHERE fechapatrim BETWEEN '2018-07-29' AND '2020-12-31'");
        $row1 = mysqli_fetch_array($suma1,MYSQLI_ASSOC);
        $suma2 = mysqli_query($conection,"SELECT SUM(reservalegal) as mtotal2 FROM movpatrim WHERE fechapatrim BETWEEN '2020-01-01' AND '2020-12-31'");
        $row2 = mysqli_fetch_array($suma2,MYSQLI_ASSOC);
        $suma3 = mysqli_query($conection,"SELECT SUM(ganacuml) as mtotal3 FROM movpatrim WHERE fechapatrim BETWEEN '2019-01-01' AND '2020-12-31' ");
        $row3 = mysqli_fetch_array($suma3,MYSQLI_ASSOC);
        $suma4 = mysqli_query($conection,"SELECT SUM(perdacml) as mtotal4 FROM movpatrim WHERE fechapatrim BETWEEN '2019-01-01' AND '2020-12-31' ");
        $row4 = mysqli_fetch_array($suma4,MYSQLI_ASSOC);
        $suma5 = mysqli_query($conection,"SELECT SUM(ganejer) as mtotal5 FROM movpatrim WHERE fechapatrim BETWEEN '2020-01-01' AND '2020-12-31' ");
        $row5 = mysqli_fetch_array($suma5,MYSQLI_ASSOC);
        $suma6 = mysqli_query($conection,"SELECT SUM(perdejer) as mtotal6 FROM movpatrim WHERE fechapatrim BETWEEN '2020-01-01' AND '2020-12-31' ");
        $row6 = mysqli_fetch_array($suma6,MYSQLI_ASSOC);
        ?>

        <tr>
            <th>Total Movimiento </th>
            <th>Ptrimonial USD: </th>
            <th class="textright"><?php echo number_format($row1["mtotal1"],2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format($row2["mtotal2"],2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format($row3["mtotal3"],2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(-$row4["mtotal4"],2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format($row5["mtotal5"],2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(-$row6["mtotal6"],2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row1["mtotal1"]+$row2["mtotal2"]+$row3["mtotal3"]-$row4["mtotal4"]+$row5["mtotal5"]-$row6["mtotal6"]),2,',', '.'); ?></th>
        </tr>


    </table>



    <br><br>

    <h1>&#128210; Movimiento Patrimonial EA 2021</h1><br><br>
    <table>
        <tr>
            <th>Fecha Mov.</th>
            <th>Movimiento</th>
            <th>Capital(301)</th>
            <th>Reserva Legal (30401)</th>
            <th>Ganancias Acumuladas (30601)</th>
            <th>- Pérdidas Acumuladas (30602)</th>
            <th>Ganancia Neta Período (30701)</th>
            <th>- Pérdida Neta Período (30702)</th>
            <th>TOTAL PATRIMONIO</th>
        </tr>

        <?php

        $sql_registe = mysqli_query($conection,"SELECT * FROM movpatrim WHERE fechapatrim BETWEEN '2021-01-01' AND '2021-12-31' ");
        while($sistemas = mysqli_fetch_row($sql_registe)){
            ?>

            <tr>
                <td><?php echo date_format (new DateTime($sistemas[1]),'d-m-Y');?></td>
                <td><?php echo $sistemas[2] ?></td>
                <td class="textright"><?php echo number_format($sistemas[3],2,',','.'); ?></td>
                <td class="textright"><?php echo number_format($sistemas[4],2,',','.'); ?></td>
                <td class="textright"><?php echo number_format($sistemas[5],2,',','.'); ?></td>
                <td class="textright"><?php echo number_format($sistemas[6],2,',','.'); ?></td>
                <td class="textright"><?php echo number_format($sistemas[7],2,',','.'); ?></td>
                <td class="textright"><?php echo number_format($sistemas[8],2,',','.'); ?></td>
                <td class="textright"><?php echo number_format($sistemas[3] + $sistemas[4] + $sistemas[5] - $sistemas[6] + $sistemas[7] - $sistemas[8],2,',','.'); ?></td>

            </tr>


        <?php } ?>
        <?php
        $suma1 = mysqli_query($conection,"SELECT SUM(capital) as mtotal1 FROM movpatrim WHERE fechapatrim BETWEEN '2018-07-29' AND '2021-12-31'");
        $row1 = mysqli_fetch_array($suma1,MYSQLI_ASSOC);
        $suma2 = mysqli_query($conection,"SELECT SUM(reservalegal) as mtotal2 FROM movpatrim WHERE fechapatrim BETWEEN '2019-01-01' AND '2021-12-31'");
        $row2 = mysqli_fetch_array($suma2,MYSQLI_ASSOC);
        $suma3 = mysqli_query($conection,"SELECT SUM(ganacuml) as mtotal3 FROM movpatrim WHERE fechapatrim BETWEEN '2019-01-01' AND '2021-12-31' ");
        $row3 = mysqli_fetch_array($suma3,MYSQLI_ASSOC);
        $suma4 = mysqli_query($conection,"SELECT SUM(perdacml) as mtotal4 FROM movpatrim WHERE fechapatrim BETWEEN '2019-01-01' AND '2021-12-31' ");
        $row4 = mysqli_fetch_array($suma4,MYSQLI_ASSOC);
        $suma5 = mysqli_query($conection,"SELECT SUM(ganejer) as mtotal5 FROM movpatrim WHERE fechapatrim BETWEEN '2021-01-01' AND '2021-12-31' ");
        $row5 = mysqli_fetch_array($suma5,MYSQLI_ASSOC);
        $suma6 = mysqli_query($conection,"SELECT SUM(perdejer) as mtotal6 FROM movpatrim WHERE fechapatrim BETWEEN '2021-01-01' AND '2021-12-31' ");
        $row6 = mysqli_fetch_array($suma6,MYSQLI_ASSOC);
        ?>

        <tr>
            <th>Total Movimiento </th>
            <th>Ptrimonial USD: </th>
            <th class="textright"><?php echo number_format($row1["mtotal1"],2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format($row2["mtotal2"],2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format($row3["mtotal3"],2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(-$row4["mtotal4"],2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format($row5["mtotal5"],2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(-$row6["mtotal6"],2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row1["mtotal1"]+$row2["mtotal2"]+$row3["mtotal3"]-$row4["mtotal4"]+$row5["mtotal5"]-$row6["mtotal6"]),2,',', '.'); ?></th>
        </tr>


    </table>

</section>
<?php include "../../footer.php"; ?>
</body>

</html>
