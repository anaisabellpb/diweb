<?php   
// PHP-POO/Ejercicio_01_CoordenadasMatrices.php
/*  Sea el array de coordenadas con valores (x,y), 
    siendo x=fila (empezando por 0) e y=columna (empezando por 0)
    Sacar la suma en el alert de los elementos designados en coordenadas
 */

if (isset($_REQUEST['enviar'])) {
    $suma = 0;
    $coordenadas = [1,4,0,3,2,2,3,4,2,1,0,1,4,4];
    $matriz = [
        [1,3,7,2,4],          # Fila1, indice = 0
        [3,2,1,0,3],
        [6,2,2,1,6],
        [4,5,8,4,2],          # $matriz[3,2] = 8
        [1,1,1,0,1]
    ];

    // Resto de código...
    $longitud = count($coordenadas);
    for ($i = 0; $i < $longitud; $i += 2) {
        $x = $coordenadas[$i];
        $y = $coordenadas[$i+1];
        $suma += $matriz[$x][$y];
    }
    
    // Salida...
    $mensaje = "La suma de los elementos es $suma";
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=., initial-scale=1.0">
    <title>Arrays/Vectores PHP</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>

<body>
    <section>
        <p class="alert alert-primary m-3 p-3 w-50">
            <?php echo $mensaje; ?></p>
    </section>
    <hr class="m-3 p-1 bg-primary">
    <form action="#" method="post" class="form m-3 p-3 w-50">
        <input type="submit" value="Enviar" class="btn btn-success" name="enviar">
    </form>
</body>

</html>