<?php
require '../../conexion/config.php';
session_start();
if (empty($_SESSION["id"])) {
    header("location: ../../index.php");
}
$title = "Categorías";
$whereami = "../.";
include '../../TEMPLATE/headCRUD.php';
?>


<br>
<div class="container-lg">
    <div class="container">
        <header class="header">
            <div class="head-title">
                <h1>Categorías</h1>
            </div>
            <div class="head-btn"><a href="./create.php" class="btn btn-success"><i class="fa fa-plus"></i> Agregar una nueva categoría</a></div>
        </header>
        
        <?php
        require_once "../../conexion/config.php";
        $sql = "SELECT * FROM categoria";
        if ($resultado = $conn->query($sql)) {
            if ($resultado->num_rows > 0) {
                echo '<table class="table table-bordered table-striped">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>#</th>';
                echo '<th>Nombre</th>';
                echo '<th>Descripción</th>';
                echo '<th>Acción</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                while ($row = $resultado->fetch_array()) {
                    echo "<tr>";
                    echo "<td>" . $row['idCat'] . "</td>";
                    echo "<td>" . $row['nomCat'] . "</td>";
                    echo "<td>" . $row['descripcionCat'] . "</td>";
                    echo "<td>";
                    echo '<a class="mx-2" href="./read.php?id=' . $row['idCat'] . '" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                    echo '<a class="mx-2" href="./update.php?id=' . $row['idCat'] . '" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                    if ($_SESSION["admin"] == 1) {
                        echo '<a class="mx-2" href="./delete.php?id=' . $row['idCat'] . '" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                    }
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