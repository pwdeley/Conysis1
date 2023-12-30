<?php

session_start();

include "../conexion.php";



$busqueda= '';

$fecha_de = '2022-01-01';

$fecha_a = '';



if (isset($_REQUEST['busqueda']) && $_REQUEST['busqueda']=='')

{

    header("location: balance_general.php");

}

if (isset($_REQUEST['fecha_de']) || isset($_REQUEST['fecha_a']))

{

    if ($_REQUEST['fecha_de'] == '' || $_REQUEST['fecha_a'] == '' )

    {

        header("location: balance_general.php");

    }

}







if(!empty($_REQUEST['busqueda'])){

    if (!is_numeric($_REQUEST['busqueda'])){

        header("location: balance_general.php");

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

        header("location: balance_general.php");

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



    <h1>&#128210; Balance General EA 2022</h1><br><br>





    <div>

        <h4>Ingresar la fecha a consultar dentro del período 2022:</h4>

        <form action="balance_general.php" method="get" class="form_search_date">

            <label>De:</label>

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

        $suma3 = mysqli_query($conection,"SELECT SUM(rir2) as mtotal3 FROM retevent WHERE fechaemis BETWEEN '$fecha_de' AND '$fecha_a' ");

        $row3 = mysqli_fetch_array($suma3,MYSQLI_ASSOC);

        $rirv = ($row3["mtotal3"]);

        $suma5 = mysqli_query($conection,"SELECT SUM(riva70) as mtotal5 FROM retevent WHERE fechaemis BETWEEN '$fecha_de' AND '$fecha_a' ");

        $row5 = mysqli_fetch_array($suma5,MYSQLI_ASSOC);

        $rivav = ($row5["mtotal5"]);



        //Compras

        $suma9 = mysqli_query($conection,"SELECT SUM(ivacompras) as mtotal9 FROM facturaC WHERE fechadeemis BETWEEN '$fecha_de' AND '$fecha_a'");

        $row9 = mysqli_fetch_array($suma9,MYSQLI_ASSOC);

        $ivac = ($row9["mtotal9"]);

        $suma10 = mysqli_query($conection,"SELECT SUM(noobjetoiva+ivacero+baseiva) as mtotal10 FROM facturaC WHERE fechadeemis BETWEEN '$fecha_de' AND '$fecha_a'");

        $row10 = mysqli_fetch_array($suma10,MYSQLI_ASSOC);

        $doctosxpag = ($row10["mtotal10"]);

        $ctsxpag = "19665.85";

        $suma77 = mysqli_query($conection,"SELECT SUM(sueldo+horaext25+horaext50+horaext100+indemnizacion+otrosing) as mtotal77 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a' ");

        $row77 = mysqli_fetch_array($suma77,MYSQLI_ASSOC);

        $suma78 = mysqli_query($conection,"SELECT SUM(gasto13+gasto14+gastofr) as mtotal78 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");

        $row78 = mysqli_fetch_array($suma78,MYSQLI_ASSOC);

        $suma79 = mysqli_query($conection,"SELECT SUM(iesspers) as mtotal79 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");

        $row79 = mysqli_fetch_array($suma79,MYSQLI_ASSOC);

        $emplexpag = $row77["mtotal77"]+$row78["mtotal78"]-$row79["mtotal79"];

        $suma76 = mysqli_query($conection,"SELECT SUM(iesspatr) as mtotal76 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");

        $row76 = mysqli_fetch_array($suma76,MYSQLI_ASSOC);

        $iesspatxpag = $row76["mtotal76"];

        $suma80 = mysqli_query($conection,"SELECT SUM(prov13+prov14+provfr) as mtotal80 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");

        $row80 = mysqli_fetch_array($suma80,MYSQLI_ASSOC);

        $provisempl = $row80["mtotal80"]+1065.9;

        $suma535 = mysqli_query($conection,"SELECT SUM(valordebe-valorhaber) as mtotal535 FROM contabilidad WHERE fechareg BETWEEN '$fecha_de' AND '$fecha_a' AND cuenta= '535' ");

        $row535 = mysqli_fetch_array($suma535,MYSQLI_ASSOC);

        $seguros = ($row535["mtotal535"]);

        $suma537 = mysqli_query($conection,"SELECT SUM(valordebe-valorhaber) as mtotal537 FROM contabilidad WHERE fechareg BETWEEN '$fecha_de' AND '$fecha_a' AND cuenta= '537' ");

        $row537 = mysqli_fetch_array($suma537,MYSQLI_ASSOC);

        $intereses = ($row537["mtotal537"]);

        $egresos = $doctosxpag + $emplexpag + $provisempl + $iesspatxpag + $seguros + $intereses;



        //Ajustes

        $suma101 = mysqli_query($conection,"SELECT SUM(valordebe-valorhaber) as mtotal101 FROM contabilidad WHERE fechareg BETWEEN '$fecha_de' AND '$fecha_a' AND cuenta= '101' ");

        $row101 = mysqli_fetch_array($suma101,MYSQLI_ASSOC);

        $efectivo1 = ($row101["mtotal101"]);

        $suma205 = mysqli_query($conection,"SELECT SUM(valordebe-valorhaber) as mtotal205 FROM contabilidad WHERE fechareg BETWEEN '$fecha_de' AND '$fecha_a' AND cuenta= '205' ");

        $row205 = mysqli_fetch_array($suma205,MYSQLI_ASSOC);

        $obligacionesfinancieras = ($row205["mtotal205"]);

        $suma202 = mysqli_query($conection,"SELECT SUM(valordebe-valorhaber) as mtotal202 FROM contabilidad WHERE fechareg BETWEEN '$fecha_de' AND '$fecha_a' AND cuenta= '202' ");

        $row202 = mysqli_fetch_array($suma202,MYSQLI_ASSOC);

        $doctosxpag1 = ($row202["mtotal202"]);

        $suma203 = mysqli_query($conection,"SELECT SUM(valordebe-valorhaber) as mtotal203 FROM contabilidad WHERE fechareg BETWEEN '$fecha_de' AND '$fecha_a' AND cuenta= '203' ");

        $row203 = mysqli_fetch_array($suma203,MYSQLI_ASSOC);

        $provisempl1 = ($row203["mtotal203"]);

        $suma201 = mysqli_query($conection,"SELECT SUM(valordebe-valorhaber) as mtotal201 FROM contabilidad WHERE fechareg BETWEEN '$fecha_de' AND '$fecha_a' AND cuenta= '201' ");

        $row201 = mysqli_fetch_array($suma201,MYSQLI_ASSOC);

        $ctsxpag1 = ($row201["mtotal201"]);

        $suma206 = mysqli_query($conection,"SELECT SUM(valordebe-valorhaber) as mtotal206 FROM contabilidad WHERE fechareg BETWEEN '$fecha_de' AND '$fecha_a' AND cuenta= '206' ");

        $row206 = mysqli_fetch_array($suma206,MYSQLI_ASSOC);

        $emplexpag1 = ($row206["mtotal206"]);

        $suma207 = mysqli_query($conection,"SELECT SUM(valordebe-valorhaber) as mtotal207 FROM contabilidad WHERE fechareg BETWEEN '$fecha_de' AND '$fecha_a' AND cuenta= '207' ");

        $row207 = mysqli_fetch_array($suma207,MYSQLI_ASSOC);

        $iesspatxpag1 = ($row207["mtotal207"]);

        $suma204 = mysqli_query($conection,"SELECT SUM(valordebe-valorhaber) as mtotal204 FROM contabilidad WHERE fechareg BETWEEN '$fecha_de' AND '$fecha_a' AND cuenta= '204' ");

        $row204 = mysqli_fetch_array($suma204,MYSQLI_ASSOC);

        $ivaventas1 = ($row204["mtotal204"]);

        $suma251 = mysqli_query($conection,"SELECT SUM(valordebe-valorhaber) as mtotal251 FROM contabilidad WHERE fechareg BETWEEN '$fecha_de' AND '$fecha_a' AND cuenta= '251' ");

        $row251 = mysqli_fetch_array($suma251,MYSQLI_ASSOC);

        $obligacionesfinancierasLP = ($row251["mtotal251"]);



        ?>

        <tr>

            <td>Efectivo y Equivalentes</td>

            <td class="textright"><?php



                $efectivo = $ingresos + $ingresos*0.12 - $rirv - $rivav - $ivac - $doctosxpag + $efectivo1;

                //$efectivo = ($row1["mtotal1"]+$row2["mtotal2"])+($row101["mtotal101"])+

                //    ($row3["mtotal3"]+$row4["mtotal4"])-($row5["mtotal5"]+$row6["mtotal6"])-

                //    ($row7["mtotal7"]+$row8["mtotal8"])-($row9["mtotal9"]);



                echo number_format($efectivo,2,',', '.'); ?></td>

        </tr>

        <tr>

            <td>Retenciones Renta</td>

            <td class="textright"><?php



                echo number_format($rirv,2,',', '.'); ?></td>

        </tr>

        <!--

        <tr>

            <td>Retenciones IVA</td>

            <td class="textright"><?php



                if (($rivav - $ivac )>0) {

                    echo number_format(0, 2, ',', '.');

                }else{

                    echo number_format($ivac - $rivav, 2, ',', '.');

                }

                ?></td>

        </tr>



        <tr>

            <td>IVA Compras</td>

            <td class="textright"><?php



                if (($ivac - $ingresos*0.12)>0) {

                    echo number_format(($ivac - $ingresos*0.12), 2, ',', '.');

                }else{

                    echo number_format(($ingresos*0.12 - $ivac), 2, ',', '.');

                }



                ?></td>

        </tr>

   -->



        <tr>

            <th>Total USD Activo Corriente: <?php echo date_format (new DateTime($fecha_de),'d-m-Y');?> - <?php echo date_format (new DateTime($fecha_a),'d-m-Y');?> </th>

            <th class="textright"><?php



            echo number_format(($efectivo+$rirv),2,',', '.'); ?></td>

                </th>



        </tr>



    </table>



    <table>

        <tr>

            <td>Cuentas por Pagar Años Anteriores</td>

            <td class="textright"><?php echo number_format($ctsxpag-$ctsxpag1,2,',', '.'); ?></td>

        </tr>



        <tr>

            <td>Obligaciones Financieras</td>

            <td class="textright"><?php



                echo number_format(-$obligacionesfinancieras,2,',', '.'); ?></td>

        </tr>



        <tr>

            <td>Documentos por Pagar</td>

            <td class="textright"><?php



                echo number_format($doctosxpag1,2,',', '.'); ?></td>

        </tr>

        <tr>

            <td>Sueldos por Pagar</td>

            <td class="textright"><?php



                echo number_format(($emplexpag-$emplexpag1),2,',', '.'); ?></td>

        </tr>

        <tr>

            <td>Aporte Patronal por Pagar</td>

            <td class="textright"><?php



                echo number_format(($iesspatxpag-$iesspatxpag1),2,',', '.'); ?></td>

        </tr>

        <tr>

            <td>Décimo Tercero y Cuarto por Pagar</td>

            <td class="textright"><?php



                echo number_format(($provisempl-$provisempl1),2,',', '.'); ?></td>

        </tr>



        <tr>

            <td>IVA en Ventas</td>

            <td class="textright"><?php



               if (($ingresos*0.12 +3348.90- $ivac - $rivav - $ivaventas1 )>0) {

                    echo number_format(($ingresos*0.12+3348.90-$ivac-$rivav-$ivaventas1), 2, ',', '.');

                }else{

                    echo number_format(0, 2, ',', '.');

                }

               ?></td>

        </tr>

        <tr>

            <th>Total USD Pasivo Corriente: <?php echo date_format (new DateTime($fecha_de),'d-m-Y');?> - <?php echo date_format (new DateTime($fecha_a),'d-m-Y');?> </th>

            <th class="textright"><?php



                echo number_format(($ctsxpag -$ctsxpag1 -$doctosxpag1 + $provisempl -$provisempl1 -$obligacionesfinancieras

                    + $ingresos*0.12 +3348.90 - $ivac - $rivav-$ivaventas1+$emplexpag-$emplexpag1+$iesspatxpag-$iesspatxpag1),2,',', '.');



                ?></th>



        </tr>



    </table>

    <table>

<tr>

    <td>Obligaciones Financieras Largo Plazo</td>

    <td class="textright"><?php



        echo number_format(-$obligacionesfinancierasLP,2,',', '.'); ?></td>

</tr>


<tr>

    <th>Total USD Pasivo NO Corriente: <?php echo date_format (new DateTime($fecha_de),'d-m-Y');?> - <?php echo date_format (new DateTime($fecha_a),'d-m-Y');?> </th>

    <th class="textright"><?php



        echo number_format(( -$obligacionesfinancierasLP),2,',', '.');



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

        $suma140 = mysqli_query($conection,"SELECT SUM(ganejer-perdejer) as mtotal140 FROM movpatrim WHERE fechapatrim BETWEEN '2022-01-01' AND '2022-12-31'");

        $row140 = mysqli_fetch_array($suma140,MYSQLI_ASSOC);



        ?>

        <tr>

            <td>Capital</td>

            <td class="textright"><?php echo number_format(($row11["mtotal11"]),2,',', '.'); ?></td>

        </tr>

        <tr>

            <td>Resultados Acumulados</td>

            <td class="textright"><?php echo number_format(($row12["mtotal12"]+$row140["mtotal140"]),2,',', '.'); ?></td>

        </tr>

        <tr>

            <td>Resultado del Ejercicio</td>

            <td class="textright"><?php echo number_format(($ingresos-$egresos+1065.9),2,',', '.'); ?></td>

        </tr>

        <tr>

            <th>Total USD Patrimonio: <?php echo date_format (new DateTime($fecha_de),'d-m-Y');?> - <?php echo date_format (new DateTime($fecha_a),'d-m-Y');?> </th>

            <th class="textright"><?php echo number_format($row11["mtotal11"]+$row12["mtotal12"]+

                    $row13["mtotal13"]+($ingresos-$egresos+1065.9),2,',', '.'); ?></th>



        </tr>

        <tr>

            <th>Total USD Pasivo y Patrimonio: <?php echo date_format (new DateTime($fecha_de),'d-m-Y');?> - <?php echo date_format (new DateTime($fecha_a),'d-m-Y');?> </th>

            <th class="textright"><?php



                echo number_format(($ctsxpag -$ctsxpag1 -$doctosxpag1 + $provisempl -$provisempl1 -$obligacionesfinancieras -$obligacionesfinancierasLP

                        + $ingresos*0.12 +3348.90 - $ivac - $rivav -$ivaventas1+$emplexpag-$emplexpag1+$iesspatxpag-$iesspatxpag1)+

                    ($row11["mtotal11"]+$row12["mtotal12"]+$row13["mtotal13"]+($ingresos-$egresos+1065.9)),2,',', '.');



                ?></th>



        </tr>

    </table>





</section>



<section id="container">



    <h1>&#128210; Balance General EA 2021</h1><br><br>





    <div>

        <h4>Estado Financiero Declarado y Cerrado al 31 de diciembre 2021</h4>



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

            <th>Total USD Activo Corriente 2021: </th>

            <th class="textright">0,00</th>



        </tr>



    </table>



    <table>



        <tr>

            <td>Cuentas por Pagar Años Anteriores</td>

            <td class="textright">11.291,48</td>

        </tr>

        <tr>

            <td>Documentos por Pagar</td>

            <td class="textright">8.374,37</td>

        </tr>

        <tr>

            <td>Obligaciones Laborales por Pagar</td>

            <td class="textright">1.065,91</td>

        </tr>

        <tr>

            <td>IVA en Ventas</td>

            <td class="textright">3.348,90</td>

        </tr>

        <tr>

            <th>Total USD Pasivo Corriente 2021: </th>

            <th class="textright">24.080,65</th>

        </tr>



    </table>



    <table>

        <?php

        //Patrimonio

        $suma14 = mysqli_query($conection,"SELECT SUM(capital) as mtotal14 FROM movpatrim WHERE fechapatrim BETWEEN '2018-07-28' AND '2021-12-31'");

        $row14 = mysqli_fetch_array($suma14,MYSQLI_ASSOC);

        $suma15 = mysqli_query($conection,"SELECT SUM(ganacuml-perdacml) as mtotal15 FROM movpatrim WHERE fechapatrim BETWEEN '2018-07-28' AND '2021-12-31'");

        $row15 = mysqli_fetch_array($suma15,MYSQLI_ASSOC);

        $suma16 = mysqli_query($conection,"SELECT SUM(ganejer-perdejer) as mtotal16 FROM movpatrim WHERE fechapatrim BETWEEN '2021-01-01' AND '2021-12-31'");

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

            <td class="textright"><?php echo number_format(($row16["mtotal16"]),2,',', '.'); ?></td>

        </tr>

        <tr>

            <th>Total USD Patrimonio 2021: </th>

            <th class="textright"><?php echo number_format(($row14["mtotal14"]+$row15["mtotal15"])+

                    ($row16["mtotal16"]),2,',', '.'); ?></th>



        </tr>

        <tr>

            <th>Total USD Pasivo y Patrimonio 2021: </th>

            <th class="textright"><?php echo number_format(("24080.65")+($row14["mtotal14"]+$row15["mtotal15"])+

                    ($row16["mtotal16"]),2,',', '.'); ?></th>



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

            <td class="textright"><?php echo number_format(($row16["mtotal16"])-($row15["mtotal15"]+2898.50),2,',', '.'); ?></td>

        </tr>

        <tr>

            <th>Total USD Patrimonio 2020: </th>

            <th class="textright"><?php echo number_format(($row14["mtotal14"]+$row15["mtotal15"]-2898.50)+

                    ($row16["mtotal16"])-($row15["mtotal15"]),2,',', '.'); ?></th>



        </tr>

        <tr>

            <th>Total USD Pasivo y Patrimonio 2020: </th>

            <th class="textright"><?php echo number_format(("11293.11")+($row14["mtotal14"])-2898.50+

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



