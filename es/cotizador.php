<?php
require './conexion/config.php';
include './cotizar.php';

$title = "Cotizador";

?>
<?php
include './TEMPLATE/head.php';
?>
table tr td:last-child {
width: 120px;
}

header {
flex: 1;
display: flex;
align-items: center;
grid-column: 50% 50%;
width: 100%;
}

.head-title {
flex: 1;
}

.head-tbtn {
flex: 1;
}

td {
align-items: center;
}

<?php if (empty($_SESSION['CARRITO'])) { 
  echo '.footer {';
  echo '  position: fixed;';
  echo '  left: 0;';
  echo '  bottom: 0;';
  echo '  min-width: 100%;';  
  echo '}';
} 
include './TEMPLATE/nav.php';
?>


<br>
<div class="container-lg">
    <div class="container">
        <header class="header d-flex">
            <div class="head-title">
                <h1>Lista del cotizador</h1>
            </div>
        </header>
        <br>
        <?php if (!empty($_SESSION['CARRITO'])) { ?>
            <table class="table table-light table-bordered table-striped">
                <thead>
                    <tr>
                        <th width="40%">Producto</th>
                        <th class="text-center" width="15%">Cantidad</th>
                        <th class="text-center" width="20%">Precio</th>
                        <th class="text-center" width="20%">Total</th>
                        <th class="text-center" width="5%">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $total = 0; ?>
                    <?php foreach ($_SESSION['CARRITO'] as $indice => $producto) { ?>
                        <tr>
                            <td class="align-middle" width="40%">
                                <?php echo $producto['nombre'] ?>
                            </td>
                            <td class="text-center align-middle" width="15%">
                                <?php echo $producto['cantidad'] ?>
                            </td>
                            <td class="text-center align-middle" width="20%">
                                <?php echo $producto['precio'] ?>
                            </td>
                            <td class="text-center align-middle" width="20%">
                                <?php echo number_format($producto['precio'] * $producto['cantidad'], 2) ?>
                            </td>
                            <td class="text-center" width="5%">

                                <form action="" method="post">

                                    <?php echo '<input type="hidden" name="id" id="id" value="' . openssl_encrypt($producto['id'], COD, KEY) . '">'; ?>

                                    <button type="submit" class="btn btn-danger" name="btnAccion" value="Eliminar">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                            class="bi bi-trash-fill" viewBox="0 0 16 16">
                                            <path
                                                d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z">
                                            </path>
                                        </svg></button>
                                </form>
                            </td>

                        </tr>
                        <?php $total = $total + ($producto['precio'] * $producto['cantidad']); ?>
                    <?php } ?>
                    <tr>
                        <td colspan="3" align="right">
                            <h3>Total:</h3>
                        </td>
                        <td align="right">
                            <h3>
                                <?php echo number_format($total, 2); ?>
                            </h3>
                        </td>
                        <td></td>
                    </tr>

                    <tr>
                        <td colspan="5">
                            <div class="container mt-5">
                                <form action="enviar.php" method="post">
                                    <div class="alert alert-success">
                                        <div class="form-group">
                                            <label for="nombreCot">Nombre</label>
                                            <input type="text" class="form-control" id="nombreCot" name="nombreCot"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="telefonoCot">Teléfono</label>
                                            <input type="text" class="form-control" id="telefonoCot" name="telefonoCot"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="correoCot">Correo electrónico</label>
                                            <input type="email" class="form-control" id="correoCot" name="correoCot"
                                                required>
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-lg btn-block col-12">Enviar</button>
                                </form>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>

        </div>
    </div>

<?php } else { ?>
    <div class="alert alert-success">
        No hay productos en el cotizador...
    </div>

<?php } ?>


<?php
include './TEMPLATE/footer.php';
?>