<?php
session_start();
include "../conexion.php";

$busqueda= '';
$fecha_de = '';
$fecha_a = '';

if (isset($_REQUEST['busqueda']) && $_REQUEST['busqueda']=='')
{
    header("location: lista_retencion.php");
}
if (isset($_REQUEST['fecha_de']) || isset($_REQUEST['fecha_a']))
{
    if ($_REQUEST['fecha_de'] == '' || $_REQUEST['fecha_a'] == '' )
    {
        header("location: lista_retencion.php");
    }
}



if(!empty($_REQUEST['busqueda'])){
    if (!is_numeric($_REQUEST['busqueda'])){
        header("location: lista_retencion.php");
    }
    $busqueda = strtolower($_REQUEST['busqueda']);
    $where = "noretencion = $busqueda";
    $buscar = "busqueda = $busqueda";
}

if (!empty($_REQUEST['fecha_de']) && !empty($_REQUEST['fecha_a'])) {
    $fecha_de = $_REQUEST['fecha_de'];
    $fecha_a = $_REQUEST['fecha_a'];

    $buscar = '';

    if($fecha_de > $fecha_a){
        header("location: lista_retencion.php");
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

    <title>Retenciones por Fechas EA</title>
    <link rel="icon" href="../imagenesEA/logoestratega.png" type="image/x">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../css/jquery.min.js"></script>
    <script type="text/javascript" src="../css/functions.js"></script>

    <?php include "../../functions.php"; ?>

</head>
<body>

<?php include "../header.php"; ?>
<section id="container">

    <h1>&#128210; Reporte de Retenciones por Fechas</h1><br><br>


    <div>
        <h4>Buscar Retenciones por Fechas</h4><br>

        <form action="buscar_retencion.php" method="get" class="form_search_date">
            <label>De:  </label>
            <input type="date" name="fecha_de" id="fecha_de" value="<?php echo $fecha_de; ?>" required>
            <label>A:  </label>
            <input type="date" name="fecha_a" id="fecha_a" value="<?php echo $fecha_a; ?>" required>
            <button type="submit" class="btn_view"><i>&#129488;</i></button>
        </form>
    </div>
<br>
    <table>
        <tr>
            <th>Retencion No.</th>
            <th>Fecha</th>
            <th>Agente de Retención</th>
            <th class="textright">Base Imponible</th>
            <th class="textright">Ret.IVA 70%</th>
            <th class="textright">Ret.Renta 2%</th>
            <th class="textright">Archivo</th>

        </tr>

        <?php
        //Paginador

        $sql_registe = mysqli_query($conection,"SELECT * FROM retenciones WHERE fechaemis BETWEEN '$fecha_de' AND '$fecha_a'");
        while($sistemas = mysqli_fetch_row($sql_registe)){
            ?>

            <tr>
                <td class="textright"><?php echo $sistemas[3] ?></td>
                <td><?php echo date_format (new DateTime($sistemas[2]),'d-m-Y');?></td>
                <td><?php
                    if ($sistemas[1]=="1790283380001") {
                        echo "BANCO DINERS CLUB DEL ECUADOR S.A.";
                    }elseif ($sistemas[1]=="0190055965001"){
                        echo "BANCO DEL AUSTRO S.A.";
                    }elseif ($sistemas[1]=="0990005737001"){
                        echo "BANCO DEL PACIFICO S.A.";
                    }elseif ($sistemas[1]=="0990049459001"){
                        echo "BANCO GUAYAQUIL S.A.";
                    }elseif ($sistemas[1]=="1790010937001"){
                        echo "BANCO PICHINCHA CA";

                    }else{
                        echo "Agente de retención No identificado";
                    }

                    ?></td>
                <td class="textright"><?php echo number_format(($sistemas[5] ),2,',','.')?></td>
                <td class="textright"><?php echo number_format(($sistemas[6] ),2,',','.') ?></td>
                <td class="textright"><?php echo number_format(($sistemas[7] ),2,',','.') ?></td>
                <td><img src=" <?php echo $sistemas[8] ?>" width="50" height="50" alt="" srcset=""></td>
            </tr>


        <?php } ?>
        <?php
        $suma1 = mysqli_query($conection,"SELECT SUM(baseimp) as mtotal1 FROM retenciones WHERE fechaemis BETWEEN '$fecha_de' AND '$fecha_a'");
        $row1 = mysqli_fetch_array($suma1,MYSQLI_ASSOC);
        $suma2 = mysqli_query($conection,"SELECT SUM(riva70) as mtotal2 FROM retenciones WHERE fechaemis BETWEEN '$fecha_de' AND '$fecha_a'");
        $row2 = mysqli_fetch_array($suma2,MYSQLI_ASSOC);
        $suma3 = mysqli_query($conection,"SELECT SUM(rir2) as mtotal3 FROM retenciones WHERE fechaemis BETWEEN '$fecha_de' AND '$fecha_a'");
        $row3 = mysqli_fetch_array($suma3,MYSQLI_ASSOC);

        ?>
        <tr>
            <th>Total USD Retenciones de: <?php echo date_format (new DateTime($fecha_de), 'd-m-Y'); ?> - <?php echo date_format (new DateTime($fecha_a), 'd-m-Y'); ?> </th>
            <th></th>
            <th></th>
            <th class="textright"><?php echo number_format(($row1["mtotal1"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row2["mtotal2"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row3["mtotal3"]),2,',', '.'); ?></th>

        </tr>

        <tr>
            <th> Total Retenciones Recibidas: <?php
                $sql_registe = mysqli_query ($conection, "SELECT COUNT(*) as total_registro FROM retenciones WHERE fechaemis BETWEEN '$fecha_de' AND '$fecha_a'");
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