<?php
if (empty($whereami)) {
    $whereami = "";
}
?>

<!-- Footer / Bootstrap Examples First-->
<div class="container footer">
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <p class="col-md-4 mb-0 text-body-secondary">© 2023 León Bicicletas</p>

        <a href="/"
            class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none"><img
                src="<?php echo $whereami ?>./adobe/leonlogonuevo-01.png" alt="" style="height: 6vh;"></a>


        <ul class="nav col-md-4 justify-content-end">
            <li class="nav-item"><a href="<?php echo $whereami ?>./index.php"
                    class="nav-link px-2 text-body-secondary">Inicio</a></li>
            <li class="nav-item"><a href="<?php echo $whereami ?>./catalogo.php"
                    class="nav-link px-2 text-body-secondary">Catálogo</a>
            </li>
            <li class="nav-item"><a href="<?php echo $whereami ?>./nosotros.php"
                    class="nav-link px-2 text-body-secondary">Nosotros</a>
            </li>
            <li class="nav-item"><a href="<?php echo $whereami ?>./contacto.php"
                    class="nav-link px-2 text-body-secondary">Contáctenos</a>
            </li>
            <li class="nav-item"><a href="<?php echo $whereami ?>./empleados.php"
                    class="nav-link px-2 text-body-secondary">Empleados</a>
            </li>
        </ul>
    </footer>
</div>

</body>

</html>