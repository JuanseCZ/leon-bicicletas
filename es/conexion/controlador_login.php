<?php

session_start();
if (!empty($_POST["btningresar"])) {
    if (!empty($_POST["usuario"]) and !empty($_POST["password"])) {
        $usuario = $_POST["usuario"];
        $password = $_POST["password"];
        // $password = MD5($password);
        $sql = $conn->query("select * from empleados where usr = '$usuario' and passwd = '$password'");
        if ($datos = $sql->fetch_object()) {
            $_SESSION["id"]=$datos->idEmple;
            $_SESSION["nombre"]=$datos->nomEmple;
            $_SESSION["apellido"]=$datos->apeEmple;
            $_SESSION["admin"]=$datos->isadmin;

            // We save the cookies here 👇
            setcookie("usuario", $usuario, time() + (86400 * 30), "/"); // 1 day duration
            setcookie("nombre", $datos->nomEmple, time() + (86400 * 30), "/");
            setcookie("apellido", $datos->apeEmple, time() + (86400 * 30), "/");

            header("location: ./administracion.php");
        }
        else {
            echo "<div class='alert alert-danger'>Acceso denegado</div>";
        }

    } else {
        echo "<div class='alert alert-warning'>Campos vacíos</div>";
    }

}

?>