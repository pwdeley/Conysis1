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

    <title>Balance General EA</title>
    <link rel="icon" href="../imagenesEA/logoestratega.png" type="image/x">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../css/jquery.min.js"></script>
    <script type="text/javascript" src="../css/functions.js"></script>

    <?php include "../../functions.php"; ?>

</head>
<body>

<?php include "../header.php"; ?>
<section id="container">

    <h1>&#128210; Balance General EA 2021</h1><br><br>


    <div>
        <h4>Ingresar la fecha a consultar dentro del período 2021:</h4>
        <form action="balance_general.php" method="get" class="form_search_date">
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
            <th>Cuenta</th>
            <th>Importe</th>

        </tr>

        <?php
        // Ventas

        $suma1 = mysqli_query($conection,"SELECT SUM(precio1*cantidad1) as mtotal1 FROM facturaV WHERE fechaemis BETWEEN '$fecha_de' AND '$fecha_a'");
        $row1 = mysqli_fetch_array($suma1,MYSQLI_ASSOC);
        $suma2 = mysqli_query($conection,"SELECT SUM(precio2*cantidad2) as mtotal2 FROM facturaV WHERE fechaemis BETWEEN '$fecha_de' AND '$fecha_a'");
        $row2 = mysqli_fetch_array($suma2,MYSQLI_ASSOC);
        $ingresos = ($row1["mtotal1"]+$row2["mtotal2"]);
        $suma3 = mysqli_query($conection,"SELECT SUM(precio1*cantidad1*0.12) as mtotal3 FROM facturaV WHERE fechaemis BETWEEN '$fecha_de' AND '$fecha_a' ");
        $row3 = mysqli_fetch_array($suma3,MYSQLI_ASSOC);
        $suma4 = mysqli_query($conection,"SELECT SUM(precio2*cantidad2*0.12) as mtotal4 FROM facturaV WHERE fechaemis BETWEEN '$fecha_de' AND '$fecha_a' ");
        $row4 = mysqli_fetch_array($suma4,MYSQLI_ASSOC);
        $ivav = ($row3["mtotal3"]+$row4["mtotal4"]);
        $suma5 = mysqli_query($conection,"SELECT SUM(precio1*cantidad1*0.02) as mtotal5 FROM facturaV WHERE fechaemis BETWEEN '$fecha_de' AND '$fecha_a' AND formacobro = 'Tarjeta'");
        $row5 = mysqli_fetch_array($suma5,MYSQLI_ASSOC);
        $suma6 = mysqli_query($conection,"SELECT SUM(precio2*cantidad2*0.02) as mtotal6 FROM facturaV WHERE fechaemis BETWEEN '$fecha_de' AND '$fecha_a' AND formacobro = 'Tarjeta'");
        $row6 = mysqli_fetch_array($suma6,MYSQLI_ASSOC);
        $rir = ($row5["mtotal5"]+$row6["mtotal6"]);
        $suma7 = mysqli_query($conection,"SELECT SUM(precio1*cantidad1*0.12*0.7) as mtotal7 FROM facturaV WHERE fechaemis BETWEEN '$fecha_de' AND '$fecha_a' AND formacobro = 'Tarjeta'");
        $row7 = mysqli_fetch_array($suma7,MYSQLI_ASSOC);
        $suma8 = mysqli_query($conection,"SELECT SUM(precio2*cantidad2*0.12*0.7) as mtotal8 FROM facturaV WHERE fechaemis BETWEEN '$fecha_de' AND '$fecha_a' AND formacobro = 'Tarjeta'");
        $row8 = mysqli_fetch_array($suma8,MYSQLI_ASSOC);
        $riva = ($row7["mtotal7"] + $row8["mtotal8"]);

        //Compras
        $suma9 = mysqli_query($conection,"SELECT SUM(ivacompras) as mtotal9 FROM facturaC WHERE fechadeemis BETWEEN '$fecha_de' AND '$fecha_a'");
        $row9 = mysqli_fetch_array($suma9,MYSQLI_ASSOC);
        $ivac = ($row9["mtotal9"]);
        $suma10 = mysqli_query($conection,"SELECT SUM(noobjetoiva+ivacero+baseiva) as mtotal10 FROM facturaC WHERE fechadeemis BETWEEN '$fecha_de' AND '$fecha_a'");
        $row10 = mysqli_fetch_array($suma10,MYSQLI_ASSOC);
        $doctosxpag = ($row10["mtotal10"]);
        $ctsxpag = "11291.48";
        $suma77 = mysqli_query($conection,"SELECT SUM(sueldo+horaext25+horaext50+horaext100+indemnizacion+otrosing) as mtotal77 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a' ");
        $row77 = mysqli_fetch_array($suma77,MYSQLI_ASSOC);
        $suma78 = mysqli_query($conection,"SELECT SUM(gasto13+gasto14+prov13+prov14) as mtotal78 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row78 = mysqli_fetch_array($suma78,MYSQLI_ASSOC);
        $suma79 = mysqli_query($conection,"SELECT SUM(iesspatr+gastofr+provfr) as mtotal79 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row79 = mysqli_fetch_array($suma79,MYSQLI_ASSOC);
        $emplexpag = $row77["mtotal77"]+$row78["mtotal78"]+$row79["mtotal79"];
        $suma80 = mysqli_query($conection,"SELECT SUM(prov13+prov14+provfr) as mtotal80 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row80 = mysqli_fetch_array($suma80,MYSQLI_ASSOC);
        $provisempl = $row80["mtotal80"];
        $egresos = $doctosxpag + $emplexpag;
        ?>
        <tr>
            <td>Efectivo y Equivalentes</td>
            <td class="textright"><?php
                $efectivo = ($row1["mtotal1"]+$row2["mtotal2"])+
                    ($row3["mtotal3"]+$row4["mtotal4"])-($row5["mtotal5"]+$row6["mtotal6"])-
                    ($row7["mtotal7"]+$row8["mtotal8"])-($row9["mtotal9"]);

                echo number_format(0,2,',', '.'); ?></td>
        </tr>
        <tr>
            <td>Retenciones Renta</td>
            <td class="textright"><?php

                echo number_format($rir,2,',', '.'); ?></td>
        </tr>
        <tr>
            <td>Retenciones IVA</td>
            <td class="textright"><?php

                if (($ivav - $ivac -$riva)>0) {
                    echo number_format(0, 2, ',', '.');
                }else{
                    echo number_format($riva+$ivac-$ivav, 2, ',', '.');
                }
                ?></td>
        </tr>
        <tr>
            <td>IVA Compras</td>
            <td class="textright"><?php

                if (($ivav - $ivac -$riva)>0) {
                    echo number_format(0, 2, ',', '.');
                }elseif (($ivac-$ivav)<0){
                    echo number_format(0, 2, ',', '.');
                    }else{
                    echo number_format($ivac-$ivav, 2, ',', '.');
                }

                ?></td>
        </tr>


        <tr>
            <th>Total USD Activo Corriente: <?php echo date_format (new DateTime($fecha_de),'d-m-Y');?> - <?php echo date_format (new DateTime($fecha_a),'d-m-Y');?> </th>
            <th class="textright"><?php

                if (($ivav - $ivac -$riva)>0) {
                    echo number_format($rir, 2, ',', '.');
                }else{
                    echo number_format($rir+$ivac-$ivav+$riva, 2, ',', '.');
                }
                ?></th>

        </tr>

    </table>

    <table>
        <tr>
            <td>Cuentas por Pagar Años Anteriores</td>
            <td class="textright"><?php echo number_format($ctsxpag,2,',', '.'); ?></td>
        </tr>
        <tr>
            <td>Documentos por Pagar</td>
            <td class="textright"><?php

                echo number_format($doctosxpag-($efectivo-$emplexpag)-$provisempl,2,',', '.'); ?></td>
        </tr>
        <tr>
            <td>Obligaciones Laborales por Pagar</td>
            <td class="textright"><?php

                echo number_format($provisempl,2,',', '.'); ?></td>
        </tr>

        <tr>
            <td>IVA en Ventas</td>
            <td class="textright"><?php

               if (($ivav - $ivac -$riva)>0) {
                    echo number_format($ivav-$ivac-$riva, 2, ',', '.');
                }else{
                    echo number_format(0, 2, ',', '.');
                }
               ?></td>
        </tr>
        <tr>
            <th>Total USD Pasivo Corriente: <?php echo date_format (new DateTime($fecha_de),'d-m-Y');?> - <?php echo date_format (new DateTime($fecha_a),'d-m-Y');?> </th>
            <th class="textright"><?php
                if (($ivav - $ivac -$riva)>0) {
                    echo number_format($ctsxpag+$doctosxpag-($efectivo-$emplexpag)+$ivav-$ivac-$riva, 2, ',', '.');
                }else{
                    echo number_format($ctsxpag+$doctosxpag-($efectivo-$emplexpag), 2, ',', '.');
                }
                ?></th>

        </tr>

    </table>

    <table>
        <?php
        //Patrimonio
        $suma11 = mysqli_query($conection,"SELECT SUM(capital) as mtotal11 FROM movpatrim WHERE fechapatrim BETWEEN '2018-07-28' AND '$fecha_a'");
        $row11 = mysqli_fetch_array($suma11,MYSQLI_ASSOC);
        $suma12 = mysqli_query($conection,"SELECT SUM(ganacuml-perdacml) as mtotal12 FROM movpatrim WHERE fechapatrim BETWEEN '2018-07-28' AND '$fecha_a'");
        $row12 = mysqli_fetch_array($suma12,MYSQLI_ASSOC);
        $suma13 = mysqli_query($conection,"SELECT SUM(ganejer-perdejer) as mtotal13 FROM movpatrim WHERE fechapatrim BETWEEN '$fecha_de' AND '$fecha_a'");
        $row13 = mysqli_fetch_array($suma13,MYSQLI_ASSOC);

        ?>
        <tr>
            <td>Capital</td>
            <td class="textright"><?php echo number_format(($row11["mtotal11"]),2,',', '.'); ?></td>
        </tr>
        <tr>
            <td>Resultados Acumulados</td>
            <td class="textright"><?php echo number_format(($row12["mtotal12"]+"2898.5"),2,',', '.'); ?></td>
        </tr>
        <tr>
            <td>Resultado del Ejercicio</td>
            <td class="textright"><?php echo number_format(($ingresos-$egresos),2,',', '.'); ?></td>
        </tr>
        <tr>
            <th>Total USD Patrimonio: <?php echo date_format (new DateTime($fecha_de),'d-m-Y');?> - <?php echo date_format (new DateTime($fecha_a),'d-m-Y');?> </th>
            <th class="textright"><?php echo number_format($row11["mtotal11"]+$row12["mtotal12"]+"2898.5"+
                    $row13["mtotal13"]+($ingresos-$egresos),2,',', '.'); ?></th>

        </tr>
        <tr>
            <th>Total USD Pasivo y Patrimonio: <?php echo date_format (new DateTime($fecha_de),'d-m-Y');?> - <?php echo date_format (new DateTime($fecha_a),'d-m-Y');?> </th>
            <th class="textright"><?php
                if (($ivav - $ivac -$riva)>0) {
                    echo number_format($ctsxpag+$doctosxpag-($efectivo-$emplexpag)+$ivav-$ivac-$riva+$row11["mtotal11"]+$row12["mtotal12"]+"2898.5"+
                        $row13["mtotal13"]+($ingresos-$egresos), 2, ',', '.');
                }else{
                    echo number_format($ctsxpag+$doctosxpag-($efectivo-$emplexpag)+$row11["mtotal11"]+$row12["mtotal12"]+"2898.5"+
                        $row13["mtotal13"]+($ingresos-$egresos), 2, ',', '.');
                }
              ?></th>

        </tr>
    </table>


</section>

<section id="container">

    <h1>&#128210; Balance General EA 2020</h1><br><br>


    <div>
        <h4>Estado Financiero Declarado y Cerrado al 31 de diciembre 2020</h4>

    </div>
    <br>
    <table>
        <tr>
            <th>Cuenta</th>
            <th>Importe</th>

        </tr>

        <tr>
            <td>Efectivo y Equivalentes</td>
            <td class="textright">1,63</td>
        </tr>
        <tr>
            <td>Retenciones Renta</td>
            <td class="textright">0,00</td>
        </tr>
        <tr>
            <td>Retenciones IVA</td>
            <td class="textright">0,00</td>
        </tr>
        <tr>
            <td>IVA Compras</td>
            <td class="textright">0,00</td>
        </tr>


        <tr>
            <th>Total USD Activo Corriente: </th>
            <th class="textright">1,63</th>

        </tr>

    </table>

    <table>

        <tr>
            <td>Cuentas por Pagar</td>
            <td class="textright">11.293,11</td>
        </tr>
        <tr>
            <td>IVA en Ventas</td>
            <td class="textright">0,00</td>
        </tr>
        <tr>
            <th>Total USD Pasivo Corriente 2020: </th>
            <th class="textright">11.293,11</th>
        </tr>

    </table>

    <table>
        <?php
        //Patrimonio
        $suma14 = mysqli_query($conection,"SELECT SUM(capital) as mtotal14 FROM movpatrim WHERE fechapatrim BETWEEN '2018-07-28' AND '2020-12-31'");
        $row14 = mysqli_fetch_array($suma14,MYSQLI_ASSOC);
        $suma15 = mysqli_query($conection,"SELECT SUM(ganacuml-perdacml) as mtotal15 FROM movpatrim WHERE fechapatrim BETWEEN '2018-07-28' AND '2020-12-31'");
        $row15 = mysqli_fetch_array($suma15,MYSQLI_ASSOC);
        $suma16 = mysqli_query($conection,"SELECT SUM(ganejer-perdejer) as mtotal16 FROM movpatrim WHERE fechapatrim BETWEEN '2020-01-01' AND '2020-12-31'");
        $row16 = mysqli_fetch_array($suma16,MYSQLI_ASSOC);

        ?>
        <tr>
            <td>Capital</td>
            <td class="textright"><?php echo number_format(($row14["mtotal14"]),2,',', '.'); ?></td>
        </tr>
        <tr>
            <td>Resultados Acumulados</td>
            <td class="textright"><?php echo number_format(($row15["mtotal15"]),2,',', '.'); ?></td>
        </tr>
        <tr>
            <td>Resultado del Ejercicio</td>
            <td class="textright"><?php echo number_format(($row16["mtotal16"])-($row15["mtotal15"]),2,',', '.'); ?></td>
        </tr>
        <tr>
            <th>Total USD Patrimonio 2020: </th>
            <th class="textright"><?php echo number_format(($row14["mtotal14"]+$row15["mtotal15"])+
                    ($row16["mtotal16"])-($row15["mtotal15"]),2,',', '.'); ?></th>

        </tr>
        <tr>
            <th>Total USD Pasivo y Patrimonio 2020: </th>
            <th class="textright"><?php echo number_format(("11293.11")+($row14["mtotal14"])+
                    ($row16["mtotal16"]),2,',', '.'); ?></th>

        </tr>
    </table>


</section>

<section id="container">

    <h1>&#128210; Balance General EA 2019</h1><br><br>


    <div>
        <h4>Estado Financiero Declarado y Cerrado al 31 de diciembre 2019</h4>

    </div>
    <br>
    <table>
        <tr>
            <th>Cuenta</th>
            <th>Importe</th>

        </tr>

        <tr>
            <td>Efectivo y Equivalentes</td>
            <td class="textright">2.895,71</td>
        </tr>
        <tr>
            <td>Retenciones Renta</td>
            <td class="textright">0,00</td>
        </tr>
        <tr>
            <td>Retenciones IVA</td>
            <td class="textright">0,00</td>
        </tr>
        <tr>
            <td>IVA Compras</td>
            <td class="textright">0,00</td>
        </tr>


        <tr>
            <th>Total USD Activo Corriente 2019: </th>
            <th class="textright">2.895,71</th>

        </tr>

    </table>

    <table>

        <tr>
            <td>Cuentas por Pagar</td>
            <td class="textright">3.664,44</td>
        </tr>
        <tr>
            <td>Impuesto Renta del ejercicio por pagar </td>
            <td class="textright">110,59</td>
        </tr>
        <tr>
            <td>Obligaciones con el IESS</td>
            <td class="textright">517,10</td>
        </tr>
        <tr>
            <td>Beneficios a empleados </td>
            <td class="textright">702,08</td>
        </tr>
        <tr>
            <th>Total USD Pasivo Corriente 2019: </th>
            <th class="textright">4.994,21</th>
        </tr>

    </table>

    <table>
        <?php
        //Patrimonio
        $suma17 = mysqli_query($conection,"SELECT SUM(capital) as mtotal17 FROM movpatrim WHERE fechapatrim BETWEEN '2018-07-28' AND '2019-12-31'");
        $row17 = mysqli_fetch_array($suma17,MYSQLI_ASSOC);
        $suma18 = mysqli_query($conection,"SELECT SUM(ganacuml-perdacml) as mtotal18 FROM movpatrim WHERE fechapatrim BETWEEN '2018-07-28' AND '2019-12-31'");
        $row18 = mysqli_fetch_array($suma18,MYSQLI_ASSOC);
        $suma19 = mysqli_query($conection,"SELECT SUM(ganejer-perdejer) as mtotal19 FROM movpatrim WHERE fechapatrim BETWEEN '2019-01-01' AND '2019-12-31'");
        $row19 = mysqli_fetch_array($suma19,MYSQLI_ASSOC);

        ?>
        <tr>
            <td>Capital</td>
            <td class="textright"><?php echo number_format(($row17["mtotal17"]),2,',', '.'); ?></td>
        </tr>
        <tr>
            <td>Resultados Acumulados</td>
            <td class="textright"><?php echo number_format(($row18["mtotal18"]),2,',', '.'); ?></td>
        </tr>
        <tr>
            <td>Resultado del Ejercicio</td>
            <td class="textright"><?php echo number_format(($row19["mtotal19"]),2,',', '.'); ?></td>
        </tr>
        <tr>
            <th>Total USD Patrimonio 2019: </th>
            <th class="textright"><?php echo number_format(($row17["mtotal17"]+$row18["mtotal18"])+
                    ($row19["mtotal19"]),2,',', '.'); ?></th>

        </tr>
        <tr>
            <th>Total USD Pasivo y Patrimonio 2019: </th>
            <th class="textright"><?php echo number_format(("4994.21")+($row17["mtotal17"])+
                    ($row18["mtotal18"])+($row19["mtotal19"]),2,',', '.'); ?></th>

        </tr>
    </table>


</section>

<section id="container">

    <h1>&#128210; Balance General EA 2018</h1><br><br>


    <div>
        <h4>Estado Financiero Declarado y Cerrado al 31 de diciembre 2018</h4>

    </div>
    <br>
    <table>
        <tr>
            <th>Cuenta</th>
            <th>Importe</th>

        </tr>

        <tr>
            <td>Efectivo y Equivalentes</td>
            <td class="textright">0,00</td>
        </tr>
        <tr>
            <td>Retenciones Renta</td>
            <td class="textright">35,64</td>
        </tr>
        <tr>
            <td>Retenciones IVA</td>
            <td class="textright">0,00</td>
        </tr>
        <tr>
            <td>IVA Compras</td>
            <td class="textright">783,44</td>
        </tr>


        <tr>
            <th>Total USD Activo Corriente 2018: </th>
            <th class="textright">819,08</th>

        </tr>

    </table>

    <table>

        <tr>
            <td>Cuentas por Pagar</td>
            <td class="textright">2.263,97</td>
        </tr>
        <tr>
            <td>IVA Ventas </td>
            <td class="textright">371,64</td>
        </tr>
        <tr>
            <td>Obligaciones con el IESS</td>
            <td class="textright">427,91</td>
        </tr>
        <tr>
            <td>Beneficios a empleados </td>
            <td class="textright">296,42</td>
        </tr>
        <tr>
            <th>Total USD Pasivo Corriente 2018: </th>
            <th class="textright">3.359,94</th>
        </tr>

    </table>

    <table>
        <?php
        //Patrimonio
        $suma20 = mysqli_query($conection,"SELECT SUM(capital) as mtotal20 FROM movpatrim WHERE fechapatrim BETWEEN '2018-07-28' AND '2018-12-31'");
        $row20 = mysqli_fetch_array($suma20,MYSQLI_ASSOC);
        $suma21 = mysqli_query($conection,"SELECT SUM(ganacuml-perdacml) as mtotal21 FROM movpatrim WHERE fechapatrim BETWEEN '2018-07-28' AND '2018-12-31'");
        $row21 = mysqli_fetch_array($suma21,MYSQLI_ASSOC);
        $suma22 = mysqli_query($conection,"SELECT SUM(ganejer-perdejer) as mtotal22 FROM movpatrim WHERE fechapatrim BETWEEN '2018-01-01' AND '2018-12-31'");
        $row22 = mysqli_fetch_array($suma22,MYSQLI_ASSOC);
        mysqli_close($conection);
        ?>
        <tr>
            <td>Capital</td>
            <td class="textright"><?php echo number_format(($row20["mtotal20"]),2,',', '.'); ?></td>
        </tr>
        <tr>
            <td>Resultados Acumulados</td>
            <td class="textright"><?php echo number_format(($row21["mtotal21"]),2,',', '.'); ?></td>
        </tr>
        <tr>
            <td>Resultado del Ejercicio</td>
            <td class="textright"><?php echo number_format(($row22["mtotal22"]),2,',', '.'); ?></td>
        </tr>
        <tr>
            <th>Total USD Patrimonio 2018: </th>
            <th class="textright"><?php echo number_format(($row20["mtotal20"]+$row21["mtotal21"])+
                    ($row22["mtotal22"]),2,',', '.'); ?></th>

        </tr>
        <tr>
            <th>Total USD Pasivo y Patrimonio 2018: </th>
            <th class="textright"><?php echo number_format(("3359.94")+($row20["mtotal20"])+
                    ($row21["mtotal21"])+($row22["mtotal22"]),2,',', '.'); ?></th>

        </tr>
    </table>


</section>


<?php include "../../footer.php"; ?>
</body>

</html>

