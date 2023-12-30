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

    <title>Reporte Compras EA</title>
    <link rel="icon" href="../imagenesEA/logoestratega.png" type="image/x">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../css/jquery.min.js"></script>
    <script type="text/javascript" src="../css/functions.js"></script>

    <?php include "../../functions.php"; ?>

</head>
<body>

<?php include "../header.php"; ?>
<section id="container">

    <h1>&#128210; Reporte de Compras</h1><br><br>


    <div>
        <h5>Buscar Compras por Fechas</h5><br>

        <form action="buscar_compra.php" method="get" class="form_search_date">
            <label>De:  </label>
            <input type="date" name="fecha_de" id="fecha_de" value="<?php echo $fecha_de; ?>" required>
            <label>A:  </label>
            <input type="date" name="fecha_a" id="fecha_a" value="<?php echo $fecha_a; ?>" required>
            <button type="submit" class="btn_view"><i>&#129488;</i></button>
        </form>
    </div>

    <table>
        <tr>
            <th class="textright">Establ.</th>
            <th class="textright">P.Emis.</th>
            <th class="textright">Factura No</th>
            <th>Fecha</th>
            <th>Proveedor</th>
            <th class="textright">Autorización SRI No.</th>
            <th class="textright">No Objeto Iva</th>
            <th class="textright">Iva 0%</th>
            <th class="textright">Base Iva12</th>
            <th class="textright">IVA 12%</th>
            <th>F.Pago</th>
            <th>F.Física</th>
        </tr>

        <?php
        //Paginador

        $sql_registe = mysqli_query($conection,"SELECT * FROM facturaC WHERE fechadeemis BETWEEN '$fecha_de' AND '$fecha_a'");
        while($sistemas = mysqli_fetch_row($sql_registe)){
            ?>

            <tr>
                <td class="textright"><?php echo $sistemas[3] ?></td>
                <td class="textright"><?php echo $sistemas[4] ?></td>
                <td class="textright"><?php echo $sistemas[5] ?></td>
                <td><?php echo date_format (new DateTime($sistemas[2]),'d-m-Y');?></td>
                <td><?php echo $sistemas[1] ?></td>
                <td><?php echo $sistemas[6] ?></td>
                <td class="textright"><?php echo number_format(($sistemas[7] ),2,',','.')?></td>
                <td class="textright"><?php echo number_format(($sistemas[8] ),2,',','.') ?></td>
                <td class="textright"><?php echo number_format(($sistemas[9] ),2,',','.') ?></td>
                <td class="textright"><?php echo number_format(($sistemas[10] ),2,',','.') ?></td>
                <td><?php echo $sistemas[11] ?></td>
                <td><img src=" <?php echo $sistemas[14] ?>"  width="50" height="50" alt="" srcset="" ></td>
            </tr>


        <?php } ?>
        <?php
        $suma1 = mysqli_query($conection,"SELECT SUM(noobjetoiva) as mtotal1 FROM facturaC WHERE fechadeemis BETWEEN '$fecha_de' AND '$fecha_a'");
        $row1 = mysqli_fetch_array($suma1,MYSQLI_ASSOC);
        $suma2 = mysqli_query($conection,"SELECT SUM(ivacero) as mtotal2 FROM facturaC WHERE fechadeemis BETWEEN '$fecha_de' AND '$fecha_a'");
        $row2 = mysqli_fetch_array($suma2,MYSQLI_ASSOC);
        $suma3 = mysqli_query($conection,"SELECT SUM(baseiva) as mtotal3 FROM facturaC WHERE fechadeemis BETWEEN '$fecha_de' AND '$fecha_a'");
        $row3 = mysqli_fetch_array($suma3,MYSQLI_ASSOC);
        $suma4 = mysqli_query($conection,"SELECT SUM(ivacompras) as mtotal4 FROM facturaC WHERE fechadeemis BETWEEN '$fecha_de' AND '$fecha_a'");
        $row4 = mysqli_fetch_array($suma4,MYSQLI_ASSOC);
        ?>
        <tr>
            <th>Total USD Compras de: <?php echo date_format (new DateTime($fecha_de), 'd-m-Y'); ?> - <?php echo date_format (new DateTime($fecha_a), 'd-m-Y'); ?> </th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th class="textright"><?php echo number_format(($row1["mtotal1"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row2["mtotal2"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row3["mtotal3"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row4["mtotal4"]),2,',', '.'); ?></th>

        </tr>

        <tr>
            <th> Total Facturas Recibidas: <?php
                $sql_registe = mysqli_query ($conection, "SELECT COUNT(*) as total_registro FROM facturaC WHERE fechadeemis BETWEEN '$fecha_de' AND '$fecha_a'");
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