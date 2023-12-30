<?php
session_start();
include "../conexion.php";

$busqueda= '';
$fecha_de = '';
$fecha_a = '';

if (isset($_REQUEST['busqueda']) && $_REQUEST['busqueda']=='')
{
    header("location: lista_ventas.php");
}
if (isset($_REQUEST['fecha_de']) || isset($_REQUEST['fecha_a']))
{
    if ($_REQUEST['fecha_de'] == '' || $_REQUEST['fecha_a'] == '' )
    {
        header("location: lista_ventas.php");
    }
}



if(!empty($_REQUEST['busqueda'])){
    if (!is_numeric($_REQUEST['busqueda'])){
        header("location: lista_ventas.php");
    }
    $busqueda = strtolower($_REQUEST['busqueda']);
    $where = "nofactura = $busqueda";
    $buscar = "busqueda = $busqueda";
}

if (!empty($_REQUEST['fecha_de']) && !empty($_REQUEST['fecha_a'])) {
    $fecha_de = $_REQUEST['fecha_de'];
    $fecha_a = $_REQUEST['fecha_a'];

    $buscar = '';

    if($fecha_de > $fecha_a){
        header("location: lista_ventas.php");
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

    <title>Reporte Facturación EA</title>
    <link rel="icon" href="../imagenesEA/logoestratega.png" type="image/x">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../css/jquery.min.js"></script>
    <script type="text/javascript" src="../css/functions.js"></script>

    <?php include "../../functions.php"; ?>

</head>
<body>

<?php include "../header.php"; ?>
<section id="container">

    <h1>&#128210; Reporte de Ventas</h1><br><br>


    <div>
        <h5>Buscar Facturas por Fechas</h5>
        <form action="buscar_venta.php" method="get" class="form_search_date">
            <label>De:  </label>
            <input type="date" name="fecha_de" id="fecha_de" value="<?php echo $fecha_de; ?>" required>
            <label>A:  </label>
            <input type="date" name="fecha_a" id="fecha_a" value="<?php echo $fecha_a; ?>" required>
            <button type="submit" class="btn_view"><i>&#129488;</i></button>
        </form>
    </div>

    <table>
        <tr>
            <th>Factura No. 001-001</th>
            <th>Fecha</th>
            <th>RUC Cliente</th>
            <th>Forma de Cobro</th>
            <th>Retc.Rta.</th>
            <th>Retc.IVA</th>
            <th class="textright">Subtotal Factura</th>
            <th class="textright">IVA</th>
            <th>F.Física</th>
        </tr>

        <?php
        //Paginador

        $sql_registe = mysqli_query($conection,"SELECT * FROM facturaV WHERE fechaemis BETWEEN '$fecha_de' AND '$fecha_a' AND estatus = 1");
        while($sistemas = mysqli_fetch_row($sql_registe)){
            ?>

            <tr>
                <td><?php echo $sistemas[2] ?></td>
                <td><?php echo date_format (new DateTime($sistemas[1]),'d-m-Y');?></td>
                <td><?php echo $sistemas[3] ?></td>
                <td><?php echo $sistemas[11] ?></td>
                <td class="textright"><?php
                    if($sistemas[11] == 'Tarjeta'){
                    echo number_format((($sistemas[7] * $sistemas[8])+($sistemas[9] * $sistemas[10]))*0.02,2,',','.')
                    ?>
                </td>
                <?php
                }
                ?>
                <td class="textright"><?php
                    if ($sistemas[11] == 'Tarjeta'){
                    echo number_format((($sistemas[7] * $sistemas[8])+($sistemas[9] * $sistemas[10]))*0.12*.7,2,',','.')
                    ?>
                </td>
            <?php
            }
            ?>
                <td class="textright"><?php echo number_format(($sistemas[7] * $sistemas[8])+($sistemas[9] * $sistemas[10]),2,',','.')?></td>
                <td class="textright"><?php
                    if($sistemas[5] == '45'){
                        echo number_format( (($sistemas[7] * $sistemas[8])+($sistemas[9] * $sistemas[10]))*0,2,',','.');
                    }else{
                        echo number_format( (($sistemas[7] * $sistemas[8])+($sistemas[9] * $sistemas[10]))*0.12,2,',','.'); } ?></td>
                <?php
                $query = mysqli_query($conection,"SELECT * FROM facturav WHERE fechaemis BETWEEN '$fecha_de' AND '$fecha_a' AND 'estatus' = '1'");
                while ($fila=mysqli_fetch_array($query)){

                    ?>
                    <td><?php echo $sistemas[12] ?></td>
                <?php } ?>

            </tr>


        <?php } ?>
        <?php
        $suma1 = mysqli_query($conection,"SELECT SUM(precio1*cantidad1) as mtotal1 FROM facturaV WHERE fechaemis BETWEEN '$fecha_de' AND '$fecha_a'");
        $row1 = mysqli_fetch_array($suma1,MYSQLI_ASSOC);
        $suma2 = mysqli_query($conection,"SELECT SUM(precio2*cantidad2) as mtotal2 FROM facturaV WHERE fechaemis BETWEEN '$fecha_de' AND '$fecha_a'");
        $row2 = mysqli_fetch_array($suma2,MYSQLI_ASSOC);
        $suma3 = mysqli_query($conection,"SELECT SUM(precio1*cantidad1) as miva1 FROM facturaV WHERE fechaemis BETWEEN '$fecha_de' AND '$fecha_a' AND codprod1 != '45'");
        $row3 = mysqli_fetch_array($suma3,MYSQLI_ASSOC);
        $suma4 = mysqli_query($conection,"SELECT SUM(precio2*cantidad2) as miva2 FROM facturaV WHERE fechaemis BETWEEN '$fecha_de' AND '$fecha_a' AND codprod2 != '45'");
        $row4 = mysqli_fetch_array($suma4,MYSQLI_ASSOC);
        $suma5 = mysqli_query($conection,"SELECT SUM(precio1*cantidad1*0.02) as mtotal5 FROM facturaV WHERE fechaemis BETWEEN '$fecha_de' AND '$fecha_a' AND formacobro != 'Efectivo'");
        $row5 = mysqli_fetch_array($suma5,MYSQLI_ASSOC);
        $suma6 = mysqli_query($conection,"SELECT SUM(precio2*cantidad2*0.02) as mtotal6 FROM facturaV WHERE fechaemis BETWEEN '$fecha_de' AND '$fecha_a' AND formacobro != 'Efectivo'");
        $row6 = mysqli_fetch_array($suma6,MYSQLI_ASSOC);
        $suma7 = mysqli_query($conection,"SELECT SUM(precio1*cantidad1*0.12*0.7) as mtotal7 FROM facturaV WHERE fechaemis BETWEEN '$fecha_de' AND '$fecha_a' AND formacobro != 'Efectivo'");
        $row7 = mysqli_fetch_array($suma7,MYSQLI_ASSOC);
        $suma8 = mysqli_query($conection,"SELECT SUM(precio2*cantidad2*0.12*0.7) as mtotal8 FROM facturaV WHERE fechaemis BETWEEN '$fecha_de' AND '$fecha_a' AND formacobro != 'Efectivo'");
        $row8 = mysqli_fetch_array($suma8,MYSQLI_ASSOC);


        ?>
        <tr>
            <th>Total USD Facturas de: <?php echo date_format (new DateTime($fecha_de),'d-m-Y');?> - <?php echo date_format (new DateTime($fecha_a),'d-m-Y');?> </th>
            <th></th>
            <th></th>
            <th></th>
            <th class="textright"><?php echo number_format(($row5["mtotal5"]+$row6["mtotal6"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row7["mtotal7"]+$row8["mtotal8"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row1["mtotal1"]+$row2["mtotal2"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format((($row3["miva1"]+$row4["miva2"])*0.12),2,',', '.'); ?></th>
        </tr>

        <tr>
            <th>Total Facturas emitidas: <?php
                $sql_registe = mysqli_query($conection,"SELECT COUNT(*) as total_registro FROM facturaV WHERE fechaemis BETWEEN '$fecha_de' AND '$fecha_a'AND estatus=1");
                $result_register = mysqli_fetch_array($sql_registe);
                $total_registro = $result_register['total_registro'];
                echo $total_registro;
                ?> </th>
        </tr>
        <tr>
            <th>Total Facturas anuladas: <?php
                $sql_registe = mysqli_query($conection,"SELECT COUNT(*) as total_registro FROM facturaV WHERE fechaemis BETWEEN '$fecha_de' AND '$fecha_a' AND estatus=0");
                $result_register = mysqli_fetch_array($sql_registe);
                $total_registro = $result_register['total_registro'];
                echo $total_registro;
                ?> </th>
        </tr>
        <tr>
            <th>Facturas anuladas: <?php
                $sql_registe = mysqli_query($conection,"SELECT * FROM facturaV WHERE fechaemis BETWEEN '$fecha_de' AND '$fecha_a' AND estatus=0");
                while($sistemas = mysqli_fetch_row($sql_registe)){
                ?> </th>

        </tr>
        <td><?php echo $sistemas[2] ?></td>
    <?php } ?>

    </table>

</section>
<?php include "../../footer.php"; ?>
</body>

</html>
