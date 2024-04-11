<?php
session_start();
if (empty($_SESSION["id"])) {
    header("location: ../../index.php");
}

require_once "../../conexion/config.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $input_nombre = trim($_POST["nombre"]);

    $input_imagen = trim($_POST["imagen"]);

    $input_descripcion = trim($_POST["descripcion"]);

    $input_precio = trim($_POST["precio"]);

    $input_stock = trim($_POST["stock"]);

    $input_cat = trim($_POST["categoria"]);



    $sql = "INSERT INTO productos (nomProd, imgProd, descripcionProd, precio, stock, idCat) VALUES (?, ?, ?, ?, ?, ?)";
    if ($stmt = $conn->prepare($sql)) {
        
        $stmt->bind_param("ssssss", $param_nombre, $param_imagen, $param_descripcion, $param_precio, $param_stock, $param_categoria);
        
        $param_nombre = $input_nombre;
        $param_imagen = $input_imagen;
        $param_descripcion = $input_descripcion;
        $param_precio = $input_precio;
        $param_stock = $input_stock;
        $param_categoria = $input_cat;


        
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
$title = "Nuevo producto";
$whereami = "../.";
include '../../TEMPLATE/headCRUDnoIndex.php';
?>


<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mt-5">Ingresar producto</h2>
                <p>Por favor llenar este formulario y enviarlo para su almacenamiento.</p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="nombre" class="form-control"></input>
                    </div>
                    <div class="form-group">
                        <label>Imagen</label>
                        <input type="text" name="imagen" class="form-control" placeholder="Ej: bibicleta34.jpg"></input>
                    </div>
                    <div class="form-group">
                        <label>Descripción</label>
                        <input type="text" name="descripcion" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Precio</label>
                        <input type="number" name="precio" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Stock</label>
                        <input type="number" name="stock" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Categoría</label>
                        <input type="number" name="categoria" class="form-control" placeholder="Código de la categoría">
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