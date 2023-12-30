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
          ['Enero',  7726,      10504],
          ['Febrero',  9120,      9984],
          ['Marzo',  8423,       10244],
          ['Abril',  8423,      10244],
          ['Mayo',  8423,      10244],
          ['Junio',  8423,      10244],
          ['Julio',  8423,      10244],
          ['Agosto',  8423,      10244],
          ['Septiembre',  8423,      10244],
          ['Octubre',  8423,      10244],
          ['Noviembre',  8423,      10244],
          ['Diciembre',  8423,      10244]
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
          ['Marzo',  1010,       1082],
          ['Abril',  1010,      1082],
          ['Mayo',  1010,      1082],
          ['Junio',  1010,      1082],
          ['Julio',  1010,      1082],
          ['Agosto',  1010,      1082],
          ['Septiembre',  1010,      1082],
          ['Octubre',  1010,      1082],
          ['Noviembre',  1010,      1082],
          ['Diciembre',  1010,      1082],
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
     <img class="photouser" src="../imagenesEA/user.png" alt="Usuario">
    <!-- <span style="font-size: 16px; color:white" class="user"><?php echo $_SESSION['user'].' -'.$_SESSION['rol']; ?></span> -->
 
   </div>
   <div class="side-bar">
     <div class="close-btn">
       <i>&#88; </i>
     </div>
     <div class="menu">
       <div class="item"><a href="../../../index.php"><i>&#127946;</i>Cerrar Sesión</a></div>
       <div class="item">
         <a class="sub-btn"><i>&#10051;</i>Ingresos<i class="fas dropdown">&#10148;</i></a>
         <div class="sub-menu">
           <a href="ingresosEA/lista_clientes.php" class="sub-item">&#128587; Clientes</a>
           <a href="ingresosEA/nueva_venta.php" class="sub-item">&#9989; Ventas</a>
        </div>
       </div>
       <div class="item">
         <a class="sub-btn"><i>&#10051;</i>Egresos<i class="fas dropdown">&#10148;</i></a>
         <div class="sub-menu">
           <a href="egresosEA/lista_proveedor.php" class="sub-item">&#128129; Proveedores</a>
           <a href="egresosEA/nueva_compra.php" class="sub-item">&#128717; Compras</a>
        </div>
       </div>
       <div class="item">
         <a class="sub-btn"><i>&#10051;</i>Empleados<i class="fas dropdown">&#10148;</i></a>
         <div class="sub-menu">
           <a href="../../../paginas/mantenimiento.html" class="sub-item">&#128106; Información</a>
           <a href="../../../paginas/mantenimiento.html" class="sub-item">&#128588; Descuentos</a>
           <a href="../../../paginas/mantenimiento.html" class="sub-item">&#128583; Nómina</a>
        </div>
       </div>
       <div class="item">
         <a class="sub-btn"><i>&#10051;</i>Inventario<i class="fas dropdown">&#10148;</i></a>
         <div class="sub-menu">
           <a href="inventarioEA/registro_producto.php" class="sub-item">&#128230; Nuevos Art.</a>
           <a href="inventarioEA/lista_producto.php" class="sub-item">&#127857; Productos</a>
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