<?php
session_start();
if (empty($_SESSION["id"])) {
    header("location: ../../index.php");
}


if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    
    require_once "../../conexion/config.php";
    
    $sql = "SELECT * FROM cotizaciones WHERE idCot = ?";
    if ($stmt = $conn->prepare($sql)) {
        
        $stmt->bind_param("i", $param_id);
        
        $param_id = trim($_GET["id"]);
        
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows == 1) {
                $row = $result->fetch_array(MYSQLI_ASSOC);
                
                $id = $row["idCot"];
                $nombre = $row["nomCot"];
                $telefono = $row["telCot"];
                $correo = $row["correo"];
                $total = $row["total"];
                $estado = $row["estado"];
            } else {


                
                header("location: error.php");
                exit();
            }
        } else {
            echo "Ups! Algo salió mal. Intenta más tarde.";
        }
    }
    
    $stmt->close();
    
} else {
    
    header("location: error.php");
    exit();
}
$title = "Ver cotización";
$whereami = "../.";
include '../../TEMPLATE/headCRUDnoIndex.php';
?>


<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="mt-5 mb-3">Ver cotización</h1>
                <div class="form-group">
                    <label>Nombre</label>
                    <p><b>
                            <?php echo $row["nomCot"]; ?>
                        </b></p>
                </div>
                <div class="form-group">
                    <label>Teléfono</label>
                    <p><b>
                            <?php echo $row["telCot"]; ?>
                        </b></p>
                </div>
                <div class="form-group">
                    <label>Correo</label>
                    <p><b>
                            <?php echo $row["correo"]; ?>
                        </b></p>
                </div>
                <div class="form-group">
                    <label>Total</label>
                    <p><b>
                            <?php echo '$ ' . $row["total"]; ?>
                        </b></p>
                </div>
                <div class="form-group">
                    <label>Estado</label>
                    <p><b>
                            <?php echo $row["estado"]; ?>
                        </b></p>
                </div>
                <div class="form-group">
                    <h4>Productos solicitados</h4>
                    <?php
                    require_once "../../conexion/config.php";
                    $sql = "SELECT * FROM detalle d join productos p on d.idProd = p.idProd WHERE idCot = $param_id";
                    if ($resultado = $conn->query($sql)) {
                        if ($resultado->num_rows > 0) {
                            echo '<table class="table table-bordered table-striped">';
                            echo '<thead>';
                            echo '<tr>';
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
                                echo "<td>" . $row['idProd'] . " - " . $row['nomProd'] . "</td>";
                                echo '<td><img style="max-width: 70px;" src="../../images/' . $row['imgProd'] . '"/></td>';
                                echo "<td>" . $row['precio'] . "</td>";
                                echo "<td>" . $row['cantidadProd'] . "</td>";
                                echo "<td>" . $row['totalProd'] . "</td>";
                                echo "</tr>";
                            }
                            echo '<tr>';
                            echo '<td colspan="4" align="right">';
                            echo '<h3>Total:</h3>';
                            echo '</td>';
                            echo '<td align="left">';
                            echo '<h3>';
                            echo $total;
                            echo '</h3>';
                            echo '</td>';
                            echo '</tr>';
                            echo "</tbody>";
                            echo "</table>";

                        } else {
                            echo '<div class="alert alert-danger"><em>No se encontraron los productos asociados</em></div>';
                        }
                    } else {
                        echo "Ups! Algo salió mal. Intenta más tarde.";
                    }
                    $conn->close();

                    ?>
                </div>

                <br>
                <p><a href="./index.php" class="btn btn-success">Regresar<a></p>
            </div>
        </div>
    </div>
</div>


<?php
include '../../TEMPLATE/footer.php';
?>