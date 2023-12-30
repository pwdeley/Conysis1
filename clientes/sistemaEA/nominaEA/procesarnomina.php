<?php

require '../conexion.php';

$fecha = $_POST["fechaafectacion"];

$horasextras25 = $_POST["hext25"];
$horasextras50 = $_POST["hext50"];
$horasextras100 = $_POST["hext100"];
$otrosingresos = $_POST["otring"];
$prestamosquirografarios = $_POST["prequi"];
$prestamoshipotecarios = $_POST["prehip"];
$anticipos = $_POST["ant"];
$sueldo = $_POST["sueldo"];


$horasextras251 = ($_POST["hext251"]) * ($_POST["sueldo1"]) * (0.25 / 240);
$horasextras501 = $_POST["hext501"] * ($_POST["sueldo1"]) * (1.5 / 240);
$horasextras1001 = $_POST["hext1001"] * ($_POST["sueldo1"]) * (2 / 240);
$otrosingresos1 = $_POST["otring1"];
$prestamosquirografarios1 = $_POST["prequi1"];
$prestamoshipotecarios1 = $_POST["prehip1"];
$anticipos1 = $_POST["ant1"];
$sueldo1   = $_POST["sueldo1"];
$iesspers1 = ($sueldo1 + $horasextras251 + $horasextras501 + $horasextras1001 + $otrosingresos1) * 0.0945 ;
$iesspatr1 = ($sueldo1 + $horasextras251 + $horasextras501 + $horasextras1001 + $otrosingresos1) * 0.1215 ;
$gasto131  = ($sueldo1 + $horasextras251 + $horasextras501 + $horasextras1001 + $otrosingresos1) / 12 ;
$gastofr1  = ($sueldo1 + $horasextras251 + $horasextras501 + $horasextras1001 + $otrosingresos1) / 12 ;

$horasextras252 = $_POST["hext252"] * ($_POST["sueldo2"]) * (0.25 / 240);
$horasextras502 = $_POST["hext502"] * ($_POST["sueldo2"]) * (1.5 / 240);
$horasextras1002 = $_POST["hext1002"] * ($_POST["sueldo2"]) * (2 / 240);
$otrosingresos2 = $_POST["otring2"];
$prestamosquirografarios2 = $_POST["prequi2"];
$prestamoshipotecarios2 = $_POST["prehip2"];
$anticipos2 = $_POST["ant2"];
$sueldo2   = $_POST["sueldo2"];
$iesspers2 = ($sueldo2 + $horasextras252 + $horasextras502 + $horasextras1002 + $otrosingresos2) * 0.0945 ;
$iesspatr2 = ($sueldo2 + $horasextras252 + $horasextras502 + $horasextras1002 + $otrosingresos2) * 0.1215 ;
$gasto132  = ($sueldo2 + $horasextras252 + $horasextras502 + $horasextras1002 + $otrosingresos2) / 12 ;
$gastofr2  = ($sueldo2 + $horasextras252 + $horasextras502 + $horasextras1002 + $otrosingresos2) / 12 ;

$horasextras253 = $_POST["hext253"] * ($_POST["sueldo3"]) * (0.25 / 240);
$horasextras503 = $_POST["hext503"] * ($_POST["sueldo3"]) * (1.5 / 240);
$horasextras1003 = $_POST["hext1003"] * ($_POST["sueldo3"]) * (2 / 240);
$otrosingresos3 = $_POST["otring3"];
$prestamosquirografarios3 = $_POST["prequi3"];
$prestamoshipotecarios3 = $_POST["prehip3"];
$anticipos3 = $_POST["ant3"];
$sueldo3   = $_POST["sueldo3"];
$iesspers3 = ($sueldo3 + $horasextras253 + $horasextras503 + $horasextras1003 + $otrosingresos3) * 0.0945 ;
$iesspatr3 = ($sueldo3 + $horasextras253 + $horasextras503 + $horasextras1003 + $otrosingresos3) * 0.1215 ;
$gasto133  = ($sueldo3 + $horasextras253 + $horasextras503 + $horasextras1003 + $otrosingresos3) / 12 ;
$gastofr3  = ($sueldo3 + $horasextras253 + $horasextras503 + $horasextras1003 + $otrosingresos3) / 12 ;

