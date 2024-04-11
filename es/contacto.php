<?php
session_start();

require_once "./conexion/config.php";

$title = "Contacto";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $input_nomCon = trim($_POST["nomCon"]);

    $input_telCon = trim($_POST["telCon"]);

    $input_emailCon = trim($_POST["emailCon"]);

    $input_textCon = trim($_POST["textCon"]);



    $sql = "CALL contacto(?, ?, ?, ?)";
    if ($stmt = $conn->prepare($sql)) {
        
        $stmt->bind_param("ssss", $param_nomCon, $param_telCon, $param_emailCon, $param_textCon);
        
        $param_nomCon = $input_nomCon;
        $param_telCon = $input_telCon;
        $param_emailCon = $input_emailCon;
        $param_textCon = $input_textCon;


        
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

include './TEMPLATE/headCRUDnoIndex.php';
?>


<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mt-5">Contáctenos</h2>
                <p>Deja tus consultas, dudas o sugerencias.</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="nomCon" class="form-control" required></input>
                    </div>
                    <div class="form-group">
                        <label>Teléfono</label>
                        <input type="text" name="telCon" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Correo</label>
                        <input type="email" name="emailCon" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Texto</label>
                        <textarea type="text" name="textCon" class="form-control" required></textarea>
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
include './TEMPLATE/footer.php';
?>