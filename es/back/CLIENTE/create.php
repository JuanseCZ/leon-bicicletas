<?php
session_start();
if (empty($_SESSION["id"])) {
    header("location: ../../index.php");
}

require_once "../../conexion/config.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $input_nombre = trim($_POST["nombre"]);

    $input_apellido = trim($_POST["apellido"]);

    $input_telefono = trim($_POST["telefono"]);

    $input_correo = trim($_POST["correo"]);



    $sql = "INSERT INTO clientes (nomCli, apeCli, telCli, correo) VALUES (?, ?, ?, ?)";
    if ($stmt = $conn->prepare($sql)) {
        
        $stmt->bind_param("ssss", $param_nombre, $param_apellido, $param_telefono, $param_correo);
        
        $param_nombre = $input_nombre;
        $param_apellido = $input_apellido;
        $param_telefono = $input_telefono;
        $param_correo = $input_correo;


        
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
$title = "Nuevo cliente";
$whereami = "../.";
include '../../TEMPLATE/headCRUDnoIndex.php';
?>


<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mt-5">Ingresar cliente</h2>
                <p>Por favor llenar este formulario y enviarlo para su almacenamiento.</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="nombre" class="form-control"></input>
                    </div>
                    <div class="form-group">
                        <label>Apellido</label>
                        <input type="text" name="apellido" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Teléfono</label>
                        <input type="number" name="telefono" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Correo</label>
                        <input type="email" name="correo" class="form-control">
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