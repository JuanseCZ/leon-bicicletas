<?php
session_start();
if ($_SESSION["admin"] != 1) {
    header("location: ../../index.php");
}

require_once "../../conexion/config.php";




if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $input_nombre = trim($_POST["nombre"]);

    $input_apellido = trim($_POST["apellido"]);    

    $input_admin = trim($_POST["admin"]);

    $input_usuario = trim($_POST["usuario"]);

    $input_contraseña = trim($_POST["contraseña"]);



    $sql = "INSERT INTO empleados (nomEmple, apeEmple, isadmin, usr, passwd) VALUES (?, ?, ?, ?, ?)";
    if ($stmt = $conn->prepare($sql)) {
        
        $stmt->bind_param("sssss", $param_nombre, $param_apellido, $param_admin, $param_usuario, $param_contraseña);
        
        $param_nombre = $input_nombre;
        $param_apellido = $input_apellido;
        $param_admin = $input_admin;
        $param_usuario = $input_usuario;
        $param_contraseña = MD5($input_contraseña);


        
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
$title = "Nuevo empleado";
$whereami = "../.";
include '../../TEMPLATE/headCRUDnoIndex.php';
?>


<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mt-5">Ingresar datos del empleado</h2>
                <p>Por favor llenar este formulario y enviarlo para su almacenamiento.</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="nombre" class="form-control"></input>
                    </div>
                    <div class="form-group">
                        <label>Apellido</label>
                        <input type="text" name="apellido" class="form-control"></input>
                    </div>
                    <div class="form-group">
                        <label>Administrador</label>
                        <input type="number" name="admin" class="form-control" min="0" max="1"></input>
                    </div>
                    <div class="form-group">
                        <label>Usuario</label>
                        <input type="text" name="usuario" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Contraseña</label>
                        <input type="password" name="contraseña" class="form-control">
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