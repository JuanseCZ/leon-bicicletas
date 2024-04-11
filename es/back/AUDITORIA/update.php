<?php
session_start();
if ($_SESSION["admin"] != 1) {
    header("location: ../../index.php");
}

require_once "../../conexion/config.php";
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    $id = $_POST["id"];
    $input_descripcion = trim($_POST["descripcion"]);

    $sql = "UPDATE auditoria SET accion = ? WHERE idAud=?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ss", $param_descripcion, $param_id);
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
        $sql = "SELECT * FROM auditoria WHERE idAud = ?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $param_id);
            $param_id = $id;
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                if ($result->num_rows == 1) {
                    $row = $result->fetch_array(MYSQLI_ASSOC);
                    $id = $row["idAud"];
                    $descripcion = $row["accion"];
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
$title = "Actualizar registro";
$whereami = "../.";
include '../../TEMPLATE/headCRUDnoIndex.php';
?>



<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mt-5">Actualizar Registro</h2>
                <form action="<?php echo
                    htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                    <div class="form-group">
                        <label>Descripción</label>
                        <textarea type="textbox" name="descripcion"
                            class="form-control"><?php echo $descripcion ?></textarea>
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