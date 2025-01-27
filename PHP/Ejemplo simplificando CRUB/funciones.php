<?php
// funciones.php

function conectar() {
    // Variables de conexión
    $servidor = "localhost";
    $usuario = "root";
    $clave = "root";

    // A) Formato procedimental
    // $conexion = mysqli_connect($servidor,$usuario.$clave);

    // B) Formato POO (Programación orientada a objetos)
    // new -> es el constructor, para crear objetos
    $conexion = new mysqli($servidor, $usuario, $clave);

    if($conexion->connect_error) {
        die("ERROR!,".$conexion->connect_errno);
    } else {
        echo "La conexión es correcta";
    }

    return $conexion;
}

function conectarBBDD() {
    // Variables de conexión
    $servidor = "localhost";
    $usuario = "root";
    $clave = "root";
    $bbdd = "simplificando";

    // A) Formato procedimental
    // $conexion = mysqli_connect($servidor,$usuario.$clave, $bbdd);

    // B) Formato POO (Programación orientada a objetos)
    // new -> es el constructor, para crear objetos
    $conexion = new mysqli($servidor, $usuario, $clave, $bbdd);

    if($conexion->connect_error) {
        die("ERROR!,".$conexion->connect_errno);
    } else {
        echo "La conexión es correcta";
    }

    return $conexion;
}