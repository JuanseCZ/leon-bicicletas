<?php
require '../../conexion/config.php';
session_start();
if (empty($_SESSION["id"])) {
    header("location: ../../index.php");
}
$title = "Productos";
$whereami = "../.";
include '../../TEMPLATE/headCRUD.php';
?>


<br>
<div class="container-lg">
    <div class="container">
        <header class="header">
            <div class="head-title">
                <h1>Productos</h1>
            </div>
            <div class="head-btn"><a href="./create.php" class="btn btn-success"><i class="fa fa-plus"></i> Agregar
                    un producto</a></div>
        </header>



        <?php
        require_once "../../conexion/config.php";
        $sql = "SELECT * FROM producto p JOIN categoria c ON p.idCat = c.idCat ORDER BY idProd";
        if ($resultado = $conn->query($sql)) {
            if ($resultado->num_rows > 0) {
                echo '<table class="table table-bordered table-striped">';
                echo '<thead>';
                echo '<tr>';
                echo '<th>#</th>';
                echo '<th>Producto</th>';
                echo '<th>Descripción</th>';
                echo '<th>Vista previa</th>';
                echo '<th>Precio</th>';
                echo '<th>Stock</th>';
                echo '<th>Categoría</th>';
                echo '<th>Acción</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                while ($row = $resultado->fetch_array()) {
                    echo "<tr>";
                    echo "<td>" . $row['idProd'] . "</td>";
                    echo "<td>" . $row['nomProd'] . "</td>";
                    echo "<td>" . $row['descripcionProd'] . "</td>";
                    echo '<td><img style="max-width: 70px;" src="../../images/' . $row['imgProd'] . '"/></td>';
                    echo "<td>" . $row['precio'] . "</td>";
                    echo "<td>" . $row['stock'] . "</td>";
                    echo "<td>" . $row['nomCat'] . "</td>";
                    echo "<td>";
                    echo '<a class="mx-2" href="./read.php?id=' . $row['idProd'] . '" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                    echo '<a class="mx-2" href="./update.php?id=' . $row['idProd'] . '" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                    if ($_SESSION["admin"] == 1) {
                        echo '<a class="mx-2" href="./delete.php?id=' . $row['idProd'] . '" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                    }
                    echo "</td>";
                    echo "</tr>";
                }
                echo "</tbody>";
                echo "</table>";

            } else {
                echo '<div class="alert alert-danger"><em>No se encontraron productos</em></div>';
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