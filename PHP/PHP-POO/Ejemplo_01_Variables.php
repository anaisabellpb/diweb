<?php
//PHP-POO/Ejemplo_01_Variables.php
// Si solo hay PHP, NO CERRAR PHP!!
// locallhost/Curso/PHP-POO/Ejemplo_01_Variables.php

# Tipos de variables (Primitivos):
# Númeror (enteros/flotantes), booleanos, cadenas caracteres (string)
# No primitivos: arrays y objetos
if (isset($_REQUEST['enviar']))  { # ($_REQUEST['enviar']) Es una Variable predefinida
    $n1 = $_REQUEST['n1'];
    $n2 = $_REQUEST['n2'];
    $resultado = $n1 + $n2;
    $mensaje = "La suma es $resultado";
    // Esto es una constante
    define('PI', 3.1416);
    $resultado = $n1 + $n2 * PI;
    // .= Se usa para concatenar
    $mensaje .= "<br> Resultado + 'PI' = $resultado";
    /**Operadores aritméticos son: +, -, *, /, % (modulo, ** (potencia))
     * Comparación: >, >=, <, <=, ==, !== (distinto), === (igual estricto)
     * Incremento/Disminución: ++, --, +=, -=
     * Concatenación: . , .=
     * Bit a BIt: & (and), || (or), ^(xor), ~(not)*/
    $resultado = $n1 > $n2;
    if(!$resultado) $resultado = 0; // Si es false = 0
    $mensaje .= "<br> Comparo $n1 > $n2 -> $resultado ";
}
?>
<!DOCTYPE html>
<html lang="eS">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.min.css">
    <title>Variables PHP</title>
</head>
<body>
    <section>
        <p class="alert alert-primary m-3 p-3 w-50">
            <?php echo $mensaje; ?>
        </p>
    </section>
    <hr class="m-3 p-1 border border-success bg-primary">
    <form action="#" method="post" class="form m-3 p-3 w-50">
        <label for="n1" class="form-label">N1</label>
        <input type="number" name="n1" id="n1" class="form-control"><br>
        <label for="n2" class="form-label">N2</label>
        <input type="number" name="n2" id="n2" class="form-control"><br>
        <input type="submit" name="enviar" value="Enviar" class="btn btn-success"><br>
    </form>
</body>
</html>