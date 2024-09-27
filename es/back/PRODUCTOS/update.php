<?php
session_start();
if (empty($_SESSION["id"])) {
    header("location: ../../index.php");
}

require_once "../../conexion/config.php";


if (isset($_POST["id"]) && !empty($_POST["id"])) {
    
    $id = $_POST["id"];
    
    $input_nombre = trim($_POST["nombre"]);

    $input_imagen = trim($_POST["imagen"]);

    $input_descripcion = trim($_POST["descripcion"]);

    $input_precio = trim($_POST["precio"]);

    $input_stock = trim($_POST["stock"]);

    $input_cat = trim($_POST["categoria"]);

    
    $sql = "UPDATE productos 
            SET nomProd = ?, 
                imgProd = ?, 
                descripcionProd = ?, 
                precio = ?, 
                stock = ?, 
                idCat = ? WHERE 
                idProd=?";

    if ($stmt = $conn->prepare($sql)) {
        
        $stmt->bind_param("sssssss",
            $param_nombre,
            $param_imagen,
            $param_descripcion,
            $param_precio,
            $param_stock,
            $param_categoria,
            $param_id);
        
        $param_nombre = $input_nombre;
        $param_imagen = $input_imagen;
        $param_descripcion = $input_descripcion;
        $param_precio = $input_precio;
        $param_stock = $input_stock;
        $param_categoria = $input_cat;
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
        
        $sql = "SELECT * FROM productos p JOIN categoria c ON p.idCat = c.idCat WHERE idProd = ?";
        if ($stmt = $conn->prepare($sql)) {
            
            $stmt->bind_param("i", $param_id);
            
            $param_id = $id;
            
            if ($stmt->execute()) {
                $result = $stmt->get_result();
                if ($result->num_rows == 1) {
                    $row = $result->fetch_array(MYSQLI_ASSOC);
                    
                    $id = $row["idProd"];
                    $nombre = $row["nomProd"];
                    $imagen = $row["imgProd"];
                    $descripcion = $row["descripcionProd"];
                    $precio = $row["precio"];
                    $stock = $row["stock"];
                    $categoria = $row["idCat"];
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
$title = "Actualizar producto";
$whereami = "../.";
include '../../TEMPLATE/headCRUDnoIndex.php';
?>


<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mt-5">Actualizar producto</h2>
                <p>Por favor actualice los campos.</p>
                <form action="<?php echo
                    htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="nombre" class="form-control" value="<?php echo $nombre ?>"></input>
                    </div>
                    <div class="form-group">
                        <label>Imagen</label>
                        <input type="text" name="imagen" class="form-control" placeholder="Ej: bicicleta34.jpg"
                            value="<?php echo $imagen ?>"></input>
                    </div>
                    <div class="form-group">
                        <label>Descripción</label>
                        <input type="text" name="descripcion" class="form-control" value="<?php echo $descripcion ?>">
                    </div>
                    <div class="form-group">
                        <label>Precio</label>
                        <input type="number" name="precio" class="form-control" value="<?php echo $precio ?>">
                    </div>
                    <div class="form-group">
                        <label>Stock</label>
                        <input type="number" name="stock" class="form-control" value="<?php echo $stock ?>">
                    </div>
                    <div class="form-group">
                        <label>Categoría</label>
                        <input type="number" name="categoria" class="form-control" placeholder="Código de la categoría"
                            value="<?php echo $categoria ?>">
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