<?php
include "./conexion/config.php";
include "./conexion/controlador_login.php";

$title = "Empleados";

include './TEMPLATE/head.php';
?>
    body {
    min-height: 100vh;
    }

    .footer {
    position: fixed;
    left: 0;
    bottom: 0;
    min-width: 100%;
    }

    .wrapper {
    width: 600px;
    margin: 0 auto;
    }
<?php
include './TEMPLATE/nav.php';
?>
    <!-- Login -->
    <br>
    <div class="wrapper">
        <div class="container-fluid"></div>

        <main class="form-signin w-100 m-auto">
            <form method="post">
                <img class="mb-4" src="./adobe/leonlogonuevo-01.png" alt="" width="72" height="57">
                <h1 class="h3 mb-3 fw-normal">Por favor, ingresa tus datos</h1>
                <?php

                if (!empty($_SESSION["id"])) {
                    echo "<div class='alert alert-warning'>Ya tienes una sesión iniciada, se cerrará y se creará una nueva</div>";
                }
                ?>
                <div class="form-floating ">
                    <?php
                    $usuario = isset($_COOKIE['usuario']) ? $_COOKIE['usuario'] : '';
                    ?>
                    <input type="text" class="form-control" id="usuario" placeholder="name@example.com" name="usuario" value="<?php echo htmlspecialchars($usuario); ?>"><label for="floatingInput">Usuario</label>
                </div>
                <br>
                <div class="form-floating ">
                    <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                    <label for="floatingPassword">Contraseña</label>
                </div>
                <br>

                <input name="btningresar" class="btn btn-success w-100 py-2" type="submit" value="Iniciar sesión">
            </form>
            <br>
            <a href="registro.php" class="btn btn-primary w-100 py-2">Registrarse</a>
        </main>
    </div>

<?php
include './TEMPLATE/footer.php';
?>