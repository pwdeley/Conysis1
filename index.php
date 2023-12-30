<?php
include("config/cn.php");


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estratega Contable</title>
    <link rel="icon" href="imagenes/logoestratega.png" type="image/x">
    <link rel="stylesheet" href="paginas/estilos.css">
</head>
<body>
    <header>
        <nav>
            <a href="">Inicio</a>
            <a href="paginas/nosotros.html">Nosotros</a>
            <a href="paginas/metodologia.html">Metodología</a>
            <a href="clientes/index.php">Clientes</a>
            <a href="paginas/citas.html">Agende su cita</a>
            <!--
            <a href="Conysis2/public/index.php">Contabilidad</a>
            <a href="paginas/identidaddigital.php">Identidad Digital</a> -->

        </nav>
        <section class="banner">
            <div class="banner-content">
                <h1>Estratega  Contable</h1><br>
                <h2>¡Cumplimiento es nuestro compromiso!</h2><br><br>
                <h3>Contabilidad / Impuestos / Sistemas</h3>
                <h4>& Consultoría Legal</h4><br>
                <h5>Atención confidencial y personalizada a nuestros clientes.</h5>
                <!--<a href="#">Ver articulos</a>-->
            </div>
            <div class="wave" style="height: 120px; overflow: hidden;" ><svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 100%; width: 100%;"><path d="M0.00,49.98 C150.00,150.00 349.20,-50.00 500.00,49.98 L500.00,150.00 L0.00,150.00 Z" style="stroke: none; fill: #fff;"></path></svg></div>
        </section>
    </header>
    <main>
        <section class="principal">
            <h2 class="titulo">Nuestros Servicios</h2>
            <div class="servicios">
                <img src="imagenes/servicios.jpg" alt="" class="imagenservicios">
                <div class="textoservicios">
                    <h3><span>1</span>Contabilidad</h3>
                    <p>Ofrecemos una amplia gama de servicios contables integrales para personas naturales y empresas en todo Ecuador y países latinos.<br>
                    Permítanos encargarnos de su contabilidad y presentarle resultados a tiempo, para la oportuna toma de decisiones de su negocio.<br>
                    O si prefiere utilice nuestro amigable software contable en línea, disponible para clientes en este mismo portal.</p>
                    <h3><span>2</span>Impuestos en el Ecuador</h3>
                    <p>Nuestros clientes se benefician de una previa planificación tributaria mensual para la optimización de sus obligaciones mensuales y anuales.<br>
                    Efectuamos sus declaraciones de impuestos, anexos transaccionales, gastos personales, devoluciones de IVA personas de la tercera edad y discapacidad, entre otras obligaciones fiscales para empresas y personas naturales.</p>
                    <h3><span>3</span>Finanzas</h3>
                    <p>Asesoramos en la administración de su empresa, además ofrecemos diversos servicios financieros que incluyen: presupuestación, flujo correcto de caja, análisis de métricas, herramientas gerenciales, que ayudarán a generar mayor rentabilidad en sus operaciones.</p>
                    <h3><span>4</span>Software y Diseño Web</h3>
                    <p>Incrementa tus ventas, desarrollamos tu idea y la ponemos en vivo. Implementa tu propia página en la web con nuestra ayuda profesional.<br>
                    El software contable que ofertamos y utilizamos es con codificación pura, desarrolado por nuestro equipo técnico en sistemas y en contabilidad, no utilizamos CMS, llamados a otras páginas, mucho menos publicidad. Cada uno de nuestros clientes tiene el beneficio de acceder a su software contable en la web hecho a la medida de sus necesidades y a cualquier momento.</p>
                </div>
            </div>
        </section>
        <section class="principal2">
            <div class="contabilidad">
                <h2 class="titulo"><br>Artículos Relacionados</h2>
                <div class="galeria-contab">
                    <div class="imagen-contab">
                        <img src="imagenes/ahorroimpuestos.jpg">
                        <div class="hover-galeria">
                            <img src="imagenes/focoidea.jpg">
                            <p>Es posible que esté buscando formas nuevas y creativas de aliviar su carga fiscal mensual y anual, minimizando posibles contingencias. Afortunadamente, hay varios aspectos legales que usted puede hacer para reducir o aumentar sus impuestos ...</p>
                        </div>
                    </div>
                    <div class="imagen-contab">
                        <img src="imagenes/deviva.jpg">
                        <div class="hover-galeria">
                            <img src="imagenes/focoidea.jpg">
                            <p><strong>¿Cómo se obtiene una devolución de IVA?</strong><br>
                            Asesoramos a personas de la tercera edad y discapacitados para la obtención de su devolución.</p>
                        </div>
                    </div>
                    <div class="imagen-contab">
                        <img src="imagenes/consultoria.jpg">
                        <div class="hover-galeria">
                            <img src="imagenes/focoidea.jpg">
                            <p><strong>Asesoría Empresarial en Ecuador.<br>
                            Ayudamos a la creación de empresas, asuntos societarios y a la liquidación de las mismas.</strong></p>
                        </div>
                    </div>
                </div>

            </div>

        </section>

    </main>
    <footer>
        <p class="rights"><span>&copy;&nbsp;</span><span class="copyright-year"></span>. Derechos Reservados. Diseñado por Conysis 2021 <a>Contabilidad y Sistemas</a></p>
    </footer>
</body>
</html>
