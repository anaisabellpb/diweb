<?php
require("errores.php");
$mensaje = "Mensajes"; // Mensaje inicial

class Geometria
{
    public $base = 0; // Base
    public $altura = 0; // Altura

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
{
    public function __construct(int $base, int $altura)
    {
        parent::__construct($base, $altura);
    }

    // Método para calcular el área del triángulo
    public function area(): float
    {
        return ($this->base * $this->altura) / 2;
    }

    // Sobrescribir el método __toString() para mostrar la información como JSON
    public function __toString(): string
    {
        $area = $this->area(); // Calcular el área
        return json_encode([
            'Figura' => 'Triángulo',
            'Base' => $this->base,
            'Altura' => $this->altura,
            'Área' => $area
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}

// Clase Rectangulo que hereda de Geometria
class Rectangulo extends Geometria
{
    // Constructor heredado de la superclase
    public function __construct(int $base, int $altura)
    {
        parent::__construct($base, $altura);
    }

    // Método __toString() heredado de la superclase
    public function __toString(): string
    {
        $area = $this->area(); // Calcular el área
        return json_encode([
            'Figura' => 'Rectángulo',
            'Base' => $this->base,
            'Altura' => $this->altura,
            'Área' => $area
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // Método para calcular el área del rectángulo
    public function area(): float
    {
        return $this->base * $this->altura;
    }
}

// Si se envia el formulario....
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

// Script principal
if (isset($_REQUEST['solucion'])) {
    // Recojo los datos del formulario
    $figura = $_REQUEST['figura']; // Figuras como Triángulo o Rectángulo
    $base = $_REQUEST['a']; // Base
    $altura = $_REQUEST['h']; // Altura

    // Determinar la figura seleccionada y crear la instancia correspondiente
    if ($figura == 'triangulo') {
        $figuraObj = new Triangulo($base, $altura); // Triángulo con base y altura
    } elseif ($figura == 'rectangulo') {
        $figuraObj = new Rectangulo($base, $altura); // Rectángulo con base y altura
    } else {
        $mensaje = "Figura no válida.";
    }

    // Mostrar el objeto (como cadena JSON)
    if (isset($figuraObj)) {
        $mensaje = $figuraObj;
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
    <form action="#" method="post">
        <section aria-label="volumenes" class="m-3 p-3 w-50 bg-info text-white">
            <nav class="d-flex mb-3">
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
            </select><br>

            <button type="submit" name="solucion" class="btn btn-success">Solución Área</button>
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
