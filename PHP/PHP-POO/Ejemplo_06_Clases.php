<?php
require("errores.php");

// PHP-POO/Ejemplo_06_Clases.php
/* Clase -> Plantilla/Molde con Atributos y métodos
   Constructor -> Método que crea el objeto (new)
   Destructor -> Método que elimina el objeto
   Las clases se ponen al INICIO del archivo/código. Pág 70
 */
// Declaración de la clase -> página 70 manual
class camion {
    // Atributos. Añadimos visibilidad -> public
    public $modelo = "";        // Cadena de caracteres (String)
    public $potencia = 0;       // Entero (int)
    public $precio = 0.0;       // Decimal (float)
    public $electrico = true;   // Booleano (booleano)

    // El constructor, método mas important, DEFINIDO COMPLETO (tiene todos los parámetros)
    public function __construct($modelo, $potencia, $precio, $electrico)
    {
        $this->modelo = $modelo;
        $this->potencia = $potencia;
        $this->precio = $precio;
        $this->electrico = $electrico;
    }

    // Método __toString() -> Imprime el objeto -> Pág 82
    public function __toString()
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
                    <input type="number" name="decimal" id="decimal" step="0.1" class="w-50"required>
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