<?php
if (empty($title)) {
    $title = "León Bicicletas";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous">
        </script>
    <script src="https://kit.fontawesome.com/787ec8e155.js" crossorigin="anonymous"></script>
    <title><?php echo $title ?></title>
    <link rel="icon" href="../../adobe/leonlogonuevo-01.png">
    <style>
        .wrapper {
            width: 80%;
            padding: 15 15 15 15;
        }

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
    </style>
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>

<body>
    <!-- Navbar / Bootstrap / Examples Navbars Expand at lg-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-success" aria-label="Fifth navbar example">
        <div class="container-fluid">
            <a class="navbar-brand" href="../../index.php"><img src="../../adobe/leonlogonuevo2-01.png"
                    alt="logo-leon-bicicletas" style="height: 6vh;">León Bicicletas</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample05"
                aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExample05">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="../../index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../catalogo.php">Catálogo</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                            aria-expanded="false">Categorías</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="../../categorias/bicicletas.php">Bicicletas</a>
                            </li>
                            <li><a class="dropdown-item" href="../../categorias/accesorios.php">Accesorios</a>
                            </li>
                            <li><a class="dropdown-item"
                                    href="../../categorias/refacciones.php">Refacciones</a></li>
                            <li><a class="dropdown-item" href="../../categorias/servicios.php">Servicios</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../contacto.php">Contáctenos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $whereami ?>./cotizador.php">Cotizador
                            (<?php echo (empty($_SESSION['CARRITO']) ? 0 : count($_SESSION['CARRITO'])) ?>)</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../empleados.php">Empleados</a>
                    </li>
                    <li class="nav-item">
                        <?php
                        // Verificar si la variable de sesión está establecida y es true
                        if (!empty($_SESSION["id"])) {
                            // Mostrar el botón o cualquier otro elemento aquí
                            echo '<a class="nav-link active" href="../../administracion.php">Administración</a>';
                        }
                        ?>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto ">
                    <li class="nav-item">
                        <?php
                        // Verificar si la variable de sesión está establecida y es true
                        if (!empty($_SESSION["id"])) {
                            // Mostrar el botón o cualquier otro elemento aquí
                            echo '<a style="color:white;" class="nav-link mr-2">' . $_SESSION["nombre"] . " " . $_SESSION["apellido"] . '  </a> ';
                        }
                        ?>
                    </li>
                    <li class="nav-item">
                        <?php
                        // Verificar si la variable de sesión está establecida y es true
                        if (!empty($_SESSION["id"])) {
                            // Mostrar el botón o cualquier otro elemento aquí
                            echo '<a class="nav-link" style="color:white;" href="../../conexion/controlador_logout.php">Cerrar sesión</a>';
                        }
                        ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>