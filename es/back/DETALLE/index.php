<?php
require '../../conexion/config.php';
session_start();
if (empty($_SESSION["id"])) {
    header("location: ../../index.php");
}
$title = "Detalle Cotizaciones";
$whereami = "../.";
include '../../TEMPLATE/headCRUD.php';
?>

<br>
<div class="container-lg">
    <div class="container">
        <header class="header">
            <div class="head-title">
                <h1>Detalle Cotizaciones</h1>
            </div>
        </header>

        <?php
        require_once "../../conexion/config.php";
        $sql = "SELECT * FROM detalle d join productos p on d.idProd = p.idProd ORDER BY idDet ASC, p.idProd ASC;";
        if ($resultado = $conn->query($sql)) {
            if ($resultado->num_rows > 0) {
                echo '<table class="table table-bordered table-striped">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>#</th>';
                echo '<th>Cotización</th>';
                echo '<th>Producto</th>';
                echo '<th>Muestra</th>';
                echo '<th>Precio</th>';
                echo '<th>Cantidad</th>';
                echo '<th>Total Producto</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                while ($row = $resultado->fetch_array()) {
                    echo "<tr>";
                    echo "<td>" . $row['idDet'] . "</td>";
                    echo "<td>" . $row['idCot'] . "</td>";
                    echo "<td>" . $row['idProd'] . " - ". $row['nomProd'] . "</td>";
                    echo '<td><img style="max-width: 70px;" src="../../images/' . $row['imgProd'] . '"/></td>';
                    echo "<td>" . $row['precio'] . "</td>";
                    echo "<td>" . $row['cantidadProd'] . "</td>";
                    echo "<td>" . $row['totalProd'] . "</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";

            } else {
                echo '<div class="alert alert-danger"><em>No se encontraron productos asociados</em></div>';
            }
        } else {
            echo "Ups! Algo salió mal. Intenta más tarde.";
        }
        $conn->close();

        ?>
    </div>
</div>


<?php
include '../../TEMPLATE/footer.php';
?>