<?php
// PHP-POO/Examen-repaso/Ex1306-menu.php
require("errores.php");
$mensaje = "Mensajes";

// Si se envia el formulerio....
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
            header('Location: Ex1306-geometria.php');
            break;
        case 'ej4':
            header('Location: Ex1306-tabMultiplicar.php');
            break;
        case 'ej5':
            header('Location: Ex1306-futbol.php');
            break;
    }
}

// Funciones

function volumenes($figura, $a, $h, $r): string
{
    $resultado = "";
    switch ($figura) {
        case 'prisma':
            $resultado .= "Área prisma = " . ($a * $h);
            break;
        case 'cilindro':
            $resultado .= "Área cilindro = " . (M_PI * $r * $r * $h);
            break;
        case 'cono':
            $resultado .= "Área prisma = " . ((1 / 3) * $a * $h);
            break;
        case 'esfera':
            $resultado .= "Área prisma = " . ((4 / 3) *M_PI * $r * $r * $r);
            break;
    }
    return $resultado;
}

// Script principal
if (isset($_REQUEST['solucion'])) {
    // Recojo los datos del formulario
    $figura = $_REQUEST['figura'];
    $a = $_REQUEST['a'];
    $h = $_REQUEST['h'];
    $r = $_REQUEST['r'];

    // Llamo a la función
    $mensaje = volumenes($figura, $a, $h, $r);
}

?>
<!--HTML-->

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen MF0951</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>

<body>
    <section aria-label="alerta" class="alert alert-success m-3 p-3 mb-4 w-50">
        <pre class="mb-0"><?php echo $mensaje; ?></pre>
    </section>
    <form action="#" method="post">
        <section aria-label="volumnes" class="m-3 p-3 w-50 bg-info text-white">
            <nav class="d-flex mb-3">
                <label for="a" class="w-50">Área Base</label>
                <input type="number" name="a" id="a" class="w-50" min="1">
            </nav>
            <nav class="d-flex mb-3">
                <label for="h" class="w-50">Altura</label>
                <input type="number" name="h" id="h" class="w-50" min="1">
            </nav>
            <nav class="d-flex mb-3">
                <label for="r" class="w-50">Radio</label>
                <input type="number" name="r" id="r" class="w-50" min="1">
            </nav><br>
            <label for="figura" class="form-label">Elige Figura:</label><br>
            <select name="figura" id="figura" class="form-control">
                <option value="prisma">Prisma</option>
                <option value="cilindro">Cilindro</option>
                <option value="cono">Cono</option>
                <option value="esfera">Esfera</option>
            </select><br>

            <button type="submit" name="solucion" class="btn btn-success">Solución volumen</button>
    </form>
    </section>

    <nav aria-label="navegacion" class="m-3 p-3 w-50 bg-primary">
        <form action="#" method="post">
            <label for="opcion" class="form-label">Elige Opción:</label><br>
            <select name="opcion" id="opcion" class="form-control">
                <option value="ej1">Menu</option>
                <option value="ej2">Volúmenes</option>
                <option value="ej3">Geometría</option>
                <option value="ej4">TablaMultiplicar</option>
                <option value="ej5">Fútbol</option>
            </select><br>

            <button type="submit" name="elegir" class="btn btn-success">Elegir</button>

        </form>

    </nav>
</body>

</html>