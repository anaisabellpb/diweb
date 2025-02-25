<?php //PHP-POO/Ejemplo_04_EstructurasControl.php
/*-if....else (si....si no....)
  -switch (si anidado)
  -while (bucle: mientras)
  -for (bucle: para...hasta)
  -continue/break (para y reanuda iteración/rompe iteración)
*/

if (isset($_REQUEST['enviar'])) {
    $n1 = $_REQUEST['n1'];
    $n2 = $_REQUEST['n2'];
    $mensaje = "";

    // Ambos números deben ser positivos y n2 debe ser >= n1
    // En caso contrario poner mensaje...
    // Usamos $aux para mover lo valores en caso de que no se cumpla la condición
    if ($n1 <= 0 || $n2 <= 0) {
        $n1 = abs($n1); # Convertir el nº en positivo con valor adsoluto -> abs
        $n2 = abs($n2); # Ej: abs(5) -> 5; abs(-5) -> 5
    }
    if ($n1 > $n2) {
        $mensaje = "ERROR en datos de entrada <br>";
        $aux = $n2; // va derecha a izquiera el movimiento
        $n2 = $n1;
        $n1 = $aux;
    } else if ($n1 == $n2) {
        $mensaje = "Ambos datos son iguales! <br>";
    } else {
        $mensaje = "Datos de entrada NORMALIZADOS! <br>";
    }

    // Bucle while, definimos un contador que va del 5 = n1 al 10 = n2
    $contador = $n1;
    while ($contador <= $n2) {
        $mensaje .= "$contador <br>";
        $contador++; // esto es lo mismo que poner $contador = $contador +1;
    }

    // BUCLE FOR -> $contador es ahora el $i (índice)
    // Lo mismo de arriba pero con el for...
    $mensaje .= "Lo mismo con for <br>";
    for ($i = $n1; $i <= $n2; $i++) { // El $i++ funciona como el $contador++; 
        $mensaje .= "$i <br>";
    }

    // El bucle for se puede usar para recorrer vectores
    // Los impares (x) son las filas, los pares (y) son las columnas
    // Las filas y las columnas empiezan por 0
    // La 1º posición de un array el índice es el 0
    $vector = [1, 4, 2, 2, 3, 4, 2, 1];
    // Vamos a sacar coordenadas x (filas) -> Desde 0, indices pares
    // Longitud del array => count($vector)

    $longitud = count($vector);   // = 8 (elementos)
    $mensaje .= "Coordenadas X <br>";
    for ($i = 0; $i < $longitud; $i += 2) {
        $mensaje .= "$vector[$i] <br>";
    }
    // Vamos a sacar coordenadas y (columnas) -> Desde 1, indices pares
    $mensaje .= "Coordenadas Y <br>";
    for ($i = 1; $i < $longitud; $i += 2) {
        $mensaje .= "$vector[$i] <br>";
    }
}
?>
<!DOCTYPE html>
<html lang="eS">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.min.css">
    <title>Estructuras/Control PHP</title>
</head>

<body>
    <section>
        <p class="alert alert-primary m-3 p-3 w-50">
            <?php echo $mensaje; ?>
        </p>
    </section>
    <hr class="m-3 p-1 border border-success bg-primary">
    <form action="#" method="post" class="form m-3 p-3 w-50">
        <label for="n1" class="form-label">Num1</label>
        <input type="number" name="n1" id="n1" class="form-control"><br>
        <label for="n2" class="form-label">Num2</label>
        <input type="number" name="n2" id="n2" class="form-control"><br>
        <input type="submit" name="enviar" value="Enviar" class="btn btn-success"><br>
    </form>
</body>

</html>