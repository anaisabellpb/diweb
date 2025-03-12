<?php
require("errores.php");
$mensaje = "Mensajes"; // Mensaje inicial

// Menu navegación
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

class Geometria
{
    public int $base = 0;
    public int $altura = 0;

    // Constructor que inicializa los valores de base y altura
    public function __construct(int $base, int $altura)
    {
        $this->base = $base;
        $this->altura = $altura;
    }

    // Método __toString() para representar la instancia como una cadena en formato JSON
    public function __toString(): string
    {
        return json_encode([
            'Base' => $this->base,
            'Altura' => $this->altura
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}

class Triangulo extends Geometria
{ // Le hemos puesto un atributo propio no lo trae en el ejemplo
    public string $color;

    public function __construct(int $base, int $altura, string $color) // y en el parántesis seguido de altura, poner, string $color
    {
        parent::__construct($base, $altura);
        $this->color = $color;
    }

    // Sobrescribir el método __toString()de triangulo para mostrar la información como JSON
    public function __toString(): string
    {
        $miJSON = json_decode(parent::__toString(), true);
        $miJSON['Color triangulo'] = $this->color; // Array asociativo con el elemento nuevo

        return json_encode($miJSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // Método para calcular el área del triángulo
    public function area(): string
    {
        return "El área del triángulo es: " . ($this->base * $this->altura) / 2;
    }
}


class Rectangulo extends Geometria
{ // atributo propio 
    public string $textura;

    public function __construct(int $base, int $altura, string $textura) // y en el parántesis seguido de altura, poner, string $color
    {
        parent::__construct($base, $altura);
        $this->textura = $textura;
    }

    // Sobrescribir el método __toString()de triangulo para mostrar la información como JSON
    public function __toString(): string
    {
        $miJSON = json_decode(parent::__toString(), true);
        $miJSON['Textura rectángulo'] = $this->textura; // Array asociativo con el elemento nuevo

        return json_encode($miJSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // Método para calcular el área del triángulo
    public function area(): string
    {
        return "El área del rectángulo es: " . ($this->base * $this->altura);
    }
}

// Script principal
if (isset($_REQUEST['solucion'])) {
    // Recojo los datos del formulario
    $triangulo1 = new Triangulo(10, 5, "Rojo"); 
    $rectangulo1 = new Rectangulo(10, 5, "Felpa");
    $mensaje .= "<br> Triángulo <br>" . $triangulo1;
    $mensaje .= "<br> " . $triangulo1->area();
    $mensaje .= "<br> Rectángulo <br>" . $rectangulo1;
    $mensaje .= "<br> " . $rectangulo1->area();
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
    <section aria-label="volumenes" class="m-3 p-3 w-50 bg-info text-white">
        <form action="#" method="post">
            <!--<nav class="d-flex mb-3">
                <label for="a" class="w-50">Base</label>
                <input type="number" name="a" id="a" class="w-50" min="1" required>
            </nav>
            <nav class="d-flex mb-3">
                <label for="h" class="w-50">Altura</label>
                <input type="number" name="h" id="h" class="w-50" min="1" required>
            </nav><br>
            <label for="figura" class="form-label">Elige Figura:</label><br>
            <select name="figura" id="figura" class="form-control">
                <option value="triangulo">Triángulo</option>
                <option value="rectangulo">Rectángulo</option>
            </select><br>-->

            <button type="submit" name="solucion" class="btn btn-success">Ver figuras</button>
        </form>
    </section>

    <nav aria-label="navegacion" class="m-3 p-3 w-50 bg-primary">
        <form action="#" method="post">
            <label for="opcion" class="form-label">Elige Opción:</label><br>
            <select name="opcion" id="opcion" class="form-control">
                <option value="ej1">Menu</option>
                <option value="ej2">Volúmenes</option>
                <option value="ej3">Geometría</option>
                <option value="ej4">TabMultiplicar</option>
                <option value="ej5">Fútbol</option>
            </select><br>

            <button type="submit" name="elegir" class="btn btn-success">Elegir</button>

        </form>
    </nav>
</body>

</html>