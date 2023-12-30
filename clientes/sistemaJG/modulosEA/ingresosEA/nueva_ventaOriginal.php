<?php 
	session_start();
	include "../../conexion.php";	

 ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facturación EA</title>
    <link rel="icon" href="../../imagenesEA/logoestratega.png" type="image/x">
	<link rel="stylesheet" href="../../css/style.css">
    <script src="../inventarioEA/js/jquery.min.js"></script>
	<script type="text/javascript" src="../inventarioEA/js/functions.js"></script>
    
   
    <?php include "../../../functions.php"; ?>

</head>
<body>
    <?php include "header.php"; ?>

    <section id="container">
        <div class="title_page">
            <h1>&#128203; Facturación Ventas EA</h1>
        </div>
        <div class="datos_cliente">
            <div class="action_cliente">
                <h4>Datos del Cliente</h4>
                <a href="#" class="btn_new btn_new_cliente">&#128587; Nuevo Cliente</a>        
            </div>
            <form name="form_new_cliente_venta" id="form_new_cliente_venta" class="datos">
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
                    <input type="number" name="tel_cliente" id="tel_cliente" disabled>
                </div>
                <div class="wd100">
                    <label>Dirección</label>
                    <input type="text" name="dir_cliente" id="dir_cliente" disabled>
                </div>
                <div id="div_registro_cliente" class="wd100">
                    <button type="submit" class="btn_save">&#128452; Guardar</button>
                </div>
            </form>
        </div>
        <div class="datos_venta">
            <h4>Información de la Venta</h4>
            <div class="datos">
                <div class="wd50">
                    <label>Vendedor</label>
                    <p><?php echo $_SESSION['nombre']; ?></p>
                </div>
                <div class="wd50">
                    <label>Acciones</label>
                    <div id="acciones_venta">
                        <a href="#" class="btn_ok textcenter" id="btn_anular_venta">&#128683; Limpiar Pantalla</a>
                        <a href="#" class="btn_new textcenter" id="btn_facturar_venta" style="display: none;">&#9881; Procesar</a>
                    </div>
                </div>
            </div>
        </div>

        <table class="tbl_venta">
            <thead>
                <tr>
                    <th width="100px">Código</th>    
                    <th>Descripción</th>
                    <th>Existencias</th>
                    <th width="100px">Cantidad</th>
                    <th class="textright">Precio</th>
                    <th class="textright">Precio Total</th>
                    <th>Acción</th>
                </tr>    
                <tr>
                    <td><input type="text" name="txt_cod_producto" id="txt_cod_producto"></td>
                    <td id="txt_descripcion">-</td>
                    <td id="txt_existencia">-</td>
                    <td><input type="text" name="txt_cant_producto" id="txt_cant_producto" value="0" min="1" disabled></td>
                    <td id="txt_precio" class="textright">0.00</td>
                    <td id="txt_precio_total" class="textright">0.00</td>
                    <td> <a href="#" id="add_product_venta" class="link_add">&#128451; Agregar</a></td>
                </tr>
                <tr>
                    <th>Código</th>    
                    <th colspan="2">Descripción</th>
                    <th>Cantidad</th>
                    <th class="textright">Precio</th>
                    <th class="textright">Precio Total</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody id="detalle_venta">
                    <!-- Contenido recibe desde ajax -->

            

            </tbody>
            <tfoot id="detalle_totales">
                <!-- Contenido recibe desde Ajax -->
            </tfoot>

        </table>
    </section>

    <?php include "../../../footer.php"; ?>

    <script type="text/javascript">
    $(document).ready(function(){
            var usuarioid = '<?php echo $_SESSION['idUser']; ?>';
           serchForDetalle(usuarioid); 
    });
</script>


</body>
</html>