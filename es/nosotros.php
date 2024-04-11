<?php
require './conexion/config.php';
session_start();

$title = "Nosotros";
include './TEMPLATE/head.php';
?>
body {
min-height: 100vh;
}

.footer {
  position: fixed;
  left: 0;
  bottom: 0;
  min-width: 100%;
}
<?php
include './TEMPLATE/nav.php';
?>


<!-- Quienes somos -->
<div class="container py-5">
    <h1>¿Quienes somos?</h1>

    <p>Leon Bicicletas es una empresa fundada en 1995 con la finalidad de proporcionar la mejor experiencia para
        nuestros clientes. Nuestra tienda se caracteriza por siempre contar con productos de alta calidad y de las
        mejores marcas en el mercado para obtener el mejor rendimiento en tu bicicleta,Contamos con técnicos altamente
        capacitados en el ramo que te brindaran asesoría personalizada a todos nuestros clientes para fomentar una
        cultura de ciclismo.</p>

    <h4>Misión de Leon Bicicletas:</h4>

    <p>Proporcionar a nuestros clientes la mejor experiencia en el mundo del ciclismo, ofreciendo productos de alta
        calidad y de las mejores marcas del mercado. A través de nuestra asesoría personalizada por técnicos altamente
        capacitados, fomentamos una cultura de ciclismo que promueve la salud, el bienestar y la conexión con la
        naturaleza.</p>

    <h4>Visión de Leon Bicicletas:</h4>

    <p>Ser reconocidos como la tienda líder en el mercado de bicicletas, destacándonos por la excelencia en nuestros
        productos y servicios. Buscamos ser la primera opción para los entusiastas del ciclismo, creando un impacto
        positivo en la comunidad y contribuyendo al desarrollo sostenible mediante el fomento de medios de transporte
        amigables con el medio ambiente. Nuestro objetivo es seguir innovando y expandiendo nuestra oferta para seguir
        brindando las mejores soluciones a nuestros clientes. <br></p>
</div>


<?php
include './TEMPLATE/footer.php';
?>