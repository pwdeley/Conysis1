<?php
session_start();
require "../conexion.php";


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Afectación Nómina EA</title>
    <link rel="icon" href="../imagenesEA/logoestratega.png" type="image/x">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../css/jquery.min.js"></script>
    <script type="text/javascript" src="../css/functions.js"></script>


    <?php include "../../functions.php"; ?>

</head>
<body>
<?php include "../header.php"; ?>

<section id="container">
    <div class="title_page">
        <h1>&#128203; Afectación a la Nómina de EA</h1>
    </div>

    <div class="datos_factura">
        <div class="action_factura">
            <h1>Registro novedades de nómina</h1><br><br>
            <a href="infoempleados.php" target="_blank" class="btn_new">&#10133;&#128100; Crear Empleado</a>
        </div>

        <form action="procesarnomina.php" class="datosafectaciones" method="POST" enctype="multipart/form-data">

            <h2>&#128203; Generación a la Nómina Mensual de EA</h2><br>
            <div class="wd30">
                <label>Fecha de Afectación:</label>
                <input type="date" name="fechaafectacion" id="fechaafectacion" required><br>
            </div>

            <table class="tbl_venta">
                <thead>
                <tr>
                    <th width="600px">Empleado:</th>
                    <th width="100px" class="textright">Sueldo USD</th>
                    <th width="200px" class="textright">No. Horas Extras 25%</th>
                    <th width="200px" class="textright">No. Horas Extras 50%</th>
                    <th width="200px" class="textright">No. Horas Extras 100%</th>
                    <th width="200px" class="textright">Otros Ingresos USD</th>
                    <th width="200px" class="textright">Anticipos USD</th>
                    <th width="200px" class="textright">Prstms Qui.USD</th>
                    <th width="200px" class="textright">Prstms Hip.USD</th>

                </tr>
                </thead>
                <?php
                $sql_registe = mysqli_query($conection,"SELECT * FROM infoempleados WHERE estatus = 1 AND idEmpleado = 1");
                while($sistemas = mysqli_fetch_row($sql_registe)){
                    ?>
                    <tr>
                        <td><?php echo $sistemas[2] ?></td>
                        <input type="hidden" name="empleado" id="empleado" value="<?php echo $sistemas[2] ?>">

                        <td><?php echo $sistemas[12] ?></td>
                        <input type="hidden" name="sueldo" id="sueldo" value="<?php echo $sistemas[12] ?>">

                        <td><input type="number" step="any" name="hext25" id="horasextras25" value="0.00" class="textright" ></td>
                        <td><input type="number" step="any" name="hext50" id="horasextras50" value="0.00" class="textright" ></td>
                        <td><input type="number" step="any" name="hext100" id="horasextras100" value="0.00" class="textright" ></td>
                        <td><input type="number" step="any" name="otring" id="otrosingresos" value="0.00" class="textright" ></td>
                        <td><input type="number" step="any" name="ant" id="anticipos" value="0.00" class="textright" ></td>
                        <td><input type="number" step="any" name="prequi" id="prestamosquirografarios" value="0.00" class="textright" ></td>
                        <td><input type="number" step="any" name="prehip" id="prestamoshipotecarios" value="0.00" class="textright" ></td>

                    </tr>
                <?php } ?>

                <?php
                $sql_registe = mysqli_query($conection,"SELECT * FROM infoempleados WHERE estatus = 1 AND idEmpleado = 2");
                while($sistemas = mysqli_fetch_row($sql_registe)){
                    ?>
                    <tr>
                        <td><?php echo $sistemas[2] ?></td>
                        <input type="hidden" name="empleado1" id="empleado1" value="<?php echo $sistemas[2] ?>">

                        <td><?php echo $sistemas[12] ?></td>
                        <input type="hidden" name="sueldo1" id="sueldo1" value="<?php echo $sistemas[12] ?>">

                        <td><input type="number" step="any" name="hext251" id="horasextras25" value="0.00" class="textright" ></td>
                        <td><input type="number" step="any" name="hext501" id="horasextras50" value="0.00" class="textright" ></td>
                        <td><input type="number" step="any" name="hext1001" id="horasextras100" value="0.00" class="textright" ></td>
                        <td><input type="number" step="any" name="otring1" id="otrosingresos" value="0.00" class="textright" ></td>
                        <td><input type="number" step="any" name="ant1" id="anticipos" value="0.00" class="textright" ></td>
                        <td><input type="number" step="any" name="prequi1" id="prestamosquirografarios" value="0.00" class="textright" ></td>
                        <td><input type="number" step="any" name="prehip1" id="prestamoshipotecarios" value="0.00" class="textright" ></td>

                    </tr>
                <?php } ?>

                <?php
                $sql_registe = mysqli_query($conection,"SELECT * FROM infoempleados WHERE estatus = 1 AND idEmpleado = 3");
                while($sistemas = mysqli_fetch_row($sql_registe)){
                ?>
                <tr>
                    <td><?php echo $sistemas[2] ?></td>
                    <input type="hidden" name="empleado2" id="empleado2" value="<?php echo $sistemas[2] ?>">

                    <td><?php echo $sistemas[12] ?></td>
                    <input type="hidden" name="sueldo2" id="sueldo2" value="<?php echo $sistemas[12] ?>">

                    <td><input type="number" step="any" name="hext252" id="horasextras25" value="0.00" class="textright" ></td>
                    <td><input type="number" step="any" name="hext502" id="horasextras50" value="0.00" class="textright" ></td>
                    <td><input type="number" step="any" name="hext1002" id="horasextras100" value="0.00" class="textright" ></td>
                    <td><input type="number" step="any" name="otring2" id="otrosingresos" value="0.00" class="textright" ></td>
                    <td><input type="number" step="any" name="ant2" id="anticipos" value="0.00" class="textright" ></td>
                    <td><input type="number" step="any" name="prequi2" id="prestamosquirografarios" value="0.00" class="textright" ></td>
                    <td><input type="number" step="any" name="prehip2" id="prestamoshipotecarios" value="0.00" class="textright" ></td>

                </tr>
                <?php } ?>

                <?php
                $sql_registe = mysqli_query($conection,"SELECT * FROM infoempleados WHERE estatus = 1 AND idEmpleado = 4");
                while($sistemas = mysqli_fetch_row($sql_registe)){
                    ?>

                    <tr>
                        <td><?php echo $sistemas[2] ?></td>
                        <input type="hidden" name="empleado3" id="empleado3" value="<?php echo $sistemas[2] ?>">

                        <td><?php echo $sistemas[12] ?></td>
                        <input type="hidden" name="sueldo3" id="sueldo3" value="<?php echo $sistemas[12] ?>">

                        <td><input type="number" step="any" name="hext253" id="horasextras25" value="0.00" class="textright" ></td>
                        <td><input type="number" step="any" name="hext503" id="horasextras50" value="0.00" class="textright" ></td>
                        <td><input type="number" step="any" name="hext1003" id="horasextras100" value="0.00" class="textright" ></td>
                        <td><input type="number" step="any" name="otring3" id="otrosingresos" value="0.00" class="textright" ></td>
                        <td><input type="number" step="any" name="ant3" id="anticipos" value="0.00" class="textright" ></td>
                        <td><input type="number" step="any" name="prequi3" id="prestamosquirografarios" value="0.00" class="textright" ></td>
                        <td><input type="number" step="any" name="prehip3" id="prestamoshipotecarios" value="0.00" class="textright" ></td>

                    </tr>
                <?php } ?>

                <?php
                $sql_registe = mysqli_query($conection,"SELECT * FROM infoempleados WHERE estatus = 1 AND idEmpleado = 5");
                while($sistemas = mysqli_fetch_row($sql_registe)){
                    ?>
                    <tr>
                        <td><?php echo $sistemas[2] ?></td>
                        <input type="hidden" name="empleado4" id="empleado4" value="<?php echo $sistemas[2] ?>">

                        <td><?php echo $sistemas[12] ?></td>
                        <input type="hidden" name="sueldo4" id="sueldo4" value="<?php echo $sistemas[12] ?>">

                        <td><input type="number" step="any" name="hext254" id="horasextras25" value="0.00" class="textright" ></td>
                        <td><input type="number" step="any" name="hext504" id="horasextras50" value="0.00" class="textright" ></td>
                        <td><input type="number" step="any" name="hext1004" id="horasextras100" value="0.00" class="textright" ></td>
                        <td><input type="number" step="any" name="otring4" id="otrosingresos" value="0.00" class="textright" ></td>
                        <td><input type="number" step="any" name="ant4" id="anticipos" value="0.00" class="textright" ></td>
                        <td><input type="number" step="any" name="prequi4" id="prestamosquirografarios" value="0.00" class="textright" ></td>
                        <td><input type="number" step="any" name="prehip4" id="prestamoshipotecarios" value="0.00" class="textright" ></td>

                    </tr>
                <?php } ?>

                <?php
                $sql_registe = mysqli_query($conection,"SELECT * FROM infoempleados WHERE estatus = 1 AND idEmpleado = 6");
                while($sistemas = mysqli_fetch_row($sql_registe)){
                    ?>

                    <tr>
                        <td><?php echo $sistemas[2] ?></td>
                        <input type="hidden" name="empleado5" id="empleado5" value="<?php echo $sistemas[2] ?>">

                        <td><?php echo $sistemas[12] ?></td>
                        <input type="hidden" name="sueldo5" id="sueldo5" value="<?php echo $sistemas[12] ?>">

                        <td><input type="number" step="any" name="hext255" id="horasextras25" value="0.00" class="textright" ></td>
                        <td><input type="number" step="any" name="hext505" id="horasextras50" value="0.00" class="textright" ></td>
                        <td><input type="number" step="any" name="hext1005" id="horasextras100" value="0.00" class="textright" ></td>
                        <td><input type="number" step="any" name="otring5" id="otrosingresos" value="0.00" class="textright" ></td>
                        <td><input type="number" step="any" name="ant5" id="anticipos" value="0.00" class="textright" ></td>
                        <td><input type="number" step="any" name="prequi5" id="prestamosquirografarios" value="0.00" class="textright" ></td>
                        <td><input type="number" step="any" name="prehip5" id="prestamoshipotecarios" value="0.00" class="textright" ></td>

                    </tr>
                <?php } ?>

            </table>

            <br><br>

            <!--  <input type="file" name="archivo" class="form__file" required> -->
            <button type="submit" class="btn_save">&#128452; Procesar Nomina</button>
    </div>
    </form>




</section>

<?php include "../../footer.php"; ?>

</body>



<script type="text/javascript">
    $(document).ready(function(){
        var usuarioid = '<?php echo $_SESSION['idUser']; ?>';
        serchForDetalle(usuarioid);
    });
</script>

</html>


