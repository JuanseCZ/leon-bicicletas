<?php
session_start();
if (empty($_SESSION["id"])) {
    header("location: ../../index.php");
}

if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    require_once "../../conexion/config.php";
    $sql = "SELECT * FROM categoria WHERE idCat = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $param_id);
        $param_id = trim($_GET["id"]);
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows == 1) {
                $row = $result->fetch_array(MYSQLI_ASSOC);
                $id = $row["idCat"];
                $nombre = $row["nomCat"];
                $descripcion = $row["descripcionCat"];
            } else {


                header("location: error.php");
                exit();
            }
        } else {
            echo "Ups! Algo salió mal. Intenta más tarde.";
        }
    }
    $stmt->close();
    $conn->close();
} else {
    header("location: error.php");
    exit();
}
$title = "Ver categoría";
$whereami = "../.";
include '../../TEMPLATE/headCRUDnoIndex.php';
?>


<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="mt-5 mb-3">Categoría</h1>
                <div class="form-group">
                    <label>N° categoría</label>
                    <p><b>
                            <?php echo $row["idCat"]; ?>
                        </b></p>
                </div>
                <div class="form-group">
                    <label>Nombre</label>
                    <p><b>
                            <?php echo $row["nomCat"]; ?>
                        </b></p>
                </div>
                <div class="form-group">
                    <label>Descripción</label>
                    <p><b>
                            <?php echo $row["descripcionCat"]; ?>
                        </b></p>
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