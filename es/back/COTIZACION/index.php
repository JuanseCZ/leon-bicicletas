<?php
require '../../conexion/config.php';
session_start();
if (empty($_SESSION["id"])) {
    header("location: ../../index.php");
}
$title = "Cotizaciones";
$whereami = "../.";
include '../../TEMPLATE/headCRUD.php';
?>


<br>
<div class="container-lg">
    <div class="container">
        <header class="header">
            <div class="head-title">
                <h1>Cotizaciones</h1>
            </div>
        </header>
        
        <?php
        require_once "../../conexion/config.php";
        $sql = "SELECT * FROM cotizaciones";
        if ($resultado = $conn->query($sql)) {
            if ($resultado->num_rows > 0) {
                echo '<table class="table table-bordered table-striped">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>#</th>';
                echo '<th>Cliente</th>';
                echo '<th>Teléfono</th>';
                echo '<th>Correo</th>';
                echo '<th>Total</th>';
                echo '<th>Estado</th>';
                echo '<th>Acción</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                while ($row = $resultado->fetch_array()) {
                    echo "<tr>";
                    echo "<td>" . $row['idCot'] . "</td>";
                    echo "<td>" . $row['nomCot'] . "</td>";
                    echo "<td>" . $row['telCot'] . "</td>";
                    echo "<td>" . $row['correo'] . "</td>";
                    echo "<td>" . $row['total'] . "</td>";
                    echo "<td>" . $row['estado'] . "</td>";
                    echo "<td>";
                    echo '<a class="mx-2" href="./read.php?id=' . $row['idCot'] . '" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                    echo '<a class="mx-2" href="./update.php?id=' . $row['idCot'] . '" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                    if ($_SESSION["admin"] == 1) {
                        echo '<a class="mx-2" href="./delete.php?id=' . $row['idCot'] . '" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                    }
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";

            } else {
                echo '<div class="alert alert-danger"><em>No se encontraron cotizaciones</em></div>';
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