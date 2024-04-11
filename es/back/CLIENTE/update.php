<?php
session_start();
if (empty($_SESSION["id"])) {
    header("location: ../../index.php");
}

require_once "../../conexion/config.php";


if (isset($_POST["id"]) && !empty($_POST["id"])) {
    
    $id = $_POST["id"];
    
    $input_nombre = trim($_POST["nombre"]);

    $input_apellido = trim($_POST["apellido"]);

    $input_telefono = trim($_POST["telefono"]);

    $input_correo = trim($_POST["correo"]);

    
    $sql = "UPDATE clientes SET nomCli = ?, apeCli = ?, telCli = ?, correo = ? WHERE idCli=?";
    if ($stmt = $conn->prepare($sql)) {
        
        $stmt->bind_param("sssss", $param_nombre, $param_apellido, $param_telefono, $param_correo, $param_id);
        
        $param_nombre = $input_nombre;
        $param_apellido = $input_apellido;
        $param_telefono = $input_telefono;
        $param_correo = $input_correo;
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
        
        $sql = "SELECT * FROM clientes WHERE idCli = ?";
        if ($stmt = $conn->prepare($sql)) {
            
            $stmt->bind_param("i", $param_id);
            
            $param_id = $id;
            
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                if ($result->num_rows == 1) {
                    $row = $result->fetch_array(MYSQLI_ASSOC);
                    
                    $id = $row["idCli"];
                    $nombre = $row["nomCli"];
                    $apellido = $row["apeCli"];
                    $telefono = $row["telCli"];
                    $correo = $row["correo"];
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
$title = "Actualizar cliente";
$whereami = "../.";
include '../../TEMPLATE/headCRUDnoIndex.php';
?>


<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mt-5">Actualizar cliente</h2>
                <p>Por favor actualice los campos.</p>
                <form action="<?php echo
                    htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="nombre" class="form-control" value="<?php echo $nombre ?>">
                    </div>
                    <div class="form-group">
                        <label>Apellido</label>
                        <input type="text" name="apellido" class="form-control" value="<?php echo $apellido ?>">
                    </div>
                    <div class="form-group">
                        <label>Teléfono</label>
                        <input type="text" name="telefono" class="form-control" value="<?php echo $telefono ?>">
                    </div>
                    <div class="form-group">
                        <label>Correo</label>
                        <input type="email" name="correo" class="form-control" value="<?php echo $correo ?>">
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