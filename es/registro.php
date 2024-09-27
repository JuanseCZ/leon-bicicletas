<?php
// Activar la visualización de errores para depuración
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include "./conexion/config.php";

$title = "Registro";

include './TEMPLATE/head.php';

$errores = [];
$exito = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_usuario = trim($_POST["username"]);
    $correo = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $confirmar_password = trim($_POST["confirm_password"]);

    // Validaciones (sin cambios)

    // Verificar si hay errores antes de insertar en la base de datos
    if (empty($errores)) {
        $password_encriptada = hash("sha256", $password);

        $sql = "INSERT INTO empleados (nomEmple, usr, passwd) VALUES (?, ?, ?)";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("sss", $nombre_usuario, $correo, $password_encriptada);

            if ($stmt->execute()) {
                $exito = "¡Registro exitoso!";
            } else {
                $errores[] = "Algo salió mal. Por favor, intenta de nuevo más tarde.";
            }

            $stmt->close();
        } else {
            $errores[] = "Error en la preparación de la consulta: " . $conn->error;
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <!-- Asegúrate de incluir tus estilos CSS aquí -->
</head>
<body>
<div class="container">
    <h2>Registrarse</h2>
    <?php
    if (!empty($errores)) {
        echo '<div class="alert alert-danger"><ul>';
        foreach ($errores as $error) {
            echo '<li>' . htmlspecialchars($error) . '</li>';
        }
        echo '</ul></div>';
    }

    if (!empty($exito)) {
        echo '<div class="alert alert-success">' . htmlspecialchars($exito) . '</div>';
    }
    ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label>Nombre de Usuario</label>
            <input type="text" name="username" class="form-control" value="<?php echo isset($nombre_usuario) ? htmlspecialchars($nombre_usuario) : ''; ?>">
        </div>
        <div class="form-group">
            <label>Correo Electrónico</label>
            <input type="email" name="email" class="form-control" value="<?php echo isset($correo) ? htmlspecialchars($correo) : ''; ?>">
        </div>
        <div class="form-group">
            <label>Contraseña</label>
            <input type="password" name="password" class="form-control">
        </div>
        <div class="form-group">
            <label>Confirmar Contraseña</label>
            <input type="password" name="confirm_password" class="form-control">
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Registrarse">
        </div>
    </form>
</div>

<?php include './TEMPLATE/footer.php'; ?>
</body>
</html>