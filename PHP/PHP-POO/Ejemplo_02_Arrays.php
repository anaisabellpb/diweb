<?php //PHP-POO/Ejemplo_02_Arrays.php
/*Arrays Unidimensionales también se llaman Vectores */
# Array en formato clásico, antiguo el que esta abajo: 
$frutas = array("Peras", "Fresas", "Kiwis");
$mensaje = "";
// Recorremos el array con foreach
// $variable = array, $key = indice: $value = elemento
foreach ($frutas as $indice => $fruta) {
    $mensaje .= "$fruta <br>";
}

# Array formato moderno
$elementos =["Camion", true, 12, 3.1416];
$mensaje .= "Array moderno <br>";
$elementos [0] ="Coche";
//foreach ($elementos as $indice => $elemento) {
    //$mensaje .= "[$indice] -> $elemento <br>";
//}
# Añadimos un elemento al array
$elementos [] = 5000;// Con este corchete vacío decimos de poner el valor al final de la array
# array_splice sirve para quitar/poner elementos al array
# Ponemos entre el 12 (2) y 3.1416 (3) el elemento "Moto"
array_splice($elementos, 2, 0, "Moto");
foreach ($elementos as $indice => $elemento) {
    $mensaje .= "[$indice] -> $elemento <br>";
}
# Arrays asociativos
$alumna = [
    "nombre" => "Ana",
    "edad" => 30,
    "aprobada" => true
];
$alumna["edad"] = 31;
$mensaje .= "Array Asociativo <br>";
foreach ($alumna as $campo=> $dato) {
    $mensaje .= "[$campo] => $dato <br>";
}
?>
<!DOCTYPE html>
<html lang="eS">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap.min.css">
    <title>Arrays/Vectores PHP</title>
</head>
<body>
    <section>
        <p class="alert alert-primary m-3 p-3 w-50">
            <?php echo $mensaje; ?>
        </p>
    </section>
    <hr class="m-3 p-1 border border-success bg-primary">
    
</body>
</html>