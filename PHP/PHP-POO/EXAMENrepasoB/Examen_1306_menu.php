<?php
// PHP-POO/Examen-repaso/Ex1306-menu.php
require("errores.php");
$mensaje = "Mensajes";

// Si se envia el formulerio....
if (isset($_REQUEST['elegir'])) {
    $opcion = $_REQUEST['opcion'];
    // Para redireccionar con PHP se usa header('Location: <el nombre del archivo>.php');
    // Ejemplo: case 'ej3': header('Location: https://wwww.as.com');
    // Ejemplo2: case 'ej3': header('Location: ../Ejemplo_08_Herencia.php');    
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
        default:
            # code...
            break;
    }
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

            <button type="submit" name="elegir" name="elegir" class="btn btn-success">Elegir</button>

        </form>

    </nav>
</body>

</html>