<?php // ASI DEBE QUEDAR PROFESIONALMENTE EL CÓDIGO EJ_09_Estaticos.php, el JSON Sale perfect

require("errores.php");  // Si es necesario incluir algún archivo adicional

// Clase Camion
class Camion
{
    public string $modelo = "";
    public int $potencia = 0;
    private float $precio = 0.0;
    public bool $electrico = true;

    public function __construct(string $modelo, int $potencia, float $precio, bool $electrico)
    {
        $this->modelo = $modelo;
        $this->potencia = $potencia;
        $this->setPrecio($precio);
        $this->electrico = $electrico;
    }

    public function __toString(): string
    {
        return json_encode([
            'Modelo Camión'   => $this->modelo,
            'Potencia'        => $this->potencia,
            'Precio'          => $this->precio,
            'Eléctrico'       => $this->electrico ? "Si" : "No"
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function setPrecio(float $precio): void
    {
        if ($precio > 0) {
            $this->precio = $precio;
        }
    }

    public function getPrecio(): float
    {
        return $this->precio;
    }

    // Método leeTren en la clase base Camion
    public function leeTren(): string
    {
        return "Información sobre el camión: " . $this->modelo . " con potencia de " . $this->potencia . " CV y precio de " . $this->precio . "€";
    }
}

// Clase TrenCarretera que extiende de Camion
class TrenCarretera extends Camion
{
    public bool $remolque2;
    public static int $numtrenes = 0;

    public function __construct(string $modelo, int $potencia, float $precio, bool $electrico, bool $remolque2 = true)
    {
        parent::__construct($modelo, $potencia, $precio, $electrico);
        $this->remolque2 = $remolque2;
        self::$numtrenes++;
    }

    public function __toString(): string
    {
        $miJSON = json_decode(parent::__toString(), true);
        $miJSON['¿Tiene 2ºRemolque?'] = $this->remolque2 ? "Si" : "No";
        return json_encode($miJSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // Sobrescribir el método leeTren
    public function leeTren(): string
    {
        return "Información sobre el tren: " . $this->modelo . " con potencia de " . $this->potencia . " CV y precio de " . $this->precio . "€";
    }

    public static function crearFlota(
        string $modelo,
        int $potencia,
        float $precio,
        int $numtrenes
    ): array {
        $flota = [];
        for ($i = 0; $i < $numtrenes; $i++) {
            $nuevoTren = new TrenCarretera($modelo, $potencia, $precio, true, true);
            $flota[] = json_decode($nuevoTren->__toString(), true); // Convierte el objeto a un array asociativo
        }

        // Añadir el valor de "¿Tiene 2ºRemolque?" a cada tren en la flota
        foreach ($flota as &$tren) {
            $tren['¿Tiene 2ºRemolque?'] = "Si";
        }

        return $flota;
    }
}

$mensaje = [];

// Verificación de datos del formulario
if (isset($_REQUEST['enviar'])) {
    // Recogemos los datos del formulario
    $modelo = $_REQUEST['texto'];
    $potencia = $_REQUEST['entero'];
    $precio = $_REQUEST['decimal'];
    $electrico = $_REQUEST['booleano'];
    $remolque2 = isset($_REQUEST['remolque2']) ? $_REQUEST['remolque2'] == '1' : true;

    // Creación del camión base
    $MiCamion = new Camion($modelo, $potencia, $precio, $electrico);
    $mensaje[] = json_decode($MiCamion->__toString(), true); // Guardamos el camión como un array asociativo

    // Creación de un tren
    $miTren = new TrenCarretera($modelo, $potencia, $precio, $electrico, $remolque2);
    $mensaje[] = json_decode($miTren->__toString(), true); // Guardamos el tren como un array asociativo

    // Crear una flota de trenes (número de trenes definido en el formulario o en el código)
    $flota = TrenCarretera::crearFlota($modelo, $potencia, $precio, 7); // Ajusta el número de trenes según lo necesites
    $mensaje = array_merge($mensaje, $flota); // Fusionamos la flota con el array de mensajes
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP-POO: Clases</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="all.min.css">
</head>

<body>
    <section class="alert alert-success m-3 p-3 mb-4 w-50">
        <!-- Mostrar el array en formato JSON bonito -->
        <pre class="mb-0"><?php echo json_encode($mensaje, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE); ?></pre>
    </section>

    <section>
        <h4 class="m-3 p-3">Formulario de Vehículo</h4>
    </section>

    <section class="m-3 p-3 w-50 bg-secondary text-white">
        <form action="#" method="post">
            <nav class="d-flex mb-3">
                <label for="texto" class="w-50">Modelo</label>
                <input type="text" name="texto" id="texto" class="w-50" required>
            </nav>
            <nav class="d-flex mb-3">
                <label for="entero" class="w-50">Potencia (CV)</label>
                <input type="number" name="entero" id="entero" class="w-50" required>
            </nav>
            <nav class="d-flex mb-3">
                <label for="decimal" class="w-50">Precio (€)</label>
                <input type="number" name="decimal" id="decimal" step="0.1" class="w-50" required>
            </nav>
            <hr class="bg-danger p-1">
            <p>¿Es eléctrico?</p>
            <section class="form-check">
                <input type="radio" name="booleano" id="1" class="form-check-input" value="1" checked>
                <label for="1" class="form-check-label">Sí</label>
            </section>
            <section class="form-check">
                <input type="radio" name="booleano" id="0" class="form-check-input" value="0">
                <label for="0" class="form-check-label">No</label>
            </section>
            <hr class="bg-danger p-1">
            <nav class="d-flex mb-3">
                <label for="remolque2" class="w-50">¿Tiene 2º Remolque?</label>
                <select name="remolque2" id="remolque2" class="w-50">
                    <option value="" selected></option>
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>
            </nav>
            <hr class="bg-danger p-1">
            <section class="d-flex justify-content-center">
                <button type="submit" name="enviar" class="btn btn-primary mt-3 w-50">Enviar</button>
            </section>
        </form>
    </section>

</body>

</html>
