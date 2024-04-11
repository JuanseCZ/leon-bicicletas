<?php
header('Content-Type: text/html; charset=utf-8');

define('KEY', 'Mdg4PL*NssM3ajD');
define('COD', 'AES-128-ECB');

// For infinityfreeapp
// $host = 'sql300.infinityfree.com';
// $dbuser = 'epiz_34334101';
// $dbpass = 'YUGMiyJVG40XcR';
// $db = 'epiz_34334101_leonbicicletas';

// For localhost
$host = 'localhost';
$dbuser = 'root';
$dbpass = '';
$db = 'leonbicicletas';

$conn = new mysqli($host, $dbuser, $dbpass, $db);

if ($conn->connect_errno) {
    echo "<p>La conexion falló" . $conn->connect_error . "</p>";
}

$conn->set_charset("utf8mb4");

?>