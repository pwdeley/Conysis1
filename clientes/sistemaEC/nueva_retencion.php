<?php 

    session_start();

    include "../conexionFE.php";





 ?>

<!DOCTYPE html>

<html lang="es">

<head>

    <meta charset="UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Retenciones EC</title>

    <link rel="icon" href="imagenesEC/logoestratega.png" type="image/x">

    <link rel="stylesheet" href="css/style.css">

</head>

<body>


    <section id="container">

        <div class="title_page">

            <h1>&#128203; Retenciones EC</h1>

        </div>

       

        



        <div class="datos_factura">

            <div class="action_factura">

                <h1>Registro Retenciones Recibidas</h1><br><br>

            </div>
           
            <form  action="insertarRetencion.php" oninput="resultado1.value=(parseInt(baseimponible.value)*0.12*1.00).toFixed(2);

                    resultado2.value=(parseInt(baseimponible.value)*0.10).toFixed(2);

                    resultado3.value=(parseInt(baseimponible.value)*0.12*1.00+parseInt(baseimponible.value)*0.10).toFixed(2);"

                             class="datosfacturaC" method="POST" enctype="multipart/form-data">



                <div class="wd30">

                    <label>RUC Agente de Retención</label>

                    <input type="text" name="nit_proveedor" id="nit_proveedor" required>

                </div>



                <div class="wd30">

                    <label>Nombre del Agente de Retención</label>

                    <input type="text" name="nombre_proveedor" id="nombre_proveedor" style="width: 410px" required>

                </div>



                <div class="wd30">

                    <label>No.Retención:</label>

                    <input class="textright" type="text" name="noretencion" id="noretencion" placeholder="000-000-000000000" maxlength="17" required style="width: 200px">

                </div>



                <div class="wd30">

                    <label>No. Autorización SRI:</label>

                    <input type="text" name="autorizacionsri" id="autorizacionsri" placeholder="1234567890123456789012345678901234567890123456789" minlength="10" maxlength="49" style="width: 410px" required>

                </div>



                <div class="wd30">

                    <label>Fecha de Emisión:</label>

                    <input type="date" name="fechadeemis" id="fechadeemis" required><br>

                </div>

                <div class="wd30">

                    <label>No.Factura que Aplica:</label>

                    <input class="textright" type="text" name="nofactura" id="nofactura" placeholder="000-000-000000000" maxlength="17" required style="width: 200px">

                </div>


                <input type="hidden" name="action" value="addProveedor" >

                <input type="hidden" id="rucproveedor" name="rucproveedor" value="" required>





                <table class="tbl_venta">

                <thead>

                    <tr>

                        <th width="300px">Descripción de la retención</th>

                        <th width="150px" class="textright">Base Imponible</th>

                        <th width="150px" class="textright">Retención IVA 100%</th>

                        <th width="150px" class="textright">Retención Renta 10%</th>

                        <th width="200px" class="textright">Total Retenido</th>

                    </tr>    

                    <tr>

                        <td>Honorarios Profesionales</td>

                        <td><input type="number" step="any" name="baseimponible" id="baseimponible" value="0.00" class="textright" ></td>

                        <td class="textright"><output name="resultado1" for="baseimponible v1" value="0.00"></output></td>

                        <td class="textright"><output name="resultado2" for="baseimponible v2" ></output></td>

                        <td class="textright"><output name="resultado3" for="baseimponible v3" ></output></td>



                    </tr>



            </thead>

            

        </table>



                <br><br>



                    <input type="file" name="archivo" class="form__file" required>

                    <button type="submit" class="btn_save">&#128452; Procesar Retención</button>

                </div>

            </form>

        </div>





    </section>



    <?php include "../footer.php"; ?>



</body>





<script type="text/javascript">

    $(document).ready(function(){

            var usuarioid = '<?php echo $_SESSION['idUser']; ?>';

           serchForDetalle(usuarioid); 

    });

</script>



</html>





