<?php
session_start();
if ($_SESSION["admin"] != 1) {
    header("location: ../../index.php");
}

require_once "../../conexion/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $input_descripcion = trim($_POST["descripcion"]);

    $sql = "INSERT INTO auditoria (accion) VALUES (?)";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("s", $param_descripcion);
        $param_descripcion = $input_descripcion;

        if ($stmt->execute()) {
            header("location: index.php");
            exit();
        } else {
            echo "Ups! Algo falló. Por favor intente más tarde.";
        }
    }
    $stmt->close();

    $conn->close();
}

$whereami = "../.";
$title = "Nuevo registro";
include '../../TEMPLATE/headCRUDnoIndex.php';
?>


<!-- Cuerpo del documento -->
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mt-5">Ingresar registro de auditoria</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label>Ingresa las acciones que se realizaron</label>
                        <p style="font-size: 70%;">*Recuerda que los cambios al
                            inventario y los productos se registran automáticamente</p>
                        <textarea type="textbox" name="descripcion" class="form-control"></textarea>
                    </div>
                    <br>
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