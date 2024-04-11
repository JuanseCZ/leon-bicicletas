<?php
session_start();
if (empty($_SESSION["id"])) {
    header("location: ../../index.php");
}

require_once "../../conexion/config.php";


if (isset($_POST["id"]) && !empty($_POST["id"])) {
    
    $id = $_POST["id"];
    
    $input_estado = trim($_POST["estado"]);

    
    $sql = "UPDATE cotizaciones SET estado = ? WHERE idCot=?";
    if ($stmt = $conn->prepare($sql)) {
        
        $stmt->bind_param("ss", $param_estado, $param_id);
        
        $param_estado = $input_estado;
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
        
        $sql = "SELECT * FROM cotizaciones WHERE idCot = ?";
        if ($stmt = $conn->prepare($sql)) {
            
            $stmt->bind_param("i", $param_id);
            
            $param_id = trim($_GET["id"]);
            
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                if ($result->num_rows == 1) {
                    $row = $result->fetch_array(MYSQLI_ASSOC);
                    
                    $id = $row["idCot"];
                    $nombre = $row["nomCot"];
                    $telefono = $row["telCot"];
                    $correo = $row["correo"];
                    $total = $row["total"];
                    $estado = $row["estado"];
                } else {


                    
                    header("location: error.php");
                    exit();
                }
            }
        }
        
        $stmt->close();
        
        $conn->close();
    } else {
        
        header("location: error.php");
        exit();
    }
}
$title = "Actualizar cotización";
$whereami = "../.";
include '../../TEMPLATE/headCRUDnoIndex.php';
?>


<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mt-5">Actualizar estado de la cotización</h2>
                <form action="<?php echo
                    htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                    <div class="form-group">
                        <label>Nombre</label>
                        <p><b>
                                <?php echo $row["nomCot"]; ?>
                            </b></p>
                    </div>
                    <div class="form-group">
                        <label>Teléfono</label>
                        <p><b>
                                <?php echo $row["telCot"]; ?>
                            </b></p>
                    </div>
                    <div class="form-group">
                        <label>Correo</label>
                        <p><b>
                                <?php echo $row["correo"]; ?>
                            </b></p>
                    </div>
                    <div class="form-group">
                        <label>Total</label>
                        <p><b>
                                <?php echo '$ ' . $row["total"]; ?>
                            </b></p>
                    </div>
                    <div class="form-group">
                        <label>Estado</label>
                        <select class="form-select" aria-label="estado" name="estado">
                            <option selected><?php echo $estado ?></option>
                            <option value="Pendiente">Pendiente</option>
                            <option value="En seguimiento">En seguimiento</option>
                            <option value="Cerrado">Cerrada</option>
                        </select>
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