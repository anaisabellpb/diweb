<?php

require("errores.php");
$mensaje = "Mensaje";

if (isset($_REQUEST['elegir'])) {
    $opcion = $_REQUEST['opcion'];
    switch ($opcion) {
        case 'ej1':
            header('Location: Ex1306-menu.php');
            break;
        case 'ej2':
            header('Location: Ex1306-volumenes.php');
            break;
        case 'ej3':
            header('Location: Ex1306-anidi.php');
            break;
        case 'ej4':
            header('Location: Ex1306-medioGeom.php');
            break;
        case 'ej5':
            header('Location: Ex1306-biblioteca.php');
            break;
    }
}


function tetraedro($a, $h): string
{
    $resultado = "";
    $resultado .= "Volumen Tetaedro = " . ((1 / 3) * $a * $h);
    return $resultado;
}


function paralelepipedo($a, $b, $c): string
{
    $resultado = "";
    $resultado .= "Volumen Paralelepípedo = " . ($a * $b * $c);
    return $resultado;
}


function elipsoide($a, $b, $c): string
{
    $resultado = "";
    $resultado .= "Volumen Elipsoide = " . ((4 / 3) * M_PI * $a * $b * $c);
    return $resultado;
}



function cono($b, $r, $h): string
{
    $resultado = "";
    $resultado .= "Volumen Cono Truncado = " . ((1 / 3) * $h * ($b * $b + $b * $r + $r * $r));
    return $resultado;
}


if (isset($_REQUEST['solucion'])) {
    $figura = $_REQUEST['figura'];
    $a = $_REQUEST['a'];
    $b = $_REQUEST['b'];
    $c = $_REQUEST['c'];

    switch ($figura) {
        case 'tetraedro':
            $mensaje .= tetraedro($a, $b);
            break;
        case 'parallelepipedo':
            $mensaje .= paralelepipedo($a, $b, $c);
            break;
        case 'elipsoide':
            $mensaje .= elipsoide($a, $b, $c);
            break;
        case 'cono':
            $mensaje .= cono($a, $b, $c);
            break;
    }
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen modelo formativo 0952</title>
    <link rel="stylesheet" href="bootstrap.min.css">


</head>

<body>
    <section aria-label="alerta"
        class="alert alert-success m-3 p-3 w-50">
        <pre class="mb-0"><?php echo $mensaje; ?></pre>
    </section>
    <nav aria-label="navegacion" class="m-3 p-3 w-50 bg-primary">
        <form action="#" method="post">
            <label for="opcion">Elige Opción:</label><br>
            <select name="opcion" id="opcion" class="for-control">
                <option value="ej1">Menú</option>
                <option value="ej2">Volúmenes</option>
                <option value="ej3">Anidi</option>
                <option value="ej4">Media Geometrica</option>
                <option value="ej5">Biblioteca</option>
            </select><br>
            <button type="submit" name="elegir" class="btn btn-success">Elegir</button>

        </form>


        <section aria-label="volumenes">
            <section class="m-3 p-3 w-50 bg-info text-white">
                <form action="#" method="post">

                    <nav class="d-flex mb-3">
                        <label for="a" class="w-50">Área Base</label>
                        <input type="number" name="a" id="a" class="w-50" min="1">
                    </nav>

                    <nav class="d-flex mb-3">
                        <label for="b" class="w-50">Altura </label>
                        <input type="number" name="b" id="b" class="w-50" min="1">
                    </nav>

                    <nav class="d-flex mb-3">
                        <label for="c" class="w-50">Radio</label>
                        <input type="number" name="c" id="c" class="w-50" min="1">
                    </nav>

                    <label for="figura">Elige Opción:</label><br>
                    <select name="figura" id="figura" class="form-control">
                        <option value="tetaedro">Tetaedro</option>
                        <option value="paralelepipedo">paralelepípedo</option>
                        <option value="elipsoide">Elipsoide</option>
                        <option value="cono">Cono Truncado</option>
                    </select><br>
                    <button type="submit" name="solucion" class="btn btn-success">Solución Figuras Volumen</button>

                </form>
            </section>