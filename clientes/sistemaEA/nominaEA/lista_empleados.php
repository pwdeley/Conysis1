<?php
session_start();
include "../conexion.php";
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">

    <title>Lista Empleados EA</title>
    <link rel="icon" href="../imagenesEA/logoestratega.png" type="image/x">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../css/jquery.min.js"></script>
    <script type="text/javascript" src="../css/functions.js"></script>

    <?php include "../../functions.php"; ?>

</head>
<body>

<?php include "../header.php"; ?>
<section id="container">

    <h1>&#128210; Lista de Empleados Activos EA</h1>
    <a href="infoempleados.php" class="btn_new">&#10133; Crear Empleado</a>

    <form action="buscar_empleado.php" method="get" class="form_search">
        <input type="text" name="busqueda" id="busqueda" placeholder="Buscar">
        <input type="submit" value="Buscar" class="btn_search">
    </form>

    <table>
        <tr>
            <th>Cédula</th>
            <th>Nombres</th>
            <th>Cargo</th>
            <th>Código Iess</th>
            <th>Ingreso Iess</th>
            <th>Jornada</th>
            <th>Acumula 13°</th>
            <th>Acumula 14°</th>
            <th>Acumula F.R.</th>
            <th>Pago</th>
            <th>Sueldo</th>
            <th>% Discap.</th>
            <th>Estatus</th>
            <th>Acciones</th>
        </tr>
        <?php
        //Paginador
        $sql_registe = mysqli_query($conection,"SELECT COUNT(*) as total_registro FROM infoempleados WHERE estatus = 1 ");
        $result_register = mysqli_fetch_array($sql_registe);
        $total_registro = $result_register['total_registro'];

        $por_pagina = 10;

        if(empty($_GET['pagina']))
        {
            $pagina = 1;
        }else{
            $pagina = $_GET['pagina'];
        }

        $desde = ($pagina-1) * $por_pagina;
        $total_paginas = ceil($total_registro / $por_pagina);

        $query = mysqli_query($conection,"SELECT * FROM infoempleados 
                                            WHERE estatus = 1 ORDER BY nombresemple ASC LIMIT $desde,$por_pagina 
				");

        mysqli_close($conection);

        $result = mysqli_num_rows($query);
        if($result > 0){

            while ($data = mysqli_fetch_array($query)) {

                ?>
                <tr>
                    <td><?php echo $data["cedulaempleado"]; ?></td>
                    <td><?php echo $data["nombresemple"]; ?></td>
                    <td><?php echo $data["cargo"]; ?></td>
                    <td><?php echo $data["codigoiess"]; ?></td>
                    <td><?php echo $data["fechaingiess"]; ?></td>
                    <td><?php echo $data["jornada"]; ?></td>
                    <td><?php echo $data["acmldecterc"]; ?></td>
                    <td><?php echo $data["acmldeccua"]; ?></td>
                    <td><?php echo $data["acmlfonresv"]; ?></td>
                    <td><?php echo $data["formadepago"]; ?></td>
                    <td><?php echo $data["sueldo"]; ?></td>
                    <td><?php echo $data["discapacidad"]; ?></td>
                    <td><?php echo $data["estatus"]; ?></td>
                    <td>

                        <a class="link_edit" href="editar_empleado.php?id=<?php echo $data["cedulaempleado"]; ?>">Editar</a>
                        <?php if($_SESSION['rol'] == 1 /*para incluir a usuarios rol 2 o 3 que puedan eliminar clientes: || $_SESSION['rol'] == 2  */){ ?>
                            |
                            <a class="link_delete" href="eliminar_confirmar_empleado.php?id=<?php echo $data["cedulaempleado"];
                            ?>">Eliminar</a>
                        <?php } ?>
                    </td>
                </tr>

                <?php
            }

        }
        ?>


    </table>
    <div class="paginador">
        <ul>
            <?php
            if($pagina != 1)
            {
                ?>
                <li><a href="?pagina=<?php echo 1; ?>">|<</a></li>
                <li><a href="?pagina=<?php echo $pagina-1; ?>"><<</a></li>
                <?php
            }
            for ($i=1; $i <= $total_paginas; $i++) {
                # code...
                if($i == $pagina)
                {
                    echo '<li class="pageSelected">'.$i.'</li>';
                }else{
                    echo '<li><a href="?pagina='.$i.'">'.$i.'</a></li>';
                }
            }

            if($pagina != $total_paginas)
            {
                ?>
                <li><a href="?pagina=<?php echo $pagina + 1; ?>">>></a></li>
                <li><a href="?pagina=<?php echo $total_paginas; ?> ">>|</a></li>
            <?php } ?>
        </ul>
    </div>


</section>
<?php include "../../footer.php"; ?>
</body>
</html>
