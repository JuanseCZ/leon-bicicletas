<?php
if (empty($whereami)) {
    $whereami = "";
}
?>

</style>

</head>

<body>

    <!-- Navbar / Bootstrap / Examples Navbars Expand at lg-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-success" aria-label="Fifth navbar example">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo $whereami ?>./index.php"><img
                    src="<?php echo "$whereami" ?>./adobe/leonlogonuevo2-01.png" alt="logo-leon-bicicletas"
                    style="height: 6vh;">León Bicicletas</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample05"
                aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarsExample05">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="<?php echo $whereami ?>./index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $whereami ?>./catalogo.php">Catálogo</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"
                            aria-expanded="false">Categorías</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item"
                                    href="<?php echo $whereami ?>./categorias/bicicletas.php">Bicicletas</a></li>
                            <li><a class="dropdown-item"
                                    href="<?php echo $whereami ?>./categorias/accesorios.php">Accesorios</a></li>
                            <li><a class="dropdown-item"
                                    href="<?php echo $whereami ?>./categorias/refacciones.php">Refacciones</a></li>
                            <li><a class="dropdown-item"
                                    href="<?php echo $whereami ?>./categorias/servicios.php">Servicios</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $whereami ?>./contacto.php">Contáctenos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $whereami ?>./cotizador.php">Cotizador (<?php echo (empty($_SESSION['CARRITO'])?0:count($_SESSION['CARRITO'])) ?>)</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $whereami ?>./empleados.php">Empleados</a>
                    </li>
                    <li class="nav-item">
                        <?php
                        // Verificar si la variable de sesión está establecida y es true
                        if (!empty($_SESSION["id"])) {
                            // Mostrar el botón o cualquier otro elemento aquí
                            echo '<a class="nav-link" href="' . $whereami . './administracion.php">Administración</a>';
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
                            echo '<a class="nav-link" style="color:white;" href="' . $whereami . './conexion/controlador_logout.php">Cerrar sesión</a>';
                        }
                        ?>
                    </li>
                </ul>

            </div>
        </div>
    </nav>