$horasextras254 = $_POST["hext254"] * ($_POST["sueldo4"]) * (0.25 / 240);
$horasextras504 = $_POST["hext504"] * ($_POST["sueldo4"]) * (1.5 / 240);
$horasextras1004 = $_POST["hext1004"] * ($_POST["sueldo4"]) * (2 / 240);
$otrosingresos4 = $_POST["otring4"];
$prestamosquirografarios4 = $_POST["prequi4"];
$prestamoshipotecarios4 = $_POST["prehip4"];
$anticipos4 = $_POST["ant4"];
$sueldo4   = $_POST["sueldo4"];
$iesspers4 = ($sueldo4 + $horasextras254 + $horasextras504 + $horasextras1004 + $otrosingresos4) * 0.0945 ;
$iesspatr4 = ($sueldo4 + $horasextras254 + $horasextras504 + $horasextras1004 + $otrosingresos4) * 0.1215 ;
$prov134  = ($sueldo4 + $horasextras254 + $horasextras504 + $horasextras1004 + $otrosingresos4) / 12 ;
$gastofr4  = ($sueldo4 + $horasextras254 + $horasextras504 + $horasextras1004 + $otrosingresos4) / 12 ;

$horasextras255 = $_POST["hext255"] * ($_POST["sueldo5"]) * (0.25 / 240);
$horasextras505 = $_POST["hext505"] * ($_POST["sueldo5"]) * (1.5 / 240);
$horasextras1005 = $_POST["hext1005"] * ($_POST["sueldo5"]) * (2 / 240);
$otrosingresos5 = $_POST["otring5"];
$prestamosquirografarios5 = $_POST["prequi5"];
$prestamoshipotecarios5 = $_POST["prehip5"];
$anticipos5 = $_POST["ant5"];
$sueldo5   = $_POST["sueldo5"];
$iesspers5 = ($sueldo5 + $horasextras255 + $horasextras505 + $horasextras1005 + $otrosingresos5) * 0.0945 ;
$iesspatr5 = ($sueldo5 + $horasextras255 + $horasextras505 + $horasextras1005 + $otrosingresos5) * 0.1215 ;
$gasto135  = ($sueldo5 + $horasextras255 + $horasextras505 + $horasextras1005 + $otrosingresos5) / 12 ;
$gastofr5  = ($sueldo5 + $horasextras255 + $horasextras505 + $horasextras1005 + $otrosingresos5) / 12 ;


$sql = "INSERT INTO nomina (fechaafectacion,empleado,sueldo,horaext25, horaext50, horaext100,prestamosqui,prestamoship,otrosing,iesspers,iesspatr,gasto13,gasto14,gastofr,anticipos,prov13,prov14) 
            VALUES ('$fecha','ANDRADE TAMAYO MARIA','$sueldo','$horasextras25','$horasextras50','$horasextras100','$prestamosquirografarios','$prestamoshipotecarios','$otrosingresos',176.00,0.00,0.00,0.00,0.00,'$anticipos',0.00,0.00),
            ('$fecha','ANDRADE TAMAYO ANA VALERIA','$sueldo1','$horasextras251','$horasextras501','$horasextras1001','$prestamosquirografarios1','$prestamoshipotecarios1','$otrosingresos1','$iesspers1','$iesspatr1','$gasto131',35.42,'$gastofr1','$anticipos1',0.00,0.00),
            ('$fecha','CALZADILLA CABELLO OCTAVIO RAFAEL','$sueldo2','$horasextras252','$horasextras502','$horasextras1002','$prestamosquirografarios2','$prestamoshipotecarios2','$otrosingresos2','$iesspers2','$iesspatr2','$gasto132',35.42,'$gastofr2','$anticipos2',0.00,0.00),
            ('$fecha','JARAMILLO CEVALLOS MARY LUZ','$sueldo3','$horasextras253','$horasextras503','$horasextras1003','$prestamosquirografarios3','$prestamoshipotecarios3','$otrosingresos3','$iesspers3','$iesspatr3','$gasto133',35.42,'$gastofr3','$anticipos3',0.00,0.00),
            ('$fecha','ORTEGA MARIN CARLA ROSSY','$sueldo4','$horasextras254','$horasextras504','$horasextras1004','$prestamosquirografarios4','$prestamoshipotecarios4','$otrosingresos4','$iesspers4','$iesspatr4',0.00,0.00,'$gastofr4','$anticipos4','$prov134',35.42),
            ('$fecha','SANDOVAL JARAMILLO EDUARDO DAVID','$sueldo5','$horasextras255','$horasextras505','$horasextras1005','$prestamosquirografarios5','$prestamoshipotecarios5','$otrosingresos5','$iesspers5','$iesspatr5','$gasto135',35.42,'$gastofr5','$anticipos5',0.00,0.00)";




if (mysqli_multi_query($conection,$sql)) {
    echo "<script>alert('Nómina Generada con éxito'); window.location='afectaciones.php'</script>";
}else{
    echo "Error: ".$sql."<br>".mysqli_error($conection);
}

$conection->close();
?>