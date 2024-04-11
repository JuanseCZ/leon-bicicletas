<?php
session_start();
if (empty($_SESSION["id"])) {
    header("location: ../../index.php");
}


if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    
    require_once "../../conexion/config.php";
    
    $sql = "SELECT * FROM clientes WHERE idCli = ?";
    if ($stmt = $conn->prepare($sql)) {
        
        $stmt->bind_param("i", $param_id);
        
        $param_id = trim($_GET["id"]);
        
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
$title = "Ver cliente";
$whereami = "../.";
include '../../TEMPLATE/headCRUDnoIndex.php';
?>


<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="mt-5 mb-3">Ver cliente</h1>
                <div class="form-group">
                    <label>Nombre</label>
                    <p><b>
                            <?php echo $row["nomCli"]; ?>
                        </b></p>
                </div>
                <div class="form-group">
                    <label>Apellido</label>
                    <p><b>
                            <?php echo $row["apeCli"]; ?>
                        </b></p>
                </div>
                <div class="form-group">
                    <label>Teléfono</label>
                    <p><b>
                            <?php echo $row["telCli"]; ?>
                        </b></p>
                </div>
                <div class="form-group">
                    <label>Correo</label>
                    <p><b>
                            <?php echo $row["correo"]; ?>
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