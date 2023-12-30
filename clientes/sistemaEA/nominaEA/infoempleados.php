<?php
session_start();

include "../conexion.php";

if(!empty($_POST))
{
    $alert='';
    if(empty($_POST['cedulaempleado']) || empty($_POST['nombresemple']))
    {
        $alert='<p class="msg_error">Cédula y Nombres Completos son obligatorios.</p>';
    }else{

        $cedulaempleado = $_POST['cedulaempleado'];
        $nombresemple 	= $_POST['nombresemple'];
        $cargo          = $_POST['cargo'];
        $codigoiess     = $_POST['codigoiess'];
        $jornada   	    = $_POST['jornada'];
        $acmldecterc    = $_POST['acmldecterc'];
        $acmldeccua	    = $_POST['acmldeccua'];
        $acmlfonresv   	= $_POST['acmlfonresv'];
        $formadepago    = $_POST['formadepago'];
        $fechaingiess   = $_POST['fechaingiess'];
        $discapacidad   = $_POST['discapacidad'];
        $sueldo         = $_POST['sueldo'];
        $usuario_id	    = $_SESSION['idUser'];

        $result = 0;

        if(is_numeric($cedulaempleado))
        {
            $query = mysqli_query($conection,"SELECT * FROM infoempleados WHERE cedulaempleado = '$cedulaempleado' ");
            $result = mysqli_fetch_array($query);
        }
        if($result > 0){
            $alert='<p class="msg_error">La cédula ya existe.</p>';
        }else{

            $query_insert = mysqli_query($conection,"INSERT INTO infoempleados(cedulaempleado,nombresemple,cargo,
                          codigoiess,jornada,acmldecterc,acmldeccua,acmlfonresv,formadepago,fechaingiess,discapacidad,sueldo,usuario_id)
																	VALUES('$cedulaempleado','$nombresemple','$cargo',
						'$codigoiess','$jornada','$acmldecterc','$acmldeccua','$acmlfonresv','$formadepago','$fechaingiess','$discapacidad','$sueldo','$usuario_id')");
            if($query_insert){
                $alert='<p class="msg_save">Empleado creado correctamente.</p>';
            }else{
                $alert='<p class="msg_error">Error al crear el Empleado.</p>';
            }
        }
    }
    mysqli_close($conection);
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <title>Registro Empleados EA</title>
    <link rel="icon" href="../imagenesEA/logoestratega.png" type="image/x">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../css/jquery.min.js"></script>
    <script type="text/javascript" src="../css/functions.js"></script>


    <?php include "../../functions.php"; ?>


</head>
<body>
<?php include "../header.php"; ?>
<section id="container">

    <div class="form_register">
        <h1>&#129299;Registro Empleado</h1>
        <hr>
        <div class="alert"><?php echo isset($alert) ? $alert : ''; ?></div>

        <form action="" method="post">
            <label for="cedulaempleado">Cédula Empleado</label>
            <input type="text" name="cedulaempleado" id="cedulaempleado" maxlength="10" minlength="10" placeholder="Aquí el número de cédula del empleado" required>
            <label for="nombresemple">Nombres Completos del Empleado</label>
            <input type="text" name="nombresemple" id="nombresemple" placeholder="Aquí los nombres completos del empleado" required>
            <label for="sueldo">Sueldo Mensual USD</label>
            <input type="number" step="any" name="sueldo" id="sueldo" placeholder="Ingrese el sueldo del empleado" required>
            <label for="cargo"><strong>SELECCIONAR EL CARGO DEL EMPLEADO</strong></label>
            Asistente Administrativo: <input type="checkbox" name="cargo" id="cargo" value="Asistente Administrativo">
            Relacionador Público: <input type="checkbox" name="cargo" id="cargo" value="Relacionador Público">
            Conserje: <input type="checkbox" name="cargo" id="cargo" value="Conserje">
            Entrenador Deportivo: <input type="checkbox" name="cargo" id="cargo" value="Entrenador Deportivo">
            <label for="codigoiess">Código Iess del Empleado</label>
            <input type="number" name="codigoiess" id="codigoiess" maxlength="13" minlength="13" placeholder="¿Qué código tiene el cargo en el Iess?" required>
            <label for="jornada"><strong>Seleccionar el Tipo de Jornada</strong></label>
            Completa: <input type="checkbox" name="jornada" id="jornada" value="Completa">
            Parcial: <input type="checkbox" name="jornada" id="jornada" value="Parcial">
            <label for="acmldecterc"><strong>¿Acumula décimo tercero?</strong></label>
            Si: <input type="checkbox" name="acmldecterc" id="acmldecterc" value="SI">
            No: <input type="checkbox" name="acmldecterc" id="acmldecterc" value="NO">
            <label for="acmldeccua"><strong>¿Acumula décimo cuarto?</strong></label>
            Si: <input type="checkbox" name="acmldeccua" id="acmldeccua" value="SI">
            No: <input type="checkbox" name="acmldeccua" id="acmldeccua" value="NO">
            <label for="acmlfonresv"><strong>¿Acumula fondo de reserva?</strong></label>
            Si: <input type="checkbox" name="acmlfonresv" id="acmlfonresv" value="SI">
            No: <input type="checkbox" name="acmlfonresv" id="acmlfonresv" value="NO">
            <label for="formadepago"><strong>Seleccione la Forma de pago al Empleado</strong></label>
            Directa: <input type="checkbox" name="formadepago" id="formadepago" value="Directa">
            Transferencia: <input type="checkbox" name="formadepago" id="formadepago" value="Transferencia">
            <label for="fechaingiess">Fecha de Ingreso al Iess</label>
            <input type="date" name="fechaingiess" id="fechaingiess" placeholder="Según primer aviso de entrada al Iess" required>
            <label for="discapacidad">Porcentaje de discapacidad del Empleado</label>
            <input type="number" name="discapacidad" id="discapacidad" placeholder="% Según carnet del MSP o Conadis" required>

            <button type="submit" class="btn_save">&#128452;Guardar Empleado</button>

        </form>

    </div>

</section>
<?php include "../../footer.php"; ?>
</body>
</html>