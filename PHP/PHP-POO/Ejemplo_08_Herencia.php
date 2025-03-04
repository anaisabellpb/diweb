<?php
require("errores.php");

// PHP-POO/Ejemplo_08_Herencia.php      VERSIÓN MÍA 

/*  - Mecanismo para heredar atributos y métodos -> (Pág 103 manual)
    - Se emplea extends dentro de la clase
    - En los métodos, para agregar elementos se usa -> parent::
*/

class camion // Esta será la clase PADRE
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
}

// Definimos la clase HIJA con extends, y el nombre con camelcase
class TrenCarretera extends Camion
{
    // Atributos (propios)
    public bool $remolque2;

    // El constructor (añadimos datos al padre)
    // bool $remolque2 = true -> esto es un parámetro opcional
    public function __construct(string $modelo, int $potencia, float $precio, bool $electrico, bool $remolque2 = true)
    {
        parent::__construct($modelo, $potencia, $precio, $electrico);
        $this->remolque2 = $remolque2;
    }

    // Igual con el __toString
    public function __toString(): string
    {
        // json_decode -> para ocnvertir un JSON a STRING, en este caso es un array
        $miJSON = json_decode(parent::__toString(), true); // al tener el JSON del padre lo convierto a string
        // Al string le añadimos otra línea
        $miJSON['Tiene 2ºRemolque?'] = $this->remolque2 ? "Si" : "No";
        // Y ahora convertimos el resultado a JSON, (que antes era un STRING)
        return json_encode($miJSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}

$mensaje = "Mensajes";

if (isset($_REQUEST['enviar'])) {
    $modelo = $_REQUEST['texto'];
    $potencia = $_REQUEST['entero'];
    $precio = $_REQUEST['decimal'];
    $electrico = $_REQUEST['booleano'];
    $remolque2 = isset($_REQUEST['remolque2']) ? $_REQUEST['remolque2'] == '1' : true; // '1' significa sí, '0' no

    $MiCamion = new Camion($modelo, $potencia, $precio, $electrico);
    $mensaje = $MiCamion; // Clase padre
    // $miTren = new TrenCarretera($modelo, $potencia, $precio, $electrico, false);
    $miTren = new TrenCarretera($modelo, $potencia, $precio, $electrico, $remolque2);
    $mensaje .= "<br> Mi tren! <br>" . $miTren;
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP-POO: Clases</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <link rel="stylesheet" href="all.min.css"><!-- FontAwesome -->
</head>

<body>
    <section class="alert alert-success m-3 p-3 mb-4 w-50">
        <pre class="mb-0"><?php echo $mensaje; ?></pre>
    </section>
    <!-- Formulario -->
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

            </select>
        </form>
    </section>

</body>

</html>