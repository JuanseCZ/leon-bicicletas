<?php
require '../../conexion/config.php';
session_start();
if ($_SESSION["admin"] != 1) {
    header("location: ../../index.php");
}
$title = "Auditoría";
$whereami = "../.";
include '../../TEMPLATE/headCRUD.php';
?>


<br>
<div class="container-lg">
    <div class="container">
        <header class="header">
            <div class="head-title">
                <h1>Auditoría</h1>
            </div>
            <div class="head-btn"><a href="./create.php" class="btn btn-success"><i class="fa fa-plus"></i> Agregar un registro de auditoria</a></div>
        </header>

        <?php
        require_once "../../conexion/config.php";
        $sql = "SELECT * FROM auditoria";
        if ($resultado = $conn->query($sql)) {
            if ($resultado->num_rows > 0) {
                echo '<table class="table table-bordered table-striped">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>#</th>';
                echo '<th>Fecha</th>';
                echo '<th>Registro</th>';
                echo '<th>Acción</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                while ($row = $resultado->fetch_array()) {
                    echo "<tr>";
                    echo "<td>" . $row['idAud'] . "</td>";
                    echo "<td>" . $row['fecha'] . "</td>";
                    echo "<td>" . $row['accion'] . "</td>";
                    echo "<td>";
                    echo '<a class="mx-2" href="./read.php?id=' . $row['idAud'] . '" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                    echo '<a class="mx-2" href="./update.php?id=' . $row['idAud'] . '" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                    echo '<a class="mx-2" href="./delete.php?id=' . $row['idAud'] . '" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";

            } else {
                echo '<div class="alert alert-danger"><em>No se encontraron registros</em></div>';
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