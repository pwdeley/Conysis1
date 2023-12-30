
<?php

    include "../conexion.php";
    session_start();
    //print_r($_POST);exit;

    if(!empty($_POST)) {


        //Extraer datos del Proveedor
        if ($_POST['action'] == 'searchProveedor')
        {
            if (!empty($_POST['proveedor'])){
            $nit = $_POST['proveedor'];

            $query = mysqli_query($conection, "SELECT * FROM proveedor WHERE rucproveedor LIKE '$nit' AND estatus = 1");
            mysqli_close($conection);
            $result = mysqli_num_rows($query);

            $data = '';
            if ($result > 0) {
                $data = mysqli_fetch_assoc($query);
            }else{
                $data = 0;
            }
                echo json_encode($data, JSON_UNESCAPED_UNICODE);

            }

            exit;

        }
    }
exit;
    ?>
