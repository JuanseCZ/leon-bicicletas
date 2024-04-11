<?php
session_start();
if ($_SESSION["admin"] != 1) {
    header("location: ./index.php");
}

if (isset($_POST["id"]) && !empty($_POST["id"])) {
    
    require_once "../../conexion/config.php";
    
    $sql = "DELETE FROM clientes WHERE idCli = ?";
    if ($stmt = $conn->prepare($sql)) {
        
        $stmt->bind_param("i", $param_id);
        
        $param_id = trim($_POST["id"]);
        
        if ($stmt->execute()) {
            
            header("location: index.php");
            exit();
        } else {
            echo "Ups! Algo salió mal. Intenta más tarde.";
        }
    }
    
    $stmt->close();
    
    $conn->close();
} else {
    
    if (empty(trim($_GET["id"]))) {
        
        header("location: error.php");
        exit();
    }
}
$title = "Eliminar cliente";
$whereami = "../.";
include '../../TEMPLATE/headCRUDnoIndex.php';
?>


<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mt-5 mb-3">Eliminar cliente</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="alert alert-danger">
                        <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>" />
                        <p>¿Seguro que deseas borrar este cliente?</p>
                        <p>
                            <input type="submit" value="Sí" class="btn btn-danger">
                            <a href="./index.php" class="btn btn-secondary ml-2">No</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<?php
include '../../TEMPLATE/footer.php';
?>