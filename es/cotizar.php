<?php
if (empty($whereami)) {
    $whereami = "";
}
session_start();
require_once $whereami.'./conexion/config.php';

$mensaje = "";

if (isset($_POST['btnAccion'])) {
    switch ($_POST['btnAccion']) {
        case 'Agregar':
            if (is_numeric(openssl_decrypt($_POST['id'], COD, KEY))) {
                $id = openssl_decrypt($_POST['id'], COD, KEY);
                $mensaje .= "Ok id correcto" . $id . "<br/>";
            } else {
                $mensaje .= "Upss... id incorrecto" . $id . "<br/>";
            }
            if (is_string(openssl_decrypt($_POST['nombre'], COD, KEY))) {
                $nombre = openssl_decrypt($_POST['nombre'], COD, KEY);
                $mensaje .= "Ok nombre correcto" . $nombre . "<br/>";
            } else {
                $mensaje .= "Upss... nombre incorrecto" . $nombre . "<br/>";
            }
            if (is_numeric(openssl_decrypt($_POST['precio'], COD, KEY))) {
                $precio = openssl_decrypt($_POST['precio'], COD, KEY);
                $mensaje .= "Ok precio correcto" . $precio . "<br/>";
            } else {
                $mensaje .= "Upss... precio incorrecto" . $precio . "<br/>";
            }
            if (is_numeric(openssl_decrypt($_POST['cantidad'], COD, KEY))) {
                $cantidad = openssl_decrypt($_POST['cantidad'], COD, KEY);
                $mensaje .= "Ok cantidad correcto" . $cantidad . "<br/>";
            } else {
                $mensaje .= "Upss... cantidad incorrecto" . $cantidad . "<br/>";
            }
            if (!isset($_SESSION['CARRITO'])) {
                $producto = array(
                    'id' => $id,
                    'nombre' => $nombre,
                    'precio' => $precio,
                    'cantidad' => $cantidad
                );
                $_SESSION['CARRITO'][0] = $producto;
                $mensaje = "Producto agregado al cotizador <br>";
            } else {
                $idProductos = array_column($_SESSION['CARRITO'], "id");
                if (in_array($id, $idProductos)) {
                    $mensaje = "El producto ya ha sido seleccionado... <br>";
                } else {
                    $NumeroProductos = count($_SESSION['CARRITO']);
                    $producto = array(
                        'id' => $id,
                        'nombre' => $nombre,
                        'precio' => $precio,
                        'cantidad' => $cantidad
                    );
                    $_SESSION['CARRITO'][$NumeroProductos] = $producto;
                    $mensaje = "Producto agregado al cotizador <br>";
                }
            }
        break;
        case 'Eliminar':
            if (is_numeric(openssl_decrypt($_POST['id'], COD, KEY))) {
                $id = openssl_decrypt($_POST['id'], COD, KEY);
                foreach ($_SESSION['CARRITO'] as $indice => $producto) {
                    if ($producto['id'] == $id) {
                        unset($_SESSION['CARRITO'][$indice]);
                    }
                }
            } else {
                $mensaje .= "Ups... id incorrecto" . $id . "<br/>";
            }
        break;
    }
}
?>