<?php
session_start();
include "../conexion.php";

$busqueda= '';
$fecha_de = '';
$fecha_a = '';

if (isset($_REQUEST['busqueda']) && $_REQUEST['busqueda']=='')
{
    header("location: nominageneral.php");
}
if (isset($_REQUEST['fecha_de']) || isset($_REQUEST['fecha_a']))
{
    if ($_REQUEST['fecha_de'] == '' || $_REQUEST['fecha_a'] == '' )
    {
        header("location: nominageneral.php");
    }
}



if(!empty($_REQUEST['busqueda'])){
    if (!is_numeric($_REQUEST['busqueda'])){
        header("location: nominageneral.php");
    }
    $busqueda = strtolower($_REQUEST['busqueda']);
    $where = "idEmpleado = $busqueda";
    $buscar = "busqueda = $busqueda";
}

if (!empty($_REQUEST['fecha_de']) && !empty($_REQUEST['fecha_a'])) {
    $fecha_de = $_REQUEST['fecha_de'];
    $fecha_a = $_REQUEST['fecha_a'];

    $buscar = '';

    if($fecha_de > $fecha_a){
        header("location: nominageneral.php");
    }else if ($fecha_de == $fecha_a){

        $where = "fecha LIKE '$fecha_de%'";
        $buscar = "fecha_de=$fecha_de&fecha_a=$fecha_a";

    }else{
        $f_de = $fecha_de.' 00:00:00';
        $f_a = $fecha_a.' 23:59:59';
        $where = "fecha BETWEEN '$f_de' AND '$f_a'";
        $buscar = "fecha_de=$fecha_de&fecha_a=$fecha_a";
    }

}





?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <title>Búsqueda Nómina General EA</title>
    <link rel="icon" href="../imagenesEA/logoestratega.png" type="image/x">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../css/jquery.min.js"></script>
    <script type="text/javascript" src="../css/functions.js"></script>

    <?php include "../../functions.php"; ?>

</head>
<body>

<?php include "../header.php"; ?>
<section id="container">

    <h1>&#128210; Nómina General por Fechas</h1><br><br>


    <div>
        <h5>Buscar Nómina General por Fechas</h5>
        <form action="buscar_nomina.php" method="get" class="form_search_date">
            <label>De:  </label>
            <input type="date" name="fecha_de" id="fecha_de" value="<?php echo $fecha_de; ?>" required>
            <label>A:  </label>
            <input type="date" name="fecha_a" id="fecha_a" value="<?php echo $fecha_a; ?>" required>
            <button type="submit" class="btn_view"><i>&#129488;</i></button>
        </form>
    </div>

    <table>
        <tr>
            <th>Empleado</th>
            <th>Fecha</th>
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
            <th>TOTAL A PAGAR USD</th>
        </tr>

        <?php
        //Paginador

        $sql_registe = mysqli_query($conection,"SELECT * FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        while($sistemas = mysqli_fetch_row($sql_registe)){
            ?>

            <tr>
                <td><?php echo $sistemas[2] ?></td>
                <td><?php echo date_format (new DateTime($sistemas[1]),'d-m-Y');?></td>
                <td class="textright"><?php echo $sistemas[3] ?></td>
                <td class="textright"><?php echo number_format(($sistemas[4] + $sistemas[5] + $sistemas[6]),2,',','.')?></td>
                <td class="textright"><?php echo $sistemas[8] ?></td>
                <td class="textright"><?php echo $sistemas[9] ?></td>
                <td class="textright"><?php echo $sistemas[10] ?></td>
                <td class="textright"><?php echo $sistemas[11] ?></td>
                <td class="textright"><?php echo $sistemas[12] ?></td>
                <td class="textright"><?php echo $sistemas[13] ?></td>
                <td class="textright"><?php echo $sistemas[14] ?></td>
                <td class="textright"><?php echo $sistemas[15] ?></td>
                <td class="textright"><?php echo $sistemas[16] ?></td>
                <td class="textright"><?php echo $sistemas[17] ?></td>
                <td class="textright"><?php echo $sistemas[18] ?></td>
                <td class="textright"><?php echo number_format(($sistemas[3] + $sistemas[4] + $sistemas[5] + $sistemas[6] +
                    $sistemas[7] - $sistemas[8] + $sistemas[10] + $sistemas[11] + $sistemas[12] +
                        - $sistemas[16] - $sistemas[17] - $sistemas[18]),2,',','.')?></td>
            </tr>


        <?php } ?>
        <?php
        $suma1 = mysqli_query($conection,"SELECT SUM(sueldo) as mtotal1 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row1 = mysqli_fetch_array($suma1,MYSQLI_ASSOC);
        $suma2 = mysqli_query($conection,"SELECT SUM(horaext25+horaext50+horaext100) as mtotal2 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row2 = mysqli_fetch_array($suma2,MYSQLI_ASSOC);
        $suma3 = mysqli_query($conection,"SELECT SUM(iesspers) as mtotal3 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row3 = mysqli_fetch_array($suma3,MYSQLI_ASSOC);
        $suma4 = mysqli_query($conection,"SELECT SUM(iesspatr) as mtotal4 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row4 = mysqli_fetch_array($suma4,MYSQLI_ASSOC);
        $suma5 = mysqli_query($conection,"SELECT SUM(gasto13) as mtotal5 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row5 = mysqli_fetch_array($suma5,MYSQLI_ASSOC);
        $suma6 = mysqli_query($conection,"SELECT SUM(gasto14) as mtotal6 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row6 = mysqli_fetch_array($suma6,MYSQLI_ASSOC);
        $suma7 = mysqli_query($conection,"SELECT SUM(gastofr) as mtotal7 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row7 = mysqli_fetch_array($suma7,MYSQLI_ASSOC);
        $suma8 = mysqli_query($conection,"SELECT SUM(prov13) as mtotal8 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row8 = mysqli_fetch_array($suma8,MYSQLI_ASSOC);
        $suma9 = mysqli_query($conection,"SELECT SUM(prov14) as mtotal9 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row9 = mysqli_fetch_array($suma9,MYSQLI_ASSOC);
        $suma10 = mysqli_query($conection,"SELECT SUM(provfr) as mtotal10 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row10 = mysqli_fetch_array($suma10,MYSQLI_ASSOC);
        $suma11= mysqli_query($conection,"SELECT SUM(anticipos) as mtotal11 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row11 = mysqli_fetch_array($suma11,MYSQLI_ASSOC);
        $suma12 = mysqli_query($conection,"SELECT SUM(prestamosqui) as mtotal12 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row12 = mysqli_fetch_array($suma12,MYSQLI_ASSOC);
        $suma13 = mysqli_query($conection,"SELECT SUM(prestamoship) as mtotal13 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row13 = mysqli_fetch_array($suma13,MYSQLI_ASSOC);
        $suma14 = mysqli_query($conection,"SELECT SUM(sueldo+horaext25+horaext50+horaext100+indemnizacion-
          iesspers+gasto13+gasto14+gastofr-anticipos-prestamosqui-prestamoship) as mtotal14 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row14 = mysqli_fetch_array($suma14,MYSQLI_ASSOC);

        ?>
        <tr>
            <th>Total USD Nómina de: <?php echo date_format (new DateTime($fecha_de),'d-m-Y'); ?> - <?php echo date_format (new DateTime($fecha_a),'d-m-Y'); ?> </th>
            <th></th>
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

        <tr>
            <th> Total Empleados Contabilizados: <?php
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