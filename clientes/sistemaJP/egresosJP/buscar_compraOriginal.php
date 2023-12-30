<?php

session_start();
include "../conexion.php";


$busqueda= '';
$fecha_de = '';
$fecha_a = '';

if (isset($_REQUEST['busqueda']) && $_REQUEST['busqueda']=='')
{
    header("location: lista_compras.php");
}
if (isset($_REQUEST['fecha_de']) || isset($_REQUEST['fecha_a']))
{
    if ($_REQUEST['fecha_de'] == '' || $_REQUEST['fecha_a'] == '' )
    {
        header("location: lista_compras.php");
    }
}



if(!empty($_REQUEST['busqueda'])){
    if (!is_numeric($_REQUEST['busqueda'])){
        header("location: lista_compras.php");
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
        header("location: lista_compras.php");
    }else if($fecha_de == $fecha_a){

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

    <h1>&#128210; Listado de Compras</h1>
    <a href="nueva_compra.php" class="btn_new">&#10133; Nueva Compra</a>

    <form action="buscar_compra.php" method="get" class="form_search">
        <input type="text" name="busqueda" id="busqueda" placeholder="Número de Factura" value="<?php echo $busqueda; ?>">
        <button type="submit" class="btn_search"><i>&#129488;</i></button>
    </form>

    <div>
        <h5>Buscar Compras por Fechas</h5>
        <form action="buscar_compra.php" method="get" class="form_search_date">
            <label>De:  </label>
            <input type="date" name="fecha_de" id="fecha_de" value="<?php echo $fecha_de; ?>" required >
            <label>A:  </label>
            <input type="date" name="fecha_a" id="fecha_a" value="<?php echo $fecha_a; ?>" required>
            <button type="submit" class="btn_view"><i>&#129488;</i></button>
        </form>
    </div>

    <table>
        <tr>
            <th>Factura No.</th>
            <th>Fecha</th>
            <th>Proveedor</th>
            <th class="textright">No Objeto IVA</th>
            <th class="textright">Iva cero</th>
            <th class="textright">Subtotal Iva</th>
            <th class="textright">Iva Compras</th>
            <th class="textright">Acciones</th>
        </tr>
        <?php
        $compras = "SELECT * FROM facturac WHERE $where";
        $resultado = mysqli_query($conection,$compras);
        while ($row=mysqli_fetch_assoc($resultado)) {
        ?>
        <tr id="row_<?php echo $row["idcompra"]; ?>">
            <td><?php echo $row["secuencial"]; ?></td>
            <td><?php echo $row["fechadeemis"]; ?></td>
            <td><?php echo $row["idproveedor"]; ?></td>
            <td class="textright"><?php echo $row["noobjetoiva"]; ?></td>
            <td class="textright"><?php echo $row["ivacero"]; ?></td>
            <td class="textright"><?php echo $row["baseiva"]; ?></td>
            <td class="textright"><?php echo $row["ivacompras"]; ?></td>

            <?php } mysqli_free_result($resultado);?>

            <td>
                <div class="div_acciones">
                    <a class="link_edit" href="editar_compra.php?id=<?php echo $row["idcompra"]; ?>">&#128065; Editar</a>
                    |
                    <div class="div_factura">
                        <a class="link_delete" href="eliminar_confirmar_compra.php?id=<?php echo $row["idcompra"];
                        ?>">Eliminar &#128465;</a>
                    </div>

                    <div class="div_factura">
                        <button type="button" class="btn_anular inactive"><i>&#128465;</i></button>
                    </div>


                </div>

            </td>
        </tr>
        <tr>
            <th>TOTALES</th>
            <th></th>
            <th></th>
            <?php
            $suma1 = mysqli_query($conection,"SELECT SUM(noobjetoiva) as mtotal1 FROM facturac");
            $row1 = mysqli_fetch_array($suma1,MYSQLI_ASSOC);
            $suma2 = mysqli_query($conection,"SELECT SUM(ivacero) as mtotal2 FROM facturac");
            $row2 = mysqli_fetch_array($suma2,MYSQLI_ASSOC);
            $suma3 = mysqli_query($conection,"SELECT SUM(baseiva) as mtotal3 FROM facturac");
            $row3 = mysqli_fetch_array($suma3,MYSQLI_ASSOC);
            $suma4 = mysqli_query($conection,"SELECT SUM(ivacompras) as mtotal4 FROM facturac");
            $row4 = mysqli_fetch_array($suma4,MYSQLI_ASSOC);
            ?>

            <th><?php echo number_format($row1["mtotal1"],2,',', '.'); ?></th>
            <th><?php echo number_format($row2["mtotal2"],2,',', '.'); ?></th>
            <th><?php echo number_format($row3["mtotal3"],2,',', '.'); ?></th>
            <th><?php echo number_format($row4["mtotal4"],2,',', '.'); ?></th>


        </tr>
    </table>

</section>
<?php include "../../footer.php"; ?>
</body>

</html>