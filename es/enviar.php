<?php
require './conexion/config.php';
include './cotizar.php';

$title = "Cotización enviada";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $total=0;
    $Correo= $_POST['correoCot'];
    $Nombre = $_POST['nombreCot'];
    $Telefono = $_POST['telefonoCot'];
    foreach($_SESSION['CARRITO'] as $indice=>$producto){
        $total=$total+($producto['precio']*$producto['cantidad']);
    }

    $sql = "CALL enviar(?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $param_nombre, $param_telefono, $param_correo, $param_total);
        $param_nombre = $Nombre;
        $param_telefono = $Telefono;
        $param_correo = $Correo;
        $param_total = $total;
        $stmt->execute();

        $sql = "CALL lastId()";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $stmt->close();
        $cotizacion = $row['identifier'];

    
    foreach($_SESSION['CARRITO'] as $indice=>$producto){
        
        $sql = "CALL detail(?, ?, ?, ?, ?)";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sssss", $param_cotizacion, $param_producto, $param_precioUnitario, $param_cantidad, $param_total);
            $param_cotizacion = $cotizacion;
            $param_producto = $producto['id'];
            $param_precioUnitario = $producto['precio'];
            $param_cantidad = $producto['cantidad'];
            $param_total = ($producto['precio'] * $producto['cantidad']);
            $stmt->execute();
            
        }

    }

    unset($_SESSION['CARRITO']);
}   


include './TEMPLATE/head.php';
include './TEMPLATE/nav.php';
?>


<br>
<div class="container">
    <div class="jumbotron">
        <h1 class="display-4">¡Cotización enviada!</h1>
        <hr class="my-4">
        <p class="lead">Pronto nos pondremos en contacto para concretar la compra.</p>
        <p>Si tienes dudas o comentarios escríbenos al correo</p>
    </div>
</div>


<?php include './TEMPLATE/footer.php'; ?>