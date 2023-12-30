<?php 
    session_start();
    include "../conexion.php";   
    $nofactura = "SELECT MAX(nofactura + 1) AS nofactura FROM facturaV";

 ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facturación EA</title>
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
            <h1>&#128203; Ventas EA</h1>
        </div>
       
        

        <div class="datos_factura">
            <div class="action_factura">
                <h1>Facturación</h1><br><br>
                <a href="registro_cliente.php" target="_blank" class="btn_new">&#10133;&#128100; Crear Cliente</a>
            </div>
           
            <form  action="insertarfacturaV.php" class="datosfacturaV" method="POST" enctype="multipart/form-data">
          
                <div class="wd30">
                        <label>Factura No. <?php $resultado = mysqli_query($conection, $nofactura); 
                    while ($row=mysqli_fetch_assoc($resultado)){ ?>
                    <div class="nofactura"><?php echo $row["nofactura"];?></div>
                <?php } mysqli_free_result($resultado);?></label>
                </div>
               
                <div class="wd30">
                    <label>Fecha de Emision:</label>
                    <input type="date" name="fechaemis" id="fechaemis" required>
                </div>      
               
                    <input type="hidden" name="action" value="addCliente" >
                    <input type="hidden" id="idcliente" name="idcliente" value="" required>
                <div class="wd30">
                    <label>RUC Cédula Pasaporte</label>
                    <input type="text" name="nit_cliente" id="nit_cliente" required>
                </div>
                <div class="wd30">
                    <label>Nombre del Cliente</label>
                    <input type="text" name="nom_cliente" id="nom_cliente" required>
                </div>
                <div class="wd30">
                    <label>Teléfono</label>
                    <input type="number" name="tel_cliente" id="tel_cliente" >
                </div>
                <div class="wd30">
                    <label>Dirección</label>
                    <input type="text" name="dir_cliente" id="dir_cliente" ><br>
                </div>
                    
                <table class="tbl_venta">
                <thead>
                    <tr>
                        <th width="100px">Código</th>    
                        <th>Descripción</th>
                        <th class="textright">Precio Unitario</th>
                        <th width="100px">Cantidad</th>
                        <th class="textright">IVA</th>
                        <th class="textright">Precio Total</th>
                    </tr>    
                    <tr> 
                        <td><input type="text" name="txt_cod_producto1" id="txt_cod_producto1"></td>
                        <td id="txt_descripcion">-</td> 
                        <td><input type="number" name="txt_precio1" id="txt_precio1" step="0.01" oninput="calcular()" value="0" min="1" class="textright" disabled></td>
                        <td><input type="number" name="txt_cant_producto1" id="txt_cant_producto1" oninput="calcular()" value="0" min="1" class="textright" disabled></td>
                        <td><input type="number" name="" id="txt_iva_ventas1" class="textright" disabled></td>
                        <td><input type="number" name="" id="txt_precio_total1" class="textright" disabled></td>
                      
                    </tr>
                    <tr>
                        <td><input type="text" name="txt_cod_producto2" id="txt_cod_producto2"></td>
                        <td id="txt_descripcion2">-</td> 
                        <td><input type="number" name="txt_precio2" id="txt_precio2" step="any" oninput="calcular()" value="0" min="1" class="textright" disabled></td>
                        <td><input type="number" name="txt_cant_producto2" id="txt_cant_producto2" oninput="calcular()" value="0" min="1" class="textright" disabled></td>
                        <td><input type="number" name="" id="txt_iva_ventas2" class="textright" disabled></td>
                        <td><input type="number" name="" id="txt_precio_total2" class="textright" disabled></td>
                    </tr>
                    <tr>
                        <th width="100px"></th>    
                        <th></th>
                        <th class="textright"></th>
                        <th width="100px">TOTALES:</th>
                        <td><input type="number" name="txt_iva_total" id="txt_iva_total" class="textright" disabled></td>
                        <td><input type="number" name="txt_precio_total" id="txt_precio_total" class="textright" disabled></td>
                    </tr>    
            </thead>
            
        </table>  
        <br><br>
                <table>
                    <thead>
                        <tr>
        	                Forma de cobro:<br><br>
        	                <td>Efectivo: <input type="checkbox" name="formacobro" value="Efectivo" > </td>
        	                <td>Transferencia: <input type="checkbox" name="formacobro" value="Transferencia" ></td>
        		            <td>Tarjeta de Crédito/Débito: <input type="checkbox" name="formacobro" value="Tarjeta" ></td>
        		        </tr>
        		    </thead>
        		</table>	

        <br><br>
                    <input type="file" name="archivo" class="form__file" required>
                    <button type="submit" class="btn_save">&#128452; Procesar Venta</button>
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
                b = parseFloat(document.getElementById("txt_cant_producto1").value) || 0;
            var c = parseFloat(document.getElementById("txt_precio2").value) || 0,
                d = parseFloat(document.getElementById("txt_cant_producto2").value) || 0;
            document.getElementById("txt_iva_ventas1").value = ((a * b) * 0.12).toFixed(2);
            document.getElementById("txt_iva_ventas2").value = ((c * d) * 0.12).toFixed(2);
            document.getElementById("txt_precio_total1").value = ((a * b) * 1.12).toFixed(2);
            document.getElementById("txt_precio_total2").value = ((c * d) * 1.12).toFixed(2);
            document.getElementById("txt_iva_total").value = (((a * b) + (c * d)) * 0.12).toFixed(2);
            document.getElementById("txt_precio_total").value = (((a * b ) + (c * d)) * 1.12).toFixed(2);
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


