<?php
session_start();
if (empty($_SESSION["id"])) {
    header("location: ../../index.php");
}

require_once "../../conexion/config.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $input_nombre = trim($_POST["nombre"]);

    $input_telefono = trim($_POST["telefono"]);

    $input_correo = trim($_POST["correo"]);

    $input_texto = trim($_POST["texto"]);



    $sql = "INSERT INTO contacto (nombre, telefono, correo, texto) VALUES (?, ?, ?, ?)";
    if ($stmt = $conn->prepare($sql)) {
        
        $stmt->bind_param("ssss", $param_nombre, $param_telefono, $param_correo, $param_texto);
        
        $param_nombre = $input_nombre;
        $param_telefono = $input_telefono;
        $param_correo = $input_correo;
        $param_texto = $input_texto;


        
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
$title = "Nuevo contacto";
$whereami = "../.";
include '../../TEMPLATE/headCRUDnoIndex.php';
?>


<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mt-5">Contactos</h2>
                <p>Deja tus consultas, dudas o sugerencias.</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="nombre" class="form-control"></input>
                    </div>
                    <div class="form-group">
                        <label>Teléfono</label>
                        <input type="text" name="telefono" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Correo</label>
                        <input type="email" name="correo" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Texto</label>
                        <textarea type="text" name="texto" class="form-control"></textarea>
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