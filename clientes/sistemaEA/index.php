<?php
			require_once "../conexion.php";
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
 <head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" href="imagenesEA/logoestratega.png" type="image/x">
   <title>Estratega Contable</title>
   <link rel="stylesheet" href="css/estilosEA.css">
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/all.min.css">
   <script src="css/jquery.min.js" charset="utf-8"></script>

   <?php include "../functions.php"; ?>


<!-- Configuración Gráfico Rendimiento -->
<script type="text/javascript" src="css/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Mes', 'Ingresos', 'Egresos'],
          ['Enero',  7726,      11904],
          ['Febrero',  9120,     11385],
          ['Marzo',  11922,       8924],
          ['Abril',  5157,      8965],
          ['Mayo',  3302,      8241],
          ['Junio',  3940,      9346],
          ['Julio',  4500,      11268],
          ['Agosto',  6578,     10986],
          ['Septiembre',  7445,      9884],
          ['Octubre',  7445,      9884],
          ['Noviembre',  7445,      9884],
          ['Diciembre',  7445,      9884]
        ]);

        var options = {
          title: 'Rendimiento EADEPOR S.A.', titleTextStyle: {color: 'green'},
          hAxis: {title: 'Meses 2021',  titleTextStyle: {color: 'red'}},
          vAxis: {minValue: 0},
          backgroundColor: '#eafaf1',
          width: 1000,
            height: 400,
          is3D: true,
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Mes', 'Ventas', 'Compras+Retenciones'],
          ['Enero',  927,      1049],
          ['Febrero',  1094,      1116],
          ['Marzo',  1431,       727],
          ['Abril',  619,      575],
          ['Mayo',  396,      503],
          ['Junio',  468,      688],
          ['Julio',  540,      961],
          ['Agosto',  789,      951],
          ['Septiembre',  893,     794],
          ['Octubre',  893,      794],
          ['Noviembre',  893,      794],
          ['Diciembre',  893,      794],
        ]);

        var options = {
          title: 'Tendencia Impuesto al Valor Agregado - IVA EADEPOR S.A.', titleTextStyle: {color: 'green'},
          hAxis: {title: 'Meses 2021',  titleTextStyle: {color: 'red'}},
          vAxis: {minValue: 0},
          backgroundColor: '#eafaf1',
          width: 1000,
            height: 400,
          is3D: true
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div2'));
        chart.draw(data, options);

      }
    </script>

</head>
 <body>

   <div class="menu-btn">
   <i>&#9776;  &#127946; EA GESTION DEPORTIVA&nbsp;&nbsp;&nbsp;</i>
     <a style="font-size: 16px; color:white">   Quito, <?php echo fechaC(); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
     <img class="photouser" src="imagenesEA/user.png" alt="Usuario">
    <!-- <span style="font-size: 16px; color:white" class="user"><?php echo $_SESSION['user'].' -'.$_SESSION['rol']; ?></span> -->

   </div>
   <div class="side-bar">
     <div class="close-btn">
       <i>&#88; </i>
     </div>
     <div class="menu">
       <div class="item"><a href="../../index.php"><i>&#127946;</i>Cerrar Sesión</a></div>
       <div class="item">
         <a class="sub-btn"><i>&#10051;</i>Ingresos<i class="fas dropdown">&#10148;</i></a>
         <div class="sub-menu">
           <a href="ingresosEA/lista_clientes.php" class="sub-item">&#128587; Clientes</a>
           <a href="ingresosEA/nueva_venta.php" class="sub-item">&#9989; Ventas</a>
           <a href="ingresosEA/lista_ventas.php" class="sub-item">&#128209; Reporte de Ventas</a>
        </div>
       </div>
       <div class="item">
         <a class="sub-btn"><i>&#10051;</i>Egresos<i class="fas dropdown">&#10148;</i></a>
         <div class="sub-menu">
           <a href="egresosEA/lista_proveedor.php" class="sub-item">&#128129; Proveedores</a>
           <a href="egresosEA/nueva_compra.php" class="sub-item">&#128717; Compras</a>
           <a href="egresosEA/lista_compras.php" class="sub-item">&#128717; Reporte Compras</a>
        </div>
       </div>
       <div class="item">
         <a class="sub-btn"><i>&#10051;</i>Empleados<i class="fas dropdown">&#10148;</i></a>
         <div class="sub-menu">
           <a href="nominaEA/lista_empleados.php" class="sub-item">&#128106; Lista</a>
           <a href="nominaEA/afectaciones.php" class="sub-item">&#128588; Afectaciones</a>
           <!-- <a href="nominaEA/nominaindividual.php" class="sub-item">&#128583; Individual</a> -->
           <a href="nominaEA/nominageneral.php" class="sub-item">&#128583; General</a>
           <a href="nominaEA/costonomina.php" class="sub-item">&#128583; Costo</a>
        </div>
       </div>
      <!--
       <div class="item">
         <a class="sub-btn"><i>&#10051;</i>Inventario<i class="fas dropdown">&#10148;</i></a>
         <div class="sub-menu">
           <a href="inventarioEA/registro_producto.php" class="sub-item">&#128230; Nuevos Art.</a>
           <a href="inventarioEA/lista_producto.php" class="sub-item">&#127857; Productos</a>
        </div>
       </div>
       -->
                <div class="item">
             <a class="sub-btn"><i>&#10051;</i>Estados Financieros<i class="fas dropdown">&#10148;</i></a>
             <div class="sub-menu">
                 <a href="estfinEA/balance_general.php" class="sub-item">&#128215; Balance General</a>
                 <a href="estfinEA/resultados.php" class="sub-item">&#128210; Resultados</a>
                 <a href="estfinEA/movimiento_patrimonial.php" class="sub-item">&#128366; Mov. Patrim.</a>
                 <a href="estfinEA/flujo_efectivo.php" class="sub-item">&#128214; Flujo Efectivo</a>
             </div>
         </div>
   </div>
   </div>
   <section class="main">
   <div>
       <img alt="" src="imagenesEA/nadador.png">
       </div>

   <h1><br><br>Métricas Financieras</h1>
   <!-- Ubicación Gráfico Rendimiento -->
   <div id="chart_div" style="width: 100%; height: 500px;"></div>
   <h1>Tendencia de Impuestos</h1>
   <div id="chart_div2" style="width: 100%; height: 500px;"></div>

    </section>

   <script type="text/javascript">
   $(document).ready(function(){
     //jquery for toggle sub menus
     $('.sub-btn').click(function(){
       $(this).next('.sub-menu').slideToggle();
       $(this).find('.dropdown').toggleClass('rotate');
     });

     //jquery for expand and collapse the sidebar
     $('.menu-btn').click(function(){
       $('.side-bar').addClass('active');
       $('.menu-btn').css("visibility", "hidden");
     });

     $('.close-btn').click(function(){
       $('.side-bar').removeClass('active');
       $('.menu-btn').css("visibility", "visible");
     });
   });
   </script>

 </body>
  <!-- Ubicación Gráfico Rendimiento -->
  <div id="chart_div" style="width: 190px; height: 150px; margin: 150px;"></div>
  <div id="chart_div2" style="width: 190px; height: 150px; margin: 150px;"></div>

  <footer>
        <p class="rights"><span>&copy;&nbsp;</span><span class="copyright-year"></span>. Derechos Reservados. Diseñado por Conysis 2021 <a>Contabilidad y Sistemas</a></p>
    </footer>

</html>
