<?php

session_start();

include "../conexionFE.php";



$busqueda= '';

$fecha_de = '';

$fecha_a = '';



if (isset($_REQUEST['busqueda']) && $_REQUEST['busqueda']=='')

{

    header("location: lista_ventasFE.php");

}

if (isset($_REQUEST['fecha_de']) || isset($_REQUEST['fecha_a']))

{

    if ($_REQUEST['fecha_de'] == '' || $_REQUEST['fecha_a'] == '' )

    {

        header("location: lista_ventasFE.php");

    }

}







if(!empty($_REQUEST['busqueda'])){

    if (!is_numeric($_REQUEST['busqueda'])){

        header("location: lista_ventasFE.php");

    }

    $busqueda = strtolower($_REQUEST['busqueda']);

    $where = "secuencial = $busqueda";

    $buscar = "busqueda = $busqueda";

}



if (!empty($_REQUEST['fecha_de']) && !empty($_REQUEST['fecha_a'])) {

    $fecha_de = $_REQUEST['fecha_de'];

    $fecha_a = $_REQUEST['fecha_a'];



    $buscar = '';



    if($fecha_de > $fecha_a){

        header("location: lista_ventasFE.php");

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

    <title>Declaración de IVA EC</title>

    <link rel="icon" href="imagenesEC/logoestratega.png" type="image/x">

    <link rel="stylesheet" href="css/style.css">


</head>

<body>

<section id="container">

    <h1>&#128210; Detalle Declaración de IVA EC</h1><br><br>

    <div>

        <h5>Buscar Compras y Ventas Detalladas por Fechas</h5><br>

        <form action="buscar_ventaFE.php" method="get" class="form_search_date">

            <label>De:  </label>

            <input type="date" name="fecha_de" id="fecha_de" value="<?php echo $fecha_de; ?>" required>

            <label>A:  </label>

            <input type="date" name="fecha_a" id="fecha_a" value="<?php echo $fecha_a; ?>" required>

            <button type="submit" class="btn_view"><i>&#129488;</i></button>

        </form>

    </div>



    <table>

        <tr>

            <th class="textright">Factura No.</th>

            <th>Fecha Emis.</th>

            <th>Cliente</th>

            <th>Descripción</th>

            <th>Observación</th>

            <th>Forma de Cobro</th>

            <th class="textright">Subtotal</th>

            <th class="textright">IVA 12%</th>


        </tr>


        <?php

        //Paginador

        $sql_registe = mysqli_query($conection,"SELECT COUNT(*) as total_registro FROM factura WHERE fechaEmision BETWEEN '$fecha_de' AND '$fecha_a' AND emisor_id = 1 ");

        $result_register = mysqli_fetch_array($sql_registe);

        $total_registro = $result_register['total_registro'];









        $query = mysqli_query($conection,"SELECT f.secuencial,f.formaPago,f.fechaEmision,f.totalSinImpuestos,
                                                 f.iva12,f.observacion,f.ptoEmision_id,f.nombreArchivo,
                                                 f.establecimiento_id,f.emisor_id,f.id,q.nombre,
                

              c.nombre as cliente, q.nombre as facturahasproducto

              FROM factura f

              INNER JOIN cliente c

              ON f.cliente_id = c.id
              
              INNER JOIN facturahasproducto q

              ON f.id = q.factura_id

                
                WHERE f.fechaEmision BETWEEN '$fecha_de' AND '$fecha_a' AND f.emisor_id = 1

                GROUP BY factura_id

                ORDER BY f.fechaEmision DESC  


                ");


        $result = mysqli_num_rows($query);

        if ($result > 0){

            while ($data = mysqli_fetch_array($query)) {

                if($data["formaPago"] == 01){

                    $estado = '<span class="pagada">Contado</span>';

                }else{

                    $estado = '<span class="anulada">Crédito</span>';

                }

                ?>


                <tr id="row_<?php echo $data["id"]; ?>">

                    <td><?php echo $data["nombreArchivo"]; ?></td>    
                
                    <td><?php echo date_format( new DateTime($data["fechaEmision"]),'d-m-Y'); ?></td>

                    <td><?php echo $data["cliente"]; ?></td>

                    <td><?php echo $data["nombre"]; ?></td>
                    
                    <td><?php echo $data["observacion"]; ?></td>

                    <td><?php
                        if ($data["formaPago"] == 01) {
                            echo "Efectivo";
                        }elseif ($data["formaPago"] == 15) {
                            echo "Compensación de Deudas";
                        }elseif ($data["formaPago"] == 16) {
                            echo "Tarjeta de Débito";
                        }elseif ($data["formaPago"] == 17) {
                            echo "Dinero Electrónico";
                        }elseif ($data["formaPago"] == 18) {
                            echo "Tarjeta Prepago";
                        }elseif ($data["formaPago"] == 19) {
                            echo "Tarjeta de Crédito";
                        }elseif ($data["formaPago"] == 20) {
                            echo "Transferencia";
                        }elseif ($data["formaPago"] == 21) {
                            echo "Endoso de Títulos";
                        }
                    ?></td>

                    <td class="textright"><?php echo number_format(($data["totalSinImpuestos"]),2,',','.'); ?></td>

                    <td class="textright"><?php echo number_format(($data["iva12"]),2,',','.'); ?></td>
                    
                </tr>

                <?php
            }

        }

        ?>


        <?php

        $suma1 = mysqli_query($conection,"SELECT SUM(totalSinImpuestos) as mtotal1 FROM factura WHERE fechaEmision BETWEEN '$fecha_de' AND '$fecha_a' AND emisor_id = 1");

        $row1 = mysqli_fetch_array($suma1,MYSQLI_ASSOC);

        $suma2 = mysqli_query($conection,"SELECT SUM(totalSinImpuestos) as mtotal2 FROM notacredito WHERE fechaEmision BETWEEN '$fecha_de' AND '$fecha_a' AND emisor_id = 1");

        $row2 = mysqli_fetch_array($suma2,MYSQLI_ASSOC);

        $suma3 = mysqli_query($conection,"SELECT SUM(iva12) as mtotal3 FROM factura WHERE fechaEmision BETWEEN '$fecha_de' AND '$fecha_a' AND emisor_id = 1");

        $row3 = mysqli_fetch_array($suma3,MYSQLI_ASSOC);

        $suma4 = mysqli_query($conection,"SELECT SUM(iva12) as mtotal4 FROM notacredito WHERE fechaEmision BETWEEN '$fecha_de' AND '$fecha_a' AND emisor_id = 1");

        $row4 = mysqli_fetch_array($suma4,MYSQLI_ASSOC);

        ?>


        <tr>
            <th>Total Notas de Crédito: <br></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th class="textright"><?php echo number_format(($row2["mtotal2"]),2,',', '.'); ?></th>
            <th class="textright"><?php echo number_format(($row4["mtotal4"]),2,',', '.'); ?></th>
        </tr>
        <tr>
            <th>Total USD Ventas de: <br>
            <?php echo date_format (new DateTime($fecha_de), 'd-m-Y'); ?> - <?php echo date_format (new DateTime($fecha_a), 'd-m-Y'); ?> </th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th class="textright"><?php echo number_format(($row1["mtotal1"])-($row2["mtotal2"]),2,',', '.'); ?></th>

            <th class="textright"><?php echo number_format(($row3["mtotal3"]),2,',', '.'); ?></th>



        </tr>



        <tr>

            <th> Total Facturas Emitidas: <?php

                $sql_registe = mysqli_query ($conection, "SELECT COUNT(*) as total_registro FROM factura WHERE fechaEmision BETWEEN '$fecha_de' AND '$fecha_a' AND emisor_id = 1");

                $result_register = mysqli_fetch_array ($sql_registe);

                $total_registro = $result_register ['total_registro'];

                echo $total_registro;

                ?> </th>

        </tr>



    </table>
<br>
<br>

<table>

<tr>

    <th class="textright">Factura No.</th>

    <th>Fecha Emis.</th>

    <th>Proveedor</th>

    <th>Descripción</th>

    <th class="textright">Subtotal IVA 0%</th>

    <th class="textright">Subtotal IVA 12%</th>

    <th class="textright">IVA 12%</th>

    <th class="textright">Valor Total</th>

</tr>


<?php

//Paginador

$sql_registe = mysqli_query($conection,"SELECT COUNT(*) as total_registro FROM compra WHERE fechaEmision BETWEEN '$fecha_de' AND '$fecha_a' AND emisor_id = 1 ");

$result_register = mysqli_fetch_array($sql_registe);

$total_registro = $result_register['total_registro'];









$query = mysqli_query($conection,"SELECT f.id,f.emisor_id,f.numeroFactura,f.fechaEmision,f.razonSocialProveedor,
                                         f.subTotalIva0,f.subTotalIva12,f.iva12,f.valorTotal,
                                         
        c.compra_id,c.nombre,c.id,

      c.nombre as detallecompra 

      FROM compra f 

      INNER JOIN detallecompra c 
     
      ON f.id = c.compra_id 
     
        WHERE f.fechaEmision BETWEEN '$fecha_de' AND '$fecha_a' AND f.emisor_id = 1 

        GROUP BY compra_id

        ORDER BY f.fechaEmision DESC 
        

        ");


        




$result = mysqli_num_rows($query);

if ($result > 0){

    while ($data = mysqli_fetch_array($query)) {

        if($data["emisor_id"] == 1){

            $estado = '<span class="pagada">Contado</span>';

        }else{

            $estado = '<span class="anulada">Crédito</span>';

        }


       
        ?>




<tr id="row_<?php echo $data["fechaEmision"]; ?>">
    <td><?php echo $data["numeroFactura"]; ?></td>
    <td><?php echo $data["fechaEmision"]; ?></td>
    <td><?php echo $data["razonSocialProveedor"]; ?></td>
    <td><?php echo $data["nombre"]; ?></td>
    
    <td class="textright" id="subtotal"><span>$ </span><?php echo number_format(($data["subTotalIva0"]), 2, ',', '.'); ?></td>
    <td class="textright" id="subtotal"><span>$ </span><?php echo number_format(($data["subTotalIva12"]), 2, ',', '.'); ?></td>
    <td class="textright" id="subtotal"><span>$ </span><?php echo number_format(($data["iva12"]), 2, ',', '.'); ?></td>
    <td class="textright" id="subtotal"><span>$ </span><?php echo number_format(($data["valorTotal"]), 2, ',', '.'); ?></td>

    
</tr>


        <?php

    }

}

?>

<tr>
    <td><?php echo $data["numeroFactura"]; ?></td>
</tr>

<?php
    
$suma5 = mysqli_query($conection,"SELECT SUM(subTotalIva0) as mtotal5 FROM compra WHERE fechaEmision BETWEEN '$fecha_de' AND '$fecha_a' AND emisor_id = 1");

$row5 = mysqli_fetch_array($suma5,MYSQLI_ASSOC);

$suma6 = mysqli_query($conection,"SELECT SUM(subTotalIva12) as mtotal6 FROM compra WHERE fechaEmision BETWEEN '$fecha_de' AND '$fecha_a' AND emisor_id = 1");

$row6 = mysqli_fetch_array($suma6,MYSQLI_ASSOC);

$suma7 = mysqli_query($conection,"SELECT SUM(iva12) as mtotal7 FROM compra WHERE fechaEmision BETWEEN '$fecha_de' AND '$fecha_a' AND emisor_id = 1");

$row7 = mysqli_fetch_array($suma7,MYSQLI_ASSOC);

$suma8 = mysqli_query($conection,"SELECT SUM(valorTotal) as mtotal8 FROM compra WHERE fechaEmision BETWEEN '$fecha_de' AND '$fecha_a' AND emisor_id = 1");

$row8 = mysqli_fetch_array($suma8,MYSQLI_ASSOC);

?>



<tr>

    <th>Total USD Compras de: <br>
    <?php echo date_format (new DateTime($fecha_de), 'd-m-Y'); ?> - <?php echo date_format (new DateTime($fecha_a), 'd-m-Y'); ?> </th>

    <th></th>

    <th></th>

    <th></th>

    <th class="textright"><?php echo number_format(($row5["mtotal5"]),2,',', '.'); ?></th>

    <th class="textright"><?php echo number_format(($row6["mtotal6"]),2,',', '.'); ?></th>

    <th class="textright"><?php echo number_format(($row7["mtotal7"]),2,',', '.'); ?></th>

    <th class="textright"><?php echo number_format(($row8["mtotal8"]),2,',', '.'); ?></th>


</tr>



<tr>

    <th> Total Facturas Recibidas: <?php

        $sql_registe1 = mysqli_query ($conection, "SELECT COUNT(*) as total_registro1 FROM compra WHERE fechaEmision BETWEEN '$fecha_de' AND '$fecha_a' AND emisor_id = 1");

        $result_register1 = mysqli_fetch_array ($sql_registe1);

        $total_registro1 = $result_register1 ['total_registro1'];

        echo $total_registro1;

        ?> </th>

</tr>



</table>

<br>

<table>

<tr>

    <th class="textright">Retención No.</th>

    <th>Fecha Emis.</th>

    <th>Agente de Retención</th>

    <th class="textright">Base Imponible Rir</th>

    <th class="textright">Retención Impuesto Renta</th>

    <th class="textright">Retención IVA</th>

    <th class="textright">No. Factura Que Aplica</th>


</tr>


<?php

//Paginador

$sql_registe = mysqli_query($conection,"SELECT COUNT(*) as total_registro FROM retenciones WHERE fechaemis BETWEEN '$fecha_de' AND '$fecha_a' AND emisor_id = 1 ");

$result_register = mysqli_fetch_array($sql_registe);

$total_registro = $result_register['total_registro'];



$query = mysqli_query($conection,"SELECT noretencion,fechaemis,razonSocialAgenteRetencion,
                                         baseimp,riva,rir,facturaQueAplica,archivo
                                         
      FROM retenciones

      WHERE fechaemis BETWEEN '$fecha_de' AND '$fecha_a' AND emisor_id = 1 

      ORDER BY fechaemis DESC  
        ");


        





$result = mysqli_num_rows($query);

if ($result > 0){

    while ($data = mysqli_fetch_array($query)) {

        if($data["emisor_id"] == 1){

            $estado = '<span class="pagada">Contado</span>';

        }else{

            $estado = '<span class="anulada">Crédito</span>';

        }


       
        ?>




<tr id="row_<?php echo $data["fechaemis"]; ?>">
    <td><?php echo $data["noretencion"]; ?></td>
    <td><?php echo $data["fechaemis"]; ?></td>
    <td><?php echo $data["razonSocialAgenteRetencion"]; ?></td>
        
    <td class="textright" id="subtotal"><span>$ </span><?php echo number_format(($data["baseimp"]), 2, ',', '.'); ?></td>
    <td class="textright" id="subtotal"><span>$ </span><?php echo number_format(($data["rir"]), 2, ',', '.'); ?></td>
    <td class="textright" id="subtotal"><span>$ </span><?php echo number_format(($data["riva"]), 2, ',', '.'); ?></td>
    <td><?php echo $data["facturaQueAplica"]; ?></td>

    
</tr>


        <?php

    }

}

?>

<tr>
    <td><?php echo $data["noretencion"]; ?></td>
</tr>

<?php
    
$suma10 = mysqli_query($conection,"SELECT SUM(rir) as mtotal10 FROM retenciones WHERE fechaemis BETWEEN '$fecha_de' AND '$fecha_a' AND emisor_id = 1");

$row10 = mysqli_fetch_array($suma10,MYSQLI_ASSOC);

$suma11 = mysqli_query($conection,"SELECT SUM(riva) as mtotal11 FROM retenciones WHERE fechaemis BETWEEN '$fecha_de' AND '$fecha_a' AND emisor_id = 1");

$row11 = mysqli_fetch_array($suma11,MYSQLI_ASSOC);

?>



<tr>

    <th>Total USD Retenido de: <br>
    <?php echo date_format (new DateTime($fecha_de), 'd-m-Y'); ?> - <?php echo date_format (new DateTime($fecha_a), 'd-m-Y'); ?> </th>

    <th></th>

    <th></th>

    <th></th>

    <th class="textright"><?php echo number_format(($row10["mtotal10"]),2,',', '.'); ?></th>

    <th class="textright"><?php echo number_format(($row11["mtotal11"]),2,',', '.'); ?></th>

    
</tr>



<tr>

    <th> Total Retenciones Recibidas: <?php

        $sql_registe2 = mysqli_query ($conection, "SELECT COUNT(*) as total_registro2 FROM retenciones WHERE fechaemis BETWEEN '$fecha_de' AND '$fecha_a' AND emisor_id = 1");

        $result_register2 = mysqli_fetch_array ($sql_registe2);

        $total_registro2 = $result_register2 ['total_registro2'];

        echo $total_registro2;

        ?> </th>

</tr>



</table>


<br><br>

<h2>Declaración de IVA del Período: <?php echo date_format (new DateTime($fecha_de), 'd-m-Y'); ?> - <?php echo date_format (new DateTime($fecha_a), 'd-m-Y'); ?> </h2>

<table>

<tr>

    <th>Resumen de Ventas y Compras</th>
    <th>Casillero</th>
    <th>Ventas Brutas</th>
    <th>Casillero</th>
    <th>Ventas Netas</th>
    <th>Casillero</th>
    <th>IVA 12%</th>

</tr>
<tr>

    <td>Ventas Tarifa 12%</td>
    <td class="textcenter">401</td>
    <td class="textright"><?php echo number_format(($row1["mtotal1"]),2,',', '.'); ?></td>
    <td class="textcenter">411</td>
    <td class="textright"><?php echo number_format(($row1["mtotal1"])-($row2["mtotal2"]),2,',', '.'); ?></td>
    <td class="textcenter">421</td>
    <td class="textright"><?php echo number_format(($row3["mtotal3"])-($row4["mtotal4"]),2,',', '.'); ?></td>
</tr>    
<tr>
    <td>No. Facturas Emitidas</th>
    <td class="textright"><?php 
    
    $sql_registe = mysqli_query ($conection, "SELECT COUNT(*) as total_registro FROM factura WHERE fechaEmision BETWEEN '$fecha_de' AND '$fecha_a' AND emisor_id = 1");

                $result_register = mysqli_fetch_array ($sql_registe);

                $total_registro = $result_register ['total_registro'];

                echo $total_registro;
    ?></th>
</tr>

<tr>
<td>Adquisiciones Tarifa 12%</td>
    <td class="textcenter">500</td>
    <td class="textright"><?php echo number_format(($row6["mtotal6"]),2,',', '.'); ?></td>
    <td class="textcenter">510</td>
    <td class="textright"><?php echo number_format(($row6["mtotal6"]),2,',', '.'); ?></td>
    <td class="textcenter">520</td>
    <td class="textright"><?php echo number_format(($row7["mtotal7"]),2,',', '.'); ?></td>
</tr>

<tr>
<td>Adquisiciones Tarifa 0%</td>
    <td class="textcenter">507</td>
    <td class="textright"><?php echo number_format(($row5["mtotal5"]),2,',', '.'); ?></td>
    <td class="textcenter">517</td>
    <td class="textright"><?php echo number_format(($row5["mtotal5"]),2,',', '.'); ?></td>
</tr>

<tr>
    <td>No. Facturas Recibidas</th>
    <td class="textright"><?php echo $total_registro1; ?></th>
</tr>



<tr>
    <th>Crédito Tributario de este Período</th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th class="textcenter">564</th>
    <th class="textright"><?php 
        if(($row3["mtotal3"])-($row4["mtotal4"])-($row7["mtotal7"])>0){
            echo number_format(($row3["mtotal3"])-($row4["mtotal4"])-($row7["mtotal7"]),2,',', '.');    
        }else{
            echo number_format(0,2,',', '.');        
        }
     ?></th>
</tr>

<tr>
    <th>Retenciones Recibidas</th>
    <th class="textcenter">I.R.</th>
    <th class="textright"><?php echo number_format(($row10["mtotal10"]),2,',', '.'); ?></th>
    <th></th>
    <th></th>
    <th class="textcenter">609</th>
    <th class="textright"><?php echo number_format(($row11["mtotal11"]),2,',', '.'); ?></th>
</tr>
<tr>
    <th>Impuesto a Pagar</th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th class="textcenter">601</th>
    <th class="textright"><?php  
        if(($row3["mtotal3"])-($row4["mtotal4"])-($row7["mtotal7"])<0){
            echo number_format(($row3["mtotal3"])-($row4["mtotal4"])-($row7["mtotal7"]),2,',', '.');    
        }else{
            echo number_format(0,2,',', '.');        
        } ?></th>
</tr>

</tr>
</table>

</section>

<?php include "../footer.php"; ?>

</body>



</html>