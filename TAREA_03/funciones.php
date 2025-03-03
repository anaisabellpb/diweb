<?php
// funciones.php

function conectarBBDD() {
    $servidor = "localhost";
    $usuario = "root";
    $clave = "root";
    $bbdd = "ECI";

    $conexion = new mysqli($servidor, $usuario, $clave, $bbdd);

    if ($conexion->connect_error) {
        die("ERROR: " . $conexion->connect_errno);
    }

    return $conexion;
}
?>
