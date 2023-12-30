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

    <title>Resultados EA</title>
    <link rel="icon" href="../imagenesEA/logoestratega.png" type="image/x">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../css/jquery.min.js"></script>
    <script type="text/javascript" src="../css/functions.js"></script>

    <?php include "../../functions.php"; ?>

</head>
<body>

<?php include "../header.php"; ?>
<section id="container">

    <h1>&#128210; Resultados EA 2021</h1><br><br>


    <div>
        <h4>Ingresar la fecha a consultar dentro del período 2021:</h4>
        <form action="resultados.php" method="get" class="form_search_date">
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
            <th>INGRESOS</th>
            <th>Valor USD</th>
        </tr>

        <?php
        // Ventas

        $suma1 = mysqli_query($conection,"SELECT SUM(precio1*cantidad1) as mtotal1 FROM facturaV WHERE fechaemis BETWEEN '$fecha_de' AND '$fecha_a'  AND codprod1 = '41' ");
        $row1 = mysqli_fetch_array($suma1,MYSQLI_ASSOC);
        $suma2 = mysqli_query($conection,"SELECT SUM(precio2*cantidad2) as mtotal2 FROM facturaV WHERE fechaemis BETWEEN '$fecha_de' AND '$fecha_a'  AND codprod2 = '41' ");
        $row2 = mysqli_fetch_array($suma2,MYSQLI_ASSOC);
        $suma3 = mysqli_query($conection,"SELECT SUM(precio1*cantidad1) as mtotal3 FROM facturaV WHERE fechaemis BETWEEN '$fecha_de' AND '$fecha_a' AND codprod1 = '42'");
        $row3 = mysqli_fetch_array($suma3,MYSQLI_ASSOC);
        $suma4 = mysqli_query($conection,"SELECT SUM(precio2*cantidad2) as mtotal4 FROM facturaV WHERE fechaemis BETWEEN '$fecha_de' AND '$fecha_a' AND codprod2 = '42'");
        $row4 = mysqli_fetch_array($suma4,MYSQLI_ASSOC);
        $suma5 = mysqli_query($conection,"SELECT SUM(precio1*cantidad1) as mtotal5 FROM facturaV WHERE fechaemis BETWEEN '$fecha_de' AND '$fecha_a' AND codprod1 = '43'");
        $row5 = mysqli_fetch_array($suma5,MYSQLI_ASSOC);
        $suma6 = mysqli_query($conection,"SELECT SUM(precio2*cantidad2) as mtotal6 FROM facturaV WHERE fechaemis BETWEEN '$fecha_de' AND '$fecha_a' AND codprod2 = '43'");
        $row6 = mysqli_fetch_array($suma6,MYSQLI_ASSOC);
        $suma7 = mysqli_query($conection,"SELECT SUM(precio1*cantidad1) as mtotal7 FROM facturaV WHERE fechaemis BETWEEN '$fecha_de' AND '$fecha_a' AND codprod1 = '44'");
        $row7 = mysqli_fetch_array($suma7,MYSQLI_ASSOC);
        $suma8 = mysqli_query($conection,"SELECT SUM(precio2*cantidad2) as mtotal8 FROM facturaV WHERE fechaemis BETWEEN '$fecha_de' AND '$fecha_a' AND codprod2 = '44'");
        $row8 = mysqli_fetch_array($suma8,MYSQLI_ASSOC);
        $suma9 = mysqli_query($conection,"SELECT SUM(precio1*cantidad1) as mtotal9 FROM facturaV WHERE fechaemis BETWEEN '$fecha_de' AND '$fecha_a' AND codprod1 = '45'");
        $row9 = mysqli_fetch_array($suma9,MYSQLI_ASSOC);
        $suma10 = mysqli_query($conection,"SELECT SUM(precio2*cantidad2) as mtotal10 FROM facturaV WHERE fechaemis BETWEEN '$fecha_de' AND '$fecha_a' AND codprod2 = '45'");
        $row10 = mysqli_fetch_array($suma10,MYSQLI_ASSOC);


        ?>
        <tr>
            <td>Entrenamiento Formativo</td>
            <td class="textright"><?php echo number_format(($row1["mtotal1"]+$row2["mtotal2"]),2,',', '.'); ?></td>
        </tr>
        <tr>
            <td>Implementos Deportivos</td>
            <td class="textright"><?php echo number_format(($row3["mtotal3"]+$row4["mtotal4"]),2,',', '.'); ?></td>
        </tr>
        <tr>
            <td>Entradas Piscina</td>
            <td class="textright"><?php echo number_format(($row5["mtotal5"]+$row6["mtotal6"]),2,',', '.'); ?></td>
        </tr>
        <tr>
            <td>Refrigerios</td>
            <td class="textright"><?php echo number_format(($row7["mtotal7"]+$row8["mtotal8"]),2,',', '.'); ?></td>
        </tr>
        <tr>
            <td>Terapia Acuática</td>
            <td class="textright"><?php echo number_format(($row9["mtotal9"]+$row10["mtotal10"]),2,',', '.'); ?></td>
        </tr>
        <tr>
            <th>Total Ingresos USD: <?php echo date_format (new DateTime($fecha_de),'d-m-Y');?> - <?php echo date_format (new DateTime($fecha_a),'d-m-Y');?> </th>
            <th class="textright"><?php echo number_format(($row1["mtotal1"]+$row2["mtotal2"])+($row3["mtotal3"]+$row4["mtotal4"])+
                    ($row5["mtotal5"]+$row6["mtotal6"])+($row7["mtotal7"]+$row8["mtotal8"])+
                    ($row9["mtotal9"]+$row10["mtotal10"]),2,',', '.'); ?></th>
        </tr>
    </table>
    <br><br>
    <table>
        <tr>
            <th>EGRESOS</th>
            <th>Valor USD</th>
        </tr>

        <?php
        //Compras
        $suma11 = mysqli_query($conection,"SELECT SUM(sueldo+horaext25+horaext50+horaext100+indemnizacion+otrosing) as mtotal11 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a' ");
        $row11 = mysqli_fetch_array($suma11,MYSQLI_ASSOC);
        $suma12 = mysqli_query($conection,"SELECT SUM(gasto13+gasto14+prov13+prov14) as mtotal12 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row12 = mysqli_fetch_array($suma12,MYSQLI_ASSOC);
        $suma13 = mysqli_query($conection,"SELECT SUM(iesspatr+gastofr+provfr) as mtotal13 FROM nomina WHERE fechaafectacion BETWEEN '$fecha_de' AND '$fecha_a'");
        $row13 = mysqli_fetch_array($suma13,MYSQLI_ASSOC);

        ?>
        <tr>
            <td>Sueldos, horas extras, bonificaciones</td>
            <td class="textright"><?php echo number_format(($row11["mtotal11"]),2,',', '.'); ?></td>
        </tr>
        <tr>
            <td>Beneficios Sociales</td>
            <td class="textright"><?php echo number_format(($row12["mtotal12"]),2,',', '.'); ?></td>
        </tr>
        <tr>
            <td>Aportes patronales y fondos de reserva</td>
            <td class="textright"><?php echo number_format(($row13["mtotal13"]),2,',', '.'); ?></td>
        </tr>
        <?php
        //Compras
        $suma14 = mysqli_query($conection,"SELECT SUM(noobjetoiva+ivacero+baseiva) as mtotal14 FROM facturaC WHERE fechadeemis BETWEEN '$fecha_de' AND '$fecha_a' AND productoc1 = '504'");
        $row14 = mysqli_fetch_array($suma14,MYSQLI_ASSOC);
        $suma15 = mysqli_query($conection,"SELECT SUM(noobjetoiva+ivacero+baseiva) as mtotal15 FROM facturaC WHERE fechadeemis BETWEEN '$fecha_de' AND '$fecha_a' AND productoc2 = '504'");
        $row15 = mysqli_fetch_array($suma15,MYSQLI_ASSOC);
        $suma16 = mysqli_query($conection,"SELECT SUM(noobjetoiva+ivacero+baseiva) as mtotal16 FROM facturaC WHERE fechadeemis BETWEEN '$fecha_de' AND '$fecha_a' AND productoc1 = '510'");
        $row16 = mysqli_fetch_array($suma16,MYSQLI_ASSOC);
        $suma17 = mysqli_query($conection,"SELECT SUM(noobjetoiva+ivacero+baseiva) as mtotal17 FROM facturaC WHERE fechadeemis BETWEEN '$fecha_de' AND '$fecha_a' AND productoc2 = '510'");
        $row17 = mysqli_fetch_array($suma17,MYSQLI_ASSOC);
        $suma18 = mysqli_query($conection,"SELECT SUM(noobjetoiva+ivacero+baseiva) as mtotal18 FROM facturaC WHERE fechadeemis BETWEEN '$fecha_de' AND '$fecha_a' AND productoc1 = '511'");
        $row18 = mysqli_fetch_array($suma18,MYSQLI_ASSOC);
        $suma19 = mysqli_query($conection,"SELECT SUM(noobjetoiva+ivacero+baseiva) as mtotal19 FROM facturaC WHERE fechadeemis BETWEEN '$fecha_de' AND '$fecha_a' AND productoc2 = '511'");
        $row19 = mysqli_fetch_array($suma19,MYSQLI_ASSOC);
        $suma20 = mysqli_query($conection,"SELECT SUM(noobjetoiva+ivacero+baseiva) as mtotal20 FROM facturaC WHERE fechadeemis BETWEEN '$fecha_de' AND '$fecha_a' AND productoc1 = '512'");
        $row20 = mysqli_fetch_array($suma20,MYSQLI_ASSOC);
        $suma21 = mysqli_query($conection,"SELECT SUM(noobjetoiva+ivacero+baseiva) as mtotal21 FROM facturaC WHERE fechadeemis BETWEEN '$fecha_de' AND '$fecha_a' AND productoc2 = '512'");
        $row21 = mysqli_fetch_array($suma21,MYSQLI_ASSOC);
        $suma22 = mysqli_query($conection,"SELECT SUM(noobjetoiva+ivacero+baseiva) as mtotal22 FROM facturaC WHERE fechadeemis BETWEEN '$fecha_de' AND '$fecha_a' AND productoc1 = '520'");
        $row22 = mysqli_fetch_array($suma22,MYSQLI_ASSOC);
        $suma23 = mysqli_query($conection,"SELECT SUM(noobjetoiva+ivacero+baseiva) as mtotal23 FROM facturaC WHERE fechadeemis BETWEEN '$fecha_de' AND '$fecha_a' AND productoc2 = '520'");
        $row23 = mysqli_fetch_array($suma23,MYSQLI_ASSOC);
        $suma24 = mysqli_query($conection,"SELECT SUM(noobjetoiva+ivacero+baseiva) as mtotal24 FROM facturaC WHERE fechadeemis BETWEEN '$fecha_de' AND '$fecha_a' AND productoc1 = '521'");
        $row24 = mysqli_fetch_array($suma24,MYSQLI_ASSOC);
        $suma25 = mysqli_query($conection,"SELECT SUM(noobjetoiva+ivacero+baseiva) as mtotal25 FROM facturaC WHERE fechadeemis BETWEEN '$fecha_de' AND '$fecha_a' AND productoc2 = '521'");
        $row25 = mysqli_fetch_array($suma25,MYSQLI_ASSOC);
        $suma26 = mysqli_query($conection,"SELECT SUM(noobjetoiva+ivacero+baseiva) as mtotal26 FROM facturaC WHERE fechadeemis BETWEEN '$fecha_de' AND '$fecha_a' AND productoc1 = '522'");
        $row26 = mysqli_fetch_array($suma26,MYSQLI_ASSOC);
        $suma27 = mysqli_query($conection,"SELECT SUM(noobjetoiva+ivacero+baseiva) as mtotal27 FROM facturaC WHERE fechadeemis BETWEEN '$fecha_de' AND '$fecha_a' AND productoc2 = '522'");
        $row27 = mysqli_fetch_array($suma27,MYSQLI_ASSOC);
        $suma28 = mysqli_query($conection,"SELECT SUM(noobjetoiva+ivacero+baseiva) as mtotal28 FROM facturaC WHERE fechadeemis BETWEEN '$fecha_de' AND '$fecha_a' AND productoc1 = '523'");
        $row28 = mysqli_fetch_array($suma28,MYSQLI_ASSOC);
        $suma29 = mysqli_query($conection,"SELECT SUM(noobjetoiva+ivacero+baseiva) as mtotal29 FROM facturaC WHERE fechadeemis BETWEEN '$fecha_de' AND '$fecha_a' AND productoc2 = '523'");
        $row29 = mysqli_fetch_array($suma29,MYSQLI_ASSOC);
        $suma30 = mysqli_query($conection,"SELECT SUM(noobjetoiva+ivacero+baseiva) as mtotal30 FROM facturaC WHERE fechadeemis BETWEEN '$fecha_de' AND '$fecha_a' AND productoc1 = '524'");
        $row30 = mysqli_fetch_array($suma30,MYSQLI_ASSOC);
        $suma31 = mysqli_query($conection,"SELECT SUM(noobjetoiva+ivacero+baseiva) as mtotal31 FROM facturaC WHERE fechadeemis BETWEEN '$fecha_de' AND '$fecha_a' AND productoc2 = '524'");
        $row31 = mysqli_fetch_array($suma31,MYSQLI_ASSOC);
        $suma32 = mysqli_query($conection,"SELECT SUM(noobjetoiva+ivacero+baseiva) as mtotal32 FROM facturaC WHERE fechadeemis BETWEEN '$fecha_de' AND '$fecha_a' AND productoc1 = '525'");
        $row32 = mysqli_fetch_array($suma32,MYSQLI_ASSOC);
        $suma33 = mysqli_query($conection,"SELECT SUM(noobjetoiva+ivacero+baseiva) as mtotal33 FROM facturaC WHERE fechadeemis BETWEEN '$fecha_de' AND '$fecha_a' AND productoc2 = '525'");
        $row33 = mysqli_fetch_array($suma33,MYSQLI_ASSOC);
        $suma34 = mysqli_query($conection,"SELECT SUM(noobjetoiva+ivacero+baseiva) as mtotal34 FROM facturaC WHERE fechadeemis BETWEEN '$fecha_de' AND '$fecha_a' AND productoc1 = '526'");
        $row34 = mysqli_fetch_array($suma34,MYSQLI_ASSOC);
        $suma35 = mysqli_query($conection,"SELECT SUM(noobjetoiva+ivacero+baseiva) as mtotal35 FROM facturaC WHERE fechadeemis BETWEEN '$fecha_de' AND '$fecha_a' AND productoc2 = '526'");
        $row35 = mysqli_fetch_array($suma35,MYSQLI_ASSOC);
        $suma36 = mysqli_query($conection,"SELECT SUM(noobjetoiva+ivacero+baseiva) as mtotal36 FROM facturaC WHERE fechadeemis BETWEEN '$fecha_de' AND '$fecha_a' AND productoc1 = '527'");
        $row36 = mysqli_fetch_array($suma36,MYSQLI_ASSOC);
        $suma37 = mysqli_query($conection,"SELECT SUM(noobjetoiva+ivacero+baseiva) as mtotal37 FROM facturaC WHERE fechadeemis BETWEEN '$fecha_de' AND '$fecha_a' AND productoc2 = '527'");
        $row37 = mysqli_fetch_array($suma37,MYSQLI_ASSOC);
        $suma38 = mysqli_query($conection,"SELECT SUM(noobjetoiva+ivacero+baseiva) as mtotal38 FROM facturaC WHERE fechadeemis BETWEEN '$fecha_de' AND '$fecha_a' AND productoc1 = '528'");
        $row38 = mysqli_fetch_array($suma38,MYSQLI_ASSOC);
        $suma39 = mysqli_query($conection,"SELECT SUM(noobjetoiva+ivacero+baseiva) as mtotal39 FROM facturaC WHERE fechadeemis BETWEEN '$fecha_de' AND '$fecha_a' AND productoc2 = '528'");
        $row39 = mysqli_fetch_array($suma39,MYSQLI_ASSOC);
        $suma40 = mysqli_query($conection,"SELECT SUM(noobjetoiva+ivacero+baseiva) as mtotal40 FROM facturaC WHERE fechadeemis BETWEEN '$fecha_de' AND '$fecha_a' AND productoc1 = '529'");
        $row40 = mysqli_fetch_array($suma40,MYSQLI_ASSOC);
        $suma41 = mysqli_query($conection,"SELECT SUM(noobjetoiva+ivacero+baseiva) as mtotal41 FROM facturaC WHERE fechadeemis BETWEEN '$fecha_de' AND '$fecha_a' AND productoc2 = '529'");
        $row41 = mysqli_fetch_array($suma41,MYSQLI_ASSOC);
        $suma42 = mysqli_query($conection,"SELECT SUM(noobjetoiva+ivacero+baseiva) as mtotal42 FROM facturaC WHERE fechadeemis BETWEEN '$fecha_de' AND '$fecha_a' AND productoc1 = '530'");
        $row42 = mysqli_fetch_array($suma42,MYSQLI_ASSOC);
        $suma43 = mysqli_query($conection,"SELECT SUM(noobjetoiva+ivacero+baseiva) as mtotal43 FROM facturaC WHERE fechadeemis BETWEEN '$fecha_de' AND '$fecha_a' AND productoc2 = '530'");
        $row43 = mysqli_fetch_array($suma43,MYSQLI_ASSOC);
        $suma44 = mysqli_query($conection,"SELECT SUM(noobjetoiva+ivacero+baseiva) as mtotal44 FROM facturaC WHERE fechadeemis BETWEEN '$fecha_de' AND '$fecha_a' AND productoc1 = '531'");
        $row44 = mysqli_fetch_array($suma44,MYSQLI_ASSOC);
        $suma45 = mysqli_query($conection,"SELECT SUM(noobjetoiva+ivacero+baseiva) as mtotal45 FROM facturaC WHERE fechadeemis BETWEEN '$fecha_de' AND '$fecha_a' AND productoc2 = '531'");
        $row45 = mysqli_fetch_array($suma45,MYSQLI_ASSOC);
        $suma46 = mysqli_query($conection,"SELECT SUM(noobjetoiva+ivacero+baseiva) as mtotal46 FROM facturaC WHERE fechadeemis BETWEEN '$fecha_de' AND '$fecha_a' AND productoc1 = '532'");
        $row46 = mysqli_fetch_array($suma46,MYSQLI_ASSOC);
        $suma47 = mysqli_query($conection,"SELECT SUM(noobjetoiva+ivacero+baseiva) as mtotal47 FROM facturaC WHERE fechadeemis BETWEEN '$fecha_de' AND '$fecha_a' AND productoc2 = '532'");
        $row47 = mysqli_fetch_array($suma47,MYSQLI_ASSOC);
        $suma48 = mysqli_query($conection,"SELECT SUM(noobjetoiva+ivacero+baseiva) as mtotal48 FROM facturaC WHERE fechadeemis BETWEEN '$fecha_de' AND '$fecha_a' AND productoc1 = '533'");
        $row48 = mysqli_fetch_array($suma48,MYSQLI_ASSOC);
        $suma49 = mysqli_query($conection,"SELECT SUM(noobjetoiva+ivacero+baseiva) as mtotal49 FROM facturaC WHERE fechadeemis BETWEEN '$fecha_de' AND '$fecha_a' AND productoc2 = '533'");
        $row49 = mysqli_fetch_array($suma49,MYSQLI_ASSOC);
        $suma50 = mysqli_query($conection,"SELECT SUM(noobjetoiva+ivacero+baseiva) as mtotal50 FROM facturaC WHERE fechadeemis BETWEEN '$fecha_de' AND '$fecha_a' AND productoc1 = '534'");
        $row50 = mysqli_fetch_array($suma50,MYSQLI_ASSOC);
        $suma51 = mysqli_query($conection,"SELECT SUM(noobjetoiva+ivacero+baseiva) as mtotal51 FROM facturaC WHERE fechadeemis BETWEEN '$fecha_de' AND '$fecha_a' AND productoc2 = '534'");
        $row51 = mysqli_fetch_array($suma51,MYSQLI_ASSOC);
        $suma52 = mysqli_query($conection,"SELECT SUM(noobjetoiva+ivacero+baseiva) as mtotal52 FROM facturaC WHERE fechadeemis BETWEEN '$fecha_de' AND '$fecha_a' AND productoc1 = '535'");
        $row52 = mysqli_fetch_array($suma52,MYSQLI_ASSOC);
        $suma53 = mysqli_query($conection,"SELECT SUM(noobjetoiva+ivacero+baseiva) as mtotal53 FROM facturaC WHERE fechadeemis BETWEEN '$fecha_de' AND '$fecha_a' AND productoc2 = '535'");
        $row53 = mysqli_fetch_array($suma53,MYSQLI_ASSOC);
        $suma54 = mysqli_query($conection,"SELECT SUM(noobjetoiva+ivacero+baseiva) as mtotal54 FROM facturaC WHERE fechadeemis BETWEEN '$fecha_de' AND '$fecha_a' AND productoc1 = '536'");
        $row54 = mysqli_fetch_array($suma54,MYSQLI_ASSOC);
        $suma55 = mysqli_query($conection,"SELECT SUM(noobjetoiva+ivacero+baseiva) as mtotal55 FROM facturaC WHERE fechadeemis BETWEEN '$fecha_de' AND '$fecha_a' AND productoc2 = '536'");
        $row55 = mysqli_fetch_array($suma55,MYSQLI_ASSOC);

        ?>
        <tr>
            <td>Atenciones médicas y medicinas</td>
            <td class="textright"><?php echo number_format($row14["mtotal14"]+$row15["mtotal15"],2,',', '.'); ?></td>
        </tr>
        <tr>
            <td>Servicios Profesionales Docentes</td>
            <td class="textright"><?php echo number_format($row16["mtotal16"]+$row17["mtotal17"],2,',', '.'); ?></td>
        </tr>
        <tr>
            <td>Asesorías y permisos legales</td>
            <td class="textright"><?php echo number_format($row18["mtotal18"]+$row19["mtotal19"],2,',', '.'); ?></td>
        </tr>
        <tr>
            <td>Capacitaciones</td>
            <td class="textright"><?php echo number_format($row20["mtotal20"]+$row21["mtotal21"],2,',', '.'); ?></td>
        </tr>
        <tr>
            <td>Mantenimiento</td>
            <td class="textright"><?php echo number_format($row22["mtotal22"]+$row23["mtotal23"],2,',', '.'); ?></td>
        </tr>
        <tr>
            <td>Combustible</td>
            <td class="textright"><?php echo number_format($row24["mtotal24"]+$row25["mtotal25"],2,',', '.'); ?></td>
        </tr>
        <tr>
            <td>Competencias</td>
            <td class="textright"><?php echo number_format($row26["mtotal26"]+$row27["mtotal27"],2,',', '.'); ?></td>
        </tr>
        <tr>
            <td>Implementos Deportivos</td>
            <td class="textright"><?php echo number_format($row28["mtotal28"]+$row29["mtotal29"],2,',', '.'); ?></td>
        </tr>
        <tr>
            <td>Promoción y Publicidad</td>
            <td class="textright"><?php echo number_format($row30["mtotal30"]+$row31["mtotal31"],2,',', '.'); ?></td>
        </tr>
        <tr>
            <td>Suministros de aseo</td>
            <td class="textright"><?php echo number_format($row32["mtotal32"]+$row33["mtotal33"],2,',', '.'); ?></td>
        </tr>
        <tr>
            <td>Suministros de oficina</td>
            <td class="textright"><?php echo number_format($row34["mtotal34"]+$row35["mtotal35"],2,',', '.'); ?></td>
        </tr>
        <tr>
            <td>Suministros Químicos</td>
            <td class="textright"><?php echo number_format($row36["mtotal36"]+$row37["mtotal37"],2,',', '.'); ?></td>
        </tr>
        <tr>
            <td>Alícuotas y rentas</td>
            <td class="textright"><?php echo number_format($row38["mtotal38"]+$row39["mtotal39"],2,',', '.'); ?></td>
        </tr>
        <tr>
            <td>Movilización</td>
            <td class="textright"><?php echo number_format($row40["mtotal40"]+$row41["mtotal41"],2,',', '.'); ?></td>
        </tr>
        <tr>
            <td>Servicios Básicos</td>
            <td class="textright"><?php echo number_format($row42["mtotal42"]+$row43["mtotal43"],2,',', '.'); ?></td>
        </tr>
        <tr>
            <td>Comisiones Bancarias</td>
            <td class="textright"><?php echo number_format($row44["mtotal44"]+$row45["mtotal45"],2,',', '.'); ?></td>
        </tr>
        <tr>
            <td>Transporte</td>
            <td class="textright"><?php echo number_format($row46["mtotal46"]+$row47["mtotal47"],2,',', '.'); ?></td>
        </tr>
        <tr>
            <td>Arrendamientos</td>
            <td class="textright"><?php echo number_format($row48["mtotal48"]+$row49["mtotal49"],2,',', '.'); ?></td>
        </tr>
        <tr>
            <td>Suministros, materiales y repuestos</td>
            <td class="textright"><?php echo number_format($row50["mtotal50"]+$row51["mtotal51"],2,',', '.'); ?></td>
        </tr>
        <tr>
            <td>Seguros</td>
            <td class="textright"><?php echo number_format($row52["mtotal52"]+$row53["mtotal53"],2,',', '.'); ?></td>
        </tr>
        <tr>
            <td>Refrigerios</td>
            <td class="textright"><?php echo number_format($row54["mtotal54"]+$row55["mtotal55"],2,',', '.'); ?></td>
        </tr>

        <tr>
            <th>Total Egresos USD: <?php echo date_format (new DateTime($fecha_de),'d-m-Y');?> - <?php echo date_format (new DateTime($fecha_a),'d-m-Y');?> </th>
            <th class="textright"><?php echo number_format($row11["mtotal11"]+$row12["mtotal12"]+$row13["mtotal13"]+
                    $row14["mtotal14"]+$row15["mtotal15"]+$row16["mtotal16"]+$row17["mtotal17"]+
                    $row18["mtotal18"]+$row19["mtotal19"]+$row20["mtotal20"]+$row21["mtotal21"]+$row22["mtotal22"]+$row23["mtotal23"]+
                    $row24["mtotal24"]+$row25["mtotal25"]+$row26["mtotal26"]+$row27["mtotal27"]+$row28["mtotal28"]+$row29["mtotal29"]+
                    $row30["mtotal30"]+$row31["mtotal31"]+$row32["mtotal32"]+$row33["mtotal33"]+$row34["mtotal34"]+$row35["mtotal35"]+
                    $row36["mtotal36"]+$row37["mtotal37"]+$row38["mtotal38"]+$row39["mtotal39"]+$row40["mtotal40"]+$row41["mtotal41"]+
                    $row42["mtotal42"]+$row43["mtotal43"]+$row44["mtotal44"]+$row45["mtotal45"]+$row46["mtotal46"]+$row47["mtotal47"]+
                    $row48["mtotal48"]+$row49["mtotal49"]+$row50["mtotal50"]+$row51["mtotal51"]+$row52["mtotal52"]+$row53["mtotal53"]+
                    $row54["mtotal54"]+$row55["mtotal55"]
                    ,2,',', '.'); ?></th>
        </tr>

    </table>
<br><br>
    <table>
        <tr>
            <th>Resultado del Ejercicio: <?php echo date_format (new DateTime($fecha_de),'d-m-Y');?> - <?php echo date_format (new DateTime($fecha_a),'d-m-Y');?> </th>
            <th class="textright"><?php echo number_format(($row1["mtotal1"]+$row2["mtotal2"])+($row3["mtotal3"]+$row4["mtotal4"])+
                    ($row5["mtotal5"]+$row6["mtotal6"])+($row7["mtotal7"]+$row8["mtotal8"])+
                    ($row9["mtotal9"]+$row10["mtotal10"])-
                    $row11["mtotal11"]-$row12["mtotal12"]-$row13["mtotal13"]-
                    $row14["mtotal14"]-$row15["mtotal15"]-$row16["mtotal16"]-$row17["mtotal17"]-
                    $row18["mtotal18"]-$row19["mtotal19"]-$row20["mtotal20"]-$row21["mtotal21"]-$row22["mtotal22"]-$row23["mtotal23"]-
                    $row24["mtotal24"]-$row25["mtotal25"]-$row26["mtotal26"]-$row27["mtotal27"]-$row28["mtotal28"]-$row29["mtotal29"]-
                    $row30["mtotal30"]-$row31["mtotal31"]-$row32["mtotal32"]-$row33["mtotal33"]-$row34["mtotal34"]-$row35["mtotal35"]-
                    $row36["mtotal36"]-$row37["mtotal37"]-$row38["mtotal38"]-$row39["mtotal39"]-$row40["mtotal40"]-$row41["mtotal41"]-
                    $row42["mtotal42"]-$row43["mtotal43"]-$row44["mtotal44"]-$row45["mtotal45"]-$row46["mtotal46"]-$row47["mtotal47"]-
                    $row48["mtotal48"]-$row49["mtotal49"]-$row50["mtotal50"]-$row51["mtotal51"]-$row52["mtotal52"]-$row53["mtotal53"]-
                    $row54["mtotal54"]-$row55["mtotal55"],2,',', '.'); ?></th>
        </tr>
    </table>


</section>

<section id="container">

    <h1>&#128210; Estado de Resultados EA 2020</h1><br><br>


    <div>
        <h4>Estado Financiero Declarado y Cerrado al 31 de diciembre 2020</h4>

    </div>
    <br>
    <table>
        <tr>
            <th>INGRESOS</th>
            <th>Valor USD</th>
        </tr>

        <tr>
            <td>Entrenamiento Formativo</td>
            <td class="textright">45.405,35</td>
        </tr>

        <tr>
            <td>Implementos Deportivos</td>
            <td class="textright">1.282,04</td>
        </tr>
        <tr>
            <td>Entradas Piscina</td>
            <td class="textright">5.575,38</td>
        </tr>
        <tr>
            <td>Refrigerios</td>
            <td class="textright">5,52</td>
        </tr>

        <tr>
            <td>Terapia Acuática</td>
            <td class="textright">214,00</td>
        </tr>
        <tr>
            <th>Total Ingresos 2020 USD:</th>
            <th class="textright">52.482,29</th>
        </tr>
    </table>
    <br><br>
    <table>
        <tr>
            <th>EGRESOS</th>
            <th>Valor USD</th>
        </tr>

        <tr>
            <td>Sueldos, horas extras, bonificaciones</td>
            <td class="textright">18.837,93</td>
        </tr>
        <tr>
            <td>Beneficios Sociales</td>
            <td class="textright">4.118,75</td>
        </tr>
        <tr>
            <td>Aportes patronales y fondos de reserva</td>
            <td class="textright">1.777,25</td>
        </tr>
        <tr>
            <td>Servicios Profesionales Docentes</td>
            <td class="textright">6.970,77</td>
        </tr>
        <tr>
            <td>Mantenimiento</td>
            <td class="textright">8.905,92</td>
        </tr>
        <tr>
            <td>Combustible</td>
            <td class="textright">1.950,00</td>
        </tr>
        <tr>
            <td>Promoción y Publicidad</td>
            <td class="textright">1.137,18</td>
        </tr>
        <tr>
            <td>Suministros de oficina</td>
            <td class="textright">1.302,27</td>
        </tr>
        <tr>
            <td>Movilización</td>
            <td class="textright">108,21</td>
        </tr>
        <tr>
            <td>Servicios Básicos</td>
            <td class="textright">4.682,19</td>
        </tr>
        <tr>
            <td>Comisiones Bancarias</td>
            <td class="textright">357,18</td>
        </tr>
        <tr>
            <td>Transporte</td>
            <td class="textright">2.511,01</td>
        </tr>
        <tr>
            <td>Suministros, materiales y repuestos</td>
            <td class="textright">6.415,25</td>
        </tr>
        <tr>
            <td>Refrigerios</td>
            <td class="textright">5.499,86</td>
        </tr>

        <tr>
            <th>Total Egresos 2020 USD: </th>
            <th class="textright">64.573,77</th>
        </tr>

    </table>
    <br><br>
    <table>
        <tr>
            <th>Resultado del Ejercicio 2020:</th>
            <th class="textright">-12.091,48</th>
        </tr>
    </table>


</section>

<section id="container">

    <h1>&#128210; Estado de Resultados EA 2019</h1><br><br>


    <div>
        <h4>Estado Financiero Declarado y Cerrado al 31 de diciembre 2019</h4>

    </div>
    <br>
    <table>
        <tr>
            <th>INGRESOS</th>
            <th>Valor USD</th>
        </tr>

        <tr>
            <td>Entrenamiento Formativo</td>
            <td class="textright">54.252,55</td>
        </tr>
        <tr>
            <td>Entradas Piscina</td>
            <td class="textright">4.346,80</td>
        </tr>
        <tr>
            <td>Terapia Acuática</td>
            <td class="textright">26.065,00</td>
        </tr>
        <tr>
            <th>Total Ingresos 2019 USD:</th>
            <th class="textright">84.664,35</th>
        </tr>
    </table>
    <br><br>
    <table>
        <tr>
            <th>EGRESOS</th>
            <th>Valor USD</th>
        </tr>

        <tr>
            <td>Sueldos, horas extras, bonificaciones</td>
            <td class="textright">55.826,10</td>
        </tr>
        <tr>
            <td>Beneficios Sociales</td>
            <td class="textright">6.810,16</td>
        </tr>
        <tr>
            <td>Aportes patronales y fondos de reserva</td>
            <td class="textright">6.199,75</td>
        </tr>
        <tr>
            <td>Asesorías y permisos legales</td>
            <td class="textright">1.612,22</td>
        </tr>
            <td>Transporte</td>
            <td class="textright">3.800,00</td>
        </tr>
        <tr>
            <td>Arrendamientos</td>
            <td class="textright">970,00</td>
        </tr>
        <tr>
            <td>Suministros, materiales y repuestos</td>
            <td class="textright">7.661,65</td>
        </tr>
        <tr>
            <td>Seguros</td>
            <td class="textright">1.342,03</td>
        </tr>
        <tr>
            <th>Total Egresos 2019 USD: </th>
            <th class="textright">84.221,91</th>
        </tr>

    </table>
    <br><br>
    <table>
        <tr>
            <th>Resultado del Ejercicio 2019:</th>
            <th class="textright">442,44</th>
        </tr>
    </table>


</section>


<section id="container">

    <h1>&#128210; Estado de Resultados EA 2018</h1><br><br>


    <div>
        <h4>Estado Financiero Declarado y Cerrado al 31 de diciembre 2018</h4>

    </div>
    <br>
    <table>
        <tr>
            <th>INGRESOS</th>
            <th>Valor USD</th>
        </tr>

        <tr>
            <td>Entrenamiento Formativo</td>
            <td class="textright">56,35</td>
        </tr>
        <tr>
            <td>Terapia Acuática</td>
            <td class="textright">20.173,60</td>
        </tr>
        <tr>
            <th>Total Ingresos 2018 USD:</th>
            <th class="textright">20.229,95</th>
        </tr>
    </table>
    <br><br>
    <table>
        <tr>
            <th>EGRESOS</th>
            <th>Valor USD</th>
        </tr>
        <tr>
            <td>Sueldos, horas extras, bonificaciones</td>
            <td class="textright">2.781,06</td>
        </tr>
        <tr>
            <td>Beneficios Sociales</td>
            <td class="textright">376,30</td>
        </tr>
        <tr>
            <td>Aportes patronales y fondos de reserva</td>
            <td class="textright">328,02</td>
        </tr>
        <tr>
            <td>Servicios Profesionales Docentes</td>
            <td class="textright">13.900,00</td>
        </tr>
        <tr>
            <td>Mantenimiento</td>
            <td class="textright">1.618,96</td>
        </tr>
        <tr>
            <td>Combustible</td>
            <td class="textright">3.340,61</td>
        </tr>
        <tr>
            <td>Suministros de oficina</td>
            <td class="textright">205,86</td>
        </tr>
        <tr>
            <td>Arrendamientos</td>
            <td class="textright">1.020,00</td>
        </tr>
        <tr>
            <th>Total Egresos 2018 USD: </th>
            <th class="textright">23.570,81</th>
        </tr>

    </table>
    <br><br>
    <table>
        <tr>
            <th>Resultado del Ejercicio 2018:</th>
            <th class="textright">-3.340,86</th>
        </tr>
    </table>


</section>



<?php include "../../footer.php"; ?>
</body>

</html>


