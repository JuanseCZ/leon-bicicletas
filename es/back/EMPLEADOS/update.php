<?php
session_start();
if ($_SESSION["admin"] != 1) {
    header("location: ../../index.php");
}

require_once "../../conexion/config.php";


if (isset($_POST["id"]) && !empty($_POST["id"])) {
    
    $id = $_POST["id"];
    
    $input_nombre = trim($_POST["nombre"]);

    $input_apellido = trim($_POST["apellido"]);

    $input_admin = trim($_POST["admin"]);

    $input_usuario = trim($_POST["usuario"]);

    $input_password = trim($_POST["password"]);

    
    $sql = "UPDATE empleados SET nomEmple = ?, apeEmple = ?, isadmin = ?, usr = ?, passwd = ? WHERE idEmple = ?";
    if ($stmt = $conn->prepare($sql)) {
        
        $stmt->bind_param("ssssss", $param_nombre, $param_apellido, $param_admin, $param_usuario, $param_password, $param_id);
        
        $param_nombre = $input_nombre;
        $param_apellido = $input_apellido;
        $param_admin = $input_admin;
        $param_usuario = $input_usuario;
        $param_password = MD5($input_password);
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
        
        require_once "../../conexion/config.php";
        
        $sql = "SELECT * FROM empleados WHERE idEmple = ?";
        if ($stmt = $conn->prepare($sql)) {
            
            $stmt->bind_param("i", $param_id);
            
            $param_id = trim($_GET["id"]);
            
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                if ($result->num_rows == 1) {
                    $row = $result->fetch_array(MYSQLI_ASSOC);
                    
                    $id = $row["idEmple"];
                    $nombre = $row["nomEmple"];
                    $apellido = $row["apeEmple"];
                    $admin = $row["isadmin"];
                    $usuario = $row["usr"];
                    $password = $row["passwd"];
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
$title = "Actualizar empleado";
$whereami = "../.";
include '../../TEMPLATE/headCRUDnoIndex.php';
?>


<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mt-5">Actualizar datos del empleado</h2>
                <p>Por favor actualice los campos.</p>
                <form action="<?php echo
                    htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="nombre" class="form-control" value="<?php echo $nombre ?>"></input>
                    </div>
                    <div class="form-group">
                        <label>Apellido</label>
                        <input type="text" name="apellido" class="form-control" value="<?php echo $apellido ?>">
                    </div>
                    <div class="form-group">
                        <label>Permisos</label>
                        <input type="number" name="admin" class="form-control" value="<?php echo $admin ?>">
                    </div>
                    <div class="form-group">
                        <label>Usuario</label>
                        <input type="text" name="usuario" class="form-control" value="<?php echo $usuario ?>">
                    </div>
                    <div class="form-group">
                        <label>Contraseña</label>
                        <input type="password" name="password" class="form-control">
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