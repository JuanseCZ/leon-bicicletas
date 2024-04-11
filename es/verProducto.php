<?php
include './cotizar.php';

if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    
    require_once "./conexion/config.php";
    
    $sql = "CALL verProducto(?)";
    if ($stmt = $conn->prepare($sql)) {
        
        $stmt->bind_param("i", $param_id);
        
        $param_id = trim($_GET["id"]);
        
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows == 1) {
                $row = $result->fetch_array(MYSQLI_ASSOC);
                
                $id = $row["identifier"];
                $nombre = $row["nombre"];
                $imagen = $row["imagen"];
                $descripcion = $row["descripcion"];
                $precio = $row["valor"];
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

$title = $row["nombre"];

include './TEMPLATE/head.php';
?>
.wrapper {
width: 800px;
margin: 0 auto;
}
<?php
include './TEMPLATE/nav.php';
?>


<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1 class="mt-5 mb-3">Ver producto</h1>
                <div class="form-group">
                    <?php
                    echo '<p><img style="max-width: 600px;" src="./images/' . $row['imagen'] . '"/></p>';
                    ?>
                </div>
                <div class="form-group">
                    <p><b>
                        <?php echo $row["nombre"]; ?>
                    </b></p>
                </div>
                <div class="form-group">
                    <p>
                            <?php echo $row["descripcion"]; ?>
                    </p>
                </div>
                <div class="form-group">
                    <p><b>
                            <?php echo 'Precio: $' . $row["valor"]; ?>
                        </b></p>
                </div>
                <br>
                <div class="d-flex">
                <p><a href="./catalogo.php" class="btn btn-success">Regresar</a></p>
                <form action="" method="post">
                    <input type="hidden" name="id" id="id" value="<?php echo  openssl_encrypt($row['identifier'], COD, KEY)?>">
                    <input type="hidden" name="nombre" id="nombre" value="<?php echo  openssl_encrypt($row['nombre'], COD, KEY)?>">
                    <input type="hidden" name="precio" id="precio" value="<?php echo  openssl_encrypt($row['valor'], COD, KEY)?>">
                    <input type="hidden" name="cantidad" id="cantidad" value="<?php echo  openssl_encrypt(1, COD, KEY)?>">
                    <button class="btn btn-success mx-3" name="btnAccion" type="submit" value="Agregar">Agregar al cotizador</button>
                </form>
                </div>
                
            </div>
        </div>
    </div>
</div>


<?php
include './TEMPLATE/footer.php';
?>