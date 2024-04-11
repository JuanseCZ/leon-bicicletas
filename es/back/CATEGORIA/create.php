<?php
session_start();
if (empty($_SESSION["id"])) {
    header("location: ../../index.php");
}
require_once "../../conexion/config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $input_nombre = trim($_POST["nombre"]);
    $input_descripcion = trim($_POST["descripcion"]);



    $sql = "INSERT INTO categoria (nomCat, descripcionCat) VALUES (?, ?)";
    if ($stmt = $conn->prepare($sql)) 
        $stmt->bind_param("ss", $param_nombre, $param_descripcion);
        $param_nombre = $input_nombre;
        $param_descripcion = $input_descripcion;


        if ($stmt->execute()) {
            header("location: index.php");
            exit();
        } else {
            echo "Ups! Algo falló. Por favor intente más tarde.";
        }
    
    $stmt->close();

    $conn->close();
}
$title = "Nueva categoría";
$whereami = "../.";
include '../../TEMPLATE/headCRUDnoIndex.php';
?>


<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mt-5">Ingresar nueva categoría</h2>
                <p>Por favor llenar este formulario y enviarlo para su almacenamiento.</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="nombre" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Descripción</label>
                        <input type="text" name="descripcion" class="form-control">
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