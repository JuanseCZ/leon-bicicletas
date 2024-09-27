<?php

session_start();
session_destroy();

//  Delete cookies
setcookie("usuario", "", time() - 3600, "/");
setcookie("nombre", "", time() - 3600, "/");
setcookie("apellido", "", time() - 3600, "/");

header("Location: ../index.php");


?>