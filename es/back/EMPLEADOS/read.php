<?php
session_start();
if ($_SESSION["admin"] != 1) {
    header("location: ../../index.php");
}


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
$title = "Datos del empleado";
$whereami = "../.";
include '../../TEMPLATE/headCRUDnoIndex.php';
?>


<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="mt-5 mb-3">Datos del empleado</h1>
                <div class="form-group">
                    <label>Nombre</label>
                    <p><b>
                            <?php echo $row["nomEmple"]; ?>
                        </b></p>
                </div>
                <div class="form-group">
                    <label>Apellido</label>
                    <p><b>
                            <?php echo $row["apeEmple"]; ?>
                        </b></p>
                </div>
                <div class="form-group">
                    <label>Permisos</label>
                    <p><b>
                            <?php echo  $row["isadmin"]; ?>
                        </b></p>
                </div>
                <div class="form-group">
                    <label>Usuario</label>
                    <p><b>
                            <?php echo $row["usr"]; ?>
                        </b></p>
                </div>
                <div class="form-group">
                    <label>Contraseña</label>
                    <p><b>
                            <?php echo $row["passwd"]; ?>
                        </b></p>
                </div>
                <br>
                <p><a href="./index.php" class="btn btn-success">Regresar<a></p>
            </div>
        </div>
    </div>
</div>


<?php
include '../../TEMPLATE/footer.php';
?>