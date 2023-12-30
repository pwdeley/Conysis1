<?php 
    session_start();
    include "../conexion.php";


 ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compras EA</title>
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
            <h1>&#128203; Compras EA</h1>
        </div>
       
        

        <div class="datos_factura">
            <div class="action_factura">
                <h1>Registro Facturas de Compras</h1><br><br>
                <a href="registro_proveedor.php" target="_blank" class="btn_new">&#10133;&#128100; Crear Proveedor</a>
            </div>
           
            <form  action="insertarfacturaC.php" class="datosfacturaC" method="POST" enctype="multipart/form-data">

                <div class="wd30">
                    <label>RUC Proveedor</label>
                    <input type="text" name="nit_proveedor" id="nit_proveedor" required>
                </div>

                <div class="wd30">
                    <label>Nombre del Proveedor</label>
                    <input type="text" name="nombre_proveedor" id="nombre_proveedor" required>
                </div>
                <div class="wd30">
                    <label>Actividad</label>
                    <input type="text" name="actividad" id="actividad" >
                </div>
                <div class="wd30">
                    <label>Dirección</label>
                    <input type="text" name="direccion" id="direccion" ><br>
                </div>

                <div class="wd30">
                    <label>Fecha de Emision:</label>
                    <input type="date" name="fechadeemis" id="fechadeemis" required>
                </div>

                <div class="wd30">
                    <label>No. Autorización SRI:</label>
                    <input type="text" name="autorizacionsri" id="autorizacionsri" placeholder="1234567890" minlength="10" required><br>
                </div>
               


                <div class="wd5" >
                    <label>No.Serie Factura:</label>
                    <input class="textright" type="text" name="establecimiento" id="establecimiento" placeholder="000" minlength="3" maxlength="3" required style="width: 62px">
                    <input class="textright" type="text" name="ptoemis" id="ptoemis" placeholder="000" minlength="3" maxlength="3" required style="width: 62px">
                </div>

                <div class="wd30">
                    <label>No.Factura:</label>
                    <input class="textright" type="text" name="secuencial" id="secuencial" placeholder="000000000" maxlength="9" required style="width: 150px"><br>
                </div>

                <input type="hidden" name="action" value="addProveedor" >
                <input type="hidden" id="rucproveedor" name="rucproveedor" value="" required>


                <table class="tbl_venta">
                <thead>
                    <tr>
                        <th width="300px">Descripción de la compra</th>
                        <th width="150px" class="textright">No objeto IVA</th>
                        <th width="150px" class="textright">IVA 0%</th>
                        <th width="150px" class="textright">Subtotal IVA</th>
                        <th width="140px" class="textright">IVA 12%</th>
                        <th width="200px" class="textright">Valor Total</th>
                    </tr>    
                    <tr> 
                        <td>
                            <?php
                            $query_producto = mysqli_query($conection, "SELECT * FROM producto WHERE estatus = 1
                                                                                AND codproducto != 41
                                                                                AND codproducto != 42
                                                                                AND codproducto != 43
                                                                                AND codproducto != 44
                                                                                AND codproducto != 45
                                                                                ORDER BY descripcion ASC");
                            $result_producto = mysqli_num_rows($query_producto);
                            ?>
                            <select name="productoc1" id="productoc1" required>
                                <option value="">Elegir una descripción:</option>
                                <?php
                                    if ($result_producto > 0)
                                    {
                                        while ($producto = mysqli_fetch_array($query_producto)) {
                                            ?>

                                            <option name="productoc1" id="productoc1" value="<?php echo $producto["codproducto"]; ?>"> <?php echo $producto["descripcion"]; ?></option>
                                                <?php
                                                # code...
                                        }
                                    }
                                ?>

                            </select>

                        </td>
                        <td><input type="number" step="any" name="noobjetoiva1" id="noobjetoiva1" value="0.00" class="textright" ></td>
                        <td><input type="number" step="any" name="ivacero1" id="ivacero1" value="0.00" class="textright" ></td>
                        <td><input type="number" step="any" name="txt_precio1" id="txt_precio1" step="0.01" oninput="calcular()" value="0.00" class="textright" ></td>
                        <td><input type="number" step="any" name="txt_iva_ventas1" id="txt_iva_ventas1" class="textright" disabled></td>
                        <td><input type="number" step="any" name="txt_precio_total1" id="txt_precio_total1" class="textright" disabled></td>
                      
                    </tr>
                    <tr>
                        <td>
                            <?php
                            $query_producto = mysqli_query($conection, "SELECT * FROM producto WHERE estatus = 1
                                                                                AND codproducto != 41
                                                                                AND codproducto != 42
                                                                                AND codproducto != 43
                                                                                AND codproducto != 44
                                                                                AND codproducto != 45
                                                                                ORDER BY descripcion ASC");
                            $result_producto = mysqli_num_rows($query_producto);
                            ?>
                            <select name="productoc2" id="productoc2">
                                <option value="">Elegir una descripción:</option>
                                <?php
                                if ($result_producto > 0)
                                {
                                    while ($producto = mysqli_fetch_array($query_producto)) {
                                        ?>

                                        <option name="productoc2" id="productoc2" value="<?php echo $producto["codproducto"]; ?>"> <?php echo $producto["descripcion"]; ?></option>
                                        <?php
                                        # code...
                                    }
                                }
                                ?>

                            </select>

                        </td>
                        <td><input type="number" step="any" name="noobjetoiva2" id="noobjetoiva2" value="0.00" class="textright" ></td>
                        <td><input type="number" step="any" name="ivacero2" id="ivacero2" value="0.00" class="textright" ></td>
                        <td><input type="number" step="any" name="txt_precio2" id="txt_precio2" step="0.01" oninput="calcular()" value="0.00" class="textright" ></td>
                        <td><input type="number" step="any" name="txt_iva_ventas2" id="txt_iva_ventas2" class="textright" disabled></td>
                        <td><input type="number" step="any" name="txt_precio_total2" id="txt_precio_total2" class="textright" disabled></td>

                    </tr>
                    <tr>

                        <th width="100px">TOTALES:</th>
                        <td><input type="number" step="any" name="noobjetoiva" id="noobjetoiva" class="textright" disabled></td>
                        <td><input type="number" step="any" name="ivacero" id="ivacero" class="textright" disabled></td>
                        <td><input type="number" step="any" name="baseiva" id="baseiva" class="textright" disabled></td>
                        <td><input type="number" step="any" name="txt_iva_total" id="txt_iva_total" class="textright" disabled></td>
                        <td><input type="number" step="any" name="txt_precio_total" id="txt_precio_total" class="textright" disabled></td>
                    </tr>    
            </thead>
            
        </table>

                <br><br>
                <table>
                    <thead>
                    <tr>
                        Forma de pago:<br><br>
                        <td>Efectivo: <input type="checkbox" name="formadepago" value="Efectivo" > </td>
                        <td>Transferencia: <input type="checkbox" name="formadepago" value="Transferencia" ></td>
                        <td>Tarjeta de Crédito/Débito: <input type="checkbox" name="formadepago" value="Tarjeta" ></td>
                    </tr>
                    </thead>
                </table>

                <br><br>
                    <input type="file" name="archivo" class="form__file" required>
                    <button type="submit" class="btn_save">&#128452; Procesar Compra</button>
                </div>
            </form>
        </div>
        
  


    </section>

    <?php include "../../footer.php"; ?>

</body>

<script type="text/javascript">
    function calcular() {
        try {
            var a = parseFloat(document.getElementById("txt_precio1").value) || 0,
                b = parseFloat(document.getElementById("noobjetoiva1").value) || 0,
                c = parseFloat(document.getElementById("ivacero1").value) || 0;
            var d = parseFloat(document.getElementById("txt_precio2").value) || 0,
                e = parseFloat(document.getElementById("noobjetoiva2").value) || 0,
                f = parseFloat(document.getElementById("ivacero2").value) || 0;

            document.getElementById("txt_iva_ventas1").value = (a * 0.12).toFixed(2);
            document.getElementById("txt_iva_ventas2").value = (d * 0.12).toFixed(2);
            document.getElementById("txt_precio_total1").value = (b+c+(a * 1.12)).toFixed(2);
            document.getElementById("txt_precio_total2").value = (e+f+(d * 1.12)).toFixed(2);
            document.getElementById("noobjetoiva").value = (b + e).toFixed(2);
            document.getElementById("ivacero").value = (c + f).toFixed(2);
            document.getElementById("baseiva").value = (a + d).toFixed(2);
            document.getElementById("txt_iva_total").value = ((a + d) * 0.12).toFixed(2);
            document.getElementById("txt_precio_total").value = (b+c+e+f+((a + d) * 1.12)).toFixed(2);
        } catch (e) {}
 }
</script>

<script type="text/javascript">
    $(document).ready(function(){
            var usuarioid = '<?php echo $_SESSION['idUser']; ?>';
           serchForDetalle(usuarioid); 
    });
</script>

</html>


