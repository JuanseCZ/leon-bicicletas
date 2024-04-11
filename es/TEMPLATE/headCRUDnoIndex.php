<?php
if (empty($whereami)) {
    $whereami = "";
}
include $whereami.'./TEMPLATE/head.php';
?>
.wrapper {
width: 600px;
margin: 0 auto;
}
<?php
if ($title == "Contacto") {
        echo '.footer {';
        echo '  position: fixed;';
        echo '  left: 0;';
        echo '  bottom: 0;';
        echo '  min-width: 100%;';  
        echo '}';
}
include $whereami.'./TEMPLATE/nav.php';
?>