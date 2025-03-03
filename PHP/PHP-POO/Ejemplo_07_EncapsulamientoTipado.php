<?php
require("errores.php");

// PHP-POO/Ejemplo_07_EncapsulamientoTipado.php
/*  - Encapsulamiento: oculta atributos y métodos
       - Se emplea public | protected | private
       - protected -> visible sólo para desendientes
       - private -> visible sólo para la propia clase
    - Tipado: Definir tipos de datos para entrada o salida
 */


// Encapsulamiento de atributos -> página 84 manual
class camion
{
    // Atributos. Añadimos visibilidad -> public
    // Tipamos las entradas de atributos poniendo lo que es: string | int | float | bool
    // Para el encapsulamiento hacemos los o a un atributo PRIVADO Ej: precio
    public string $modelo = "";        // Cadena de caracteres (String)
    public int $potencia = 0;          // Entero (int)
    private float $precio = 0.0;        // Decimal (float)
    public bool $electrico = true;     // Booleano (booleano)

    // El constructor, método mas important, DEFINIDO COMPLETO (tiene todos los parámetros)
    // En el constructor tipamos las entradas y usamos el setter
    public function __construct(string $modelo, int $potencia, float $precio, bool $electrico)
    {
        $this->modelo = $modelo;
        $this->potencia = $potencia;
        $this->setPrecio($precio);
        $this->electrico = $electrico;
    }

    // Método __toString(): tipamos la salida se hace con string
    public function __toString(): string
    {
        // El objeto lo codificamos (encode) en formato JSON
        // texto -> JSON (encode); JSON -> texto (decode)
        return json_encode([
            'Modelo Camión' => $this->modelo,
            'Potencia' => $this->potencia,
            'Precio' => $this->precio,
            'Eléctrico' => $this->electrico ? "Si" : "No"
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // Al atributo privado le definimos el set/get
    // El setter es público y la salida es: void (sin salida)
    public function setPrecio(float $precio): void
    {
        if ($precio > 0) {// Aqui ponemos el valor mínimo del camión
            $this->precio = $precio;
        }
    }

     // El getter es público y la salida es: tipo (Aquí float)
     public function getPrecio (): float {
        return $this->precio;
     }
}

// Script pricipal
$mensaje = "Mensajes";

if (isset($_REQUEST['enviar'])) {
    $modelo = $_REQUEST['texto'];
    $potencia = $_REQUEST['entero'];
    $precio = $_REQUEST['decimal'];
    $electrico = $_REQUEST['booleano'];

    // Creamos el camión
    $MiCamion = new Camion($modelo, $potencia, $precio, $electrico);
    // Imprime el camión
    $mensaje = $MiCamion;
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

            <section class="d-flex justify-content-center">
                <button type="submit" name="enviar" class="btn btn-primary mt-3 w-50">Enviar</button>
            </section>

        </form>
    </section>


</body>

</html>