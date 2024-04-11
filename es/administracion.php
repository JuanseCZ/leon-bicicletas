<?php
require './conexion/config.php';
session_start();
if (empty($_SESSION["id"])) {
  header("location: empleados.php");
}

$title = "Administración";


include './TEMPLATE/head.php';
?>
a {
text-decoration: none;
color: inherit;
}

.list-group-item:hover {
background-color: #198754;
color: white;
}
<?php
include './TEMPLATE/nav.php';
?>


<div class="container mt-4">
  <?php
  echo '<h1>Bienvenido, ' . $_SESSION["nombre"] . " " . $_SESSION["apellido"] . '!</h1> ';
  ?>

  <h4>¿A donde quieres ir?</h4>
  <ul class="list-group">
    <li class="list-group-item"><a href="./back/PRODUCTOS/index.php">Productos</a></li>
    <li class="list-group-item"><a href="./back/CLIENTE/index.php">Clientes</a></li>
    <li class="list-group-item"><a href="./back/CATEGORIA/index.php">Categorías</a></li>
    <li class="list-group-item"><a href="./back/CONTACTO/index.php">Contacto</a></li>
    <li class="list-group-item"><a href="./back/COTIZACION/index.php">Cotizaciones</a></li>
    <li class="list-group-item"><a href="./back/DETALLE/index.php">Detalle</a></li>
    <?php
    if ($_SESSION["admin"] == 1) {
      echo '<li class="list-group-item"><a href="./back/EMPLEADOS/index.php">Empleados</a></li>';
      echo '<li class="list-group-item"><a href="./back/AUDITORIA/index.php">Auditoria</a></li>';
    }
    ?>
  </ul>
</div>


<?php
include './TEMPLATE/footer.php';
?>