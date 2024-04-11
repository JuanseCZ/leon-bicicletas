<?php
session_start();
if (empty($_SESSION["id"])) {
    header("location: ../../index.php");
}
require_once "../../conexion/config.php";
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    $id = $_POST["id"];
    $input_nombre = trim($_POST["nombre"]);
    $input_descripcion = trim($_POST["descripcion"]);


    $sql = "UPDATE categoria SET nomCat = ?, descripcionCat = ? WHERE idCat=?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("sss", $param_nombre, $param_descripcion, $param_id);
        $param_nombre = $input_nombre;
        $param_descripcion = $input_descripcion;
        $param_id = $id;
        if ($stmt->execute()) {
            header("location: ./index.php");
            exit();
        } else {
            echo "Ups! Algo salió mal. Intenta más tarde.";
        }
    }
    $stmt->close();

    $conn->close();
} else {
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        $id = trim($_GET["id"]);
        $sql = "SELECT * FROM categoria WHERE idCat = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $param_id);
            $param_id = $id;
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
}
$title = "Actualizar categoría";
$whereami = "../.";
include '../../TEMPLATE/headCRUDnoIndex.php';
?>


<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mt-5">Actualizar categoría</h2>
                <p>Por favor actualice los campos.</p>
                <form action="<?php echo
                    htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="nombre" class="form-control" value="<?php echo $nombre ?>">
                    </div>
                    <div class="form-group">
                        <label>Descripción</label>
                        <input type="text" name="descripcion" class="form-control" value="<?php echo $descripcion ?>">
                    </div>
                    <br>
                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
                    <input type="submit" class="btn btn-success" value="Subir">
                    <a href="./index.php" class="btn btn-secondary ml-2">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</div>


<?php
include '../../TEMPLATE/footer.php';
?>