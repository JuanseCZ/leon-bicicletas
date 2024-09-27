<!-- Podrías ayudarme a documentar este codigo por favor? -->



<?php
// Obtenemos la ruta del directorio actual
require './conexion/config.php';
include './cotizar.php';
include './TEMPLATE/head.php';
?>

img {
max-height: 91vh;
}

<?php
include './TEMPLATE/nav.php';
?>


<!-- Creamos un carrusel d -->
<div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel" data-bs-theme="light">
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2" class="active"
            aria-current="true"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
        <div class="carousel-item">
            <img src="./images/Carrusel1.png" class="d-block w-100" alt="">
            <div class="container">
                <div class="carousel-caption text-start">
                    <h1>Visita nuestro catálogo.</h1>
                    <p class="opacity-75">Déjate sorprender por todos nuestros productos.</p>
                    <p><a class="btn btn-lg btn-success" href="./catalogo.php">Catálogo</a></p>
                </div>
            </div>
        </div>
        <div class="carousel-item active">
            <img src="./images/Carrusel2.png" class="d-block w-100" alt="">
            <div class="container">
                <div class="carousel-caption">
                    <h1>Servicio de mantenimiento y reparación.</h1>
                    <p>Estamos capacitados para darle una larga vida a tu bicicleta.</p>
                    <p><a class="btn btn-lg btn-success" href="./categorias/servicios.php">Servicios</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <img src="./images/Carrusel3.png" class="d-block w-100" alt="">
            <div class="container">
                <div class="carousel-caption text-end">
                    <h1>Conócenos.</h1>
                    <p>Contamos con más de 25 años de experiencia en Chihuahua.</p>
                    <p><a class="btn btn-lg btn-success" href="./nosotros.php">Acerca de nosotros</a></p>
                </div>
            </div>
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<hr>


<!-- Últimos artículos / 3 cards horizontales -->
<div class="container">
    <br>
    <h1>Últimos productos</h1>
    <br>

    <?php if ($mensaje != "") { ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $mensaje; ?><a href="./cotizador.php" class="alert-link">Ir al cotizador</a>
        </div>
    <?php } ?>

    <div class="album py-5 bg-body-tertiary">
        <div class="container">

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">

                <?php
                // Obtenemos los últimos 3 productos agregados
                $sql = "CALL lastProd()";
                if ($resultado = $conn->query($sql)) {
                    if ($resultado->num_rows > 0) {
                        // Este while se encarga de imprimir los productos
                        while ($row = $resultado->fetch_array()) {
                            echo '<div class="col pb-3">';
                            echo '<div class="card h-100">';
                            echo '<img src="./images/' . $row['imagen'] . '" class="card-img-top" alt="...">';
                            echo '<div class="card-body d-flex flex-column">';
                            echo '<h5 class="card-title">' . $row['nombre'] . '</h5>';
                            echo '<p class="card-text">' . $row['descripcion'] . '</p>';
                            echo '</div>';
                            echo '<div class="align-text-bottom">';
                            echo '<hr>';
                            echo '<ul class="list-group list-group-flush">';
                            echo '<li class="list-group-item">Precio: <b>$' . $row['valor'] . '</b></li>';
                            echo '</ul>';
                            echo '<hr>';
                            echo '<div class="card-body d-inline-flex">';
                            echo '<form>';
                            echo '<a class="btn btn-success" href="./verProducto.php?id=' . $row['identifier'] . '">Ver</a>';
                            echo '</form>';
                            echo '<form action="" method="post">';
                            echo '<input type="hidden" name="id" id="id" value="' . openssl_encrypt($row['identifier'], COD, KEY) . '">';
                            echo '<input type="hidden" name="nombre" id="nombre" value="' . openssl_encrypt($row['nombre'], COD, KEY) . '">';
                            echo '<input type="hidden" name="precio" id="precio" value="' . openssl_encrypt($row['valor'], COD, KEY) . '">';
                            echo '<input type="hidden" name="cantidad" id="cantidad" value="' . openssl_encrypt(1, COD, KEY) . '">';
                            echo '<button class="btn btn-success mx-3" name="btnAccion" type="submit" value="Agregar">Agregar al cotizador</button>';
                            echo '</form>';
                            echo '<echo /div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';

                        }

                    } else {
                        echo '<div class="alert alert-danger"><em>Pronto agregaremos nuevos productos.</em></div>';
                    }
                } else {
                    echo "Ups! Algo salió mal. Intenta más tarde.";
                }
                $conn->close();

                ?>

            </div>
        </div>
    </div>
</div>


<?php
include './TEMPLATE/footer.php';
?>