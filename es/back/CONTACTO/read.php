<?php
session_start();
if (empty($_SESSION["id"])) {
    header("location: ../../index.php");
}


if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    
    require_once "../../conexion/config.php";
    
    $sql = "SELECT * FROM contacto WHERE idContact = ?";
    if ($stmt = $conn->prepare($sql)) {
        
        $stmt->bind_param("i", $param_id);
        
        $param_id = trim($_GET["id"]);
        
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows == 1) {
                $row = $result->fetch_array(MYSQLI_ASSOC);
                
                $id = $row["idContact"];
                $nombre = $row["nombre"];
                $telefono = $row["telefono"];
                $descripcion = $row["correo"];
                $stock = $row["texto"];
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
$title = "Ver contacto";
$whereami = "../.";
include '../../TEMPLATE/headCRUDnoIndex.php';
?>


<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="mt-5 mb-3">Ver contacto</h1>
                <div class="form-group">
                    <label>Nombre</label>
                    <p><b>
                            <?php echo $row["nombre"]; ?>
                        </b></p>
                </div>
                <div class="form-group">
                    <label>Teléfono</label>
                    <p><b>
                            <?php echo $row["telefono"]; ?>
                        </b></p>
                </div>
                <div class="form-group">
                    <label>Correo</label>
                    <p><b>
                            <?php echo $row["correo"]; ?>
                        </b></p>
                </div>
                <div class="form-group">
                    <label>Texto</label>
                    <p><b>
                            <?php echo $row["texto"]; ?>
                        </b></p>
                </div>
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