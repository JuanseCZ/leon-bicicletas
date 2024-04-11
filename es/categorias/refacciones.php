<?php
require '../conexion/config.php';
$whereami = '.';
include '../cotizar.php';

$title = "Refacciones";

include '../TEMPLATE/head.php';
include '../TEMPLATE/nav.php';
?>

<!-- Contenido de la pagina -->
<div class="container">
    <br>
    <h1>Refacciones</h1>
    <div class="album py-5 bg-body-tertiary">
        <div class="container">

            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4">

                <?php
                $sql = "SELECT * FROM productos WHERE idCat = 3";
                if ($resultado = $conn->query($sql)) {
                    if ($resultado->num_rows > 0) {

                        while ($row = $resultado->fetch_array()) {
                            echo '<div class="col pb-3">';
                            echo '<div class="card h-100">';
                            echo '<img src="../images/' . $row['imgProd'] . '" class="card-img-top" alt="...">';
                            echo '<div class="card-body d-flex flex-column">';
                            echo '<h5 class="card-title">' . $row['nomProd'] . '</h5>';
                            echo '<p class="card-text">' . $row['descripcionProd'] . '</p>';
                            echo '</div>';
                            echo '<div class="align-text-bottom">';
                            echo '<hr>';
                            echo '<ul class="list-group list-group-flush">';
                            echo '<li class="list-group-item">Precio: <b>$' . $row['precio'] . '</b></li>';
                            echo '</ul>';
                            echo '<hr>';
                            echo '<div class="card-body d-inline-flex">';
                            echo '<form>';
                            echo '<a class="btn btn-success" href="../verProducto.php?id=' . $row['idProd'] . '">Ver</a>';
                            echo '</form>';
                            echo '<form action="" method="post">';
                            echo '<input type="hidden" name="id" id="id" value="' . openssl_encrypt($row['idProd'], COD, KEY) . '">';
                            echo '<input type="hidden" name="nombre" id="nombre" value="' . openssl_encrypt($row['nomProd'], COD, KEY) . '">';
                            echo '<input type="hidden" name="precio" id="precio" value="' . openssl_encrypt($row['precio'], COD, KEY) . '">';
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
include '../TEMPLATE/footer.php';
?>