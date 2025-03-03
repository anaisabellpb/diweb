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
    <main class="container mt-5">

        <section class="alert alert-success p-3 mb-4 w-100 text-center">
            <p class="mb-0"><?php echo $mensaje; ?></p>
        </section>

        <!-- Formulario -->
        <section>
            <h4 class="text-center mb-4">Formulario de Vehículo</h4>
        </section>
                <form action="#" method="post" class="bg-light p-4 rounded shadow-sm border border-secondary">
                    <fieldset class="mb-3">
                        <fieldset class="mb-3">
                            <label for="texto" class="form-label">Modelo</label>
                            <input type="text" name="texto" id="texto" class="form-control" required>
                        </fieldset>

                        <fieldset class="mb-3">
                            <label for="entero" class="form-label">Potencia (CV)</label>
                            <input type="number" name="entero" id="entero" class="form-control" required>
                        </fieldset>

                        <fieldset class="mb-3">
                            <label for="decimal" class="form-label">Precio (€)</label>
                            <input type="number" name="decimal" id="decimal" step="0.1" class="form-control" required>
                        </fieldset>


                        <hr class="bg-danger p-1">

                        <p>¿Es eléctrico?</p>
                        <div class="form-check">
                            <input type="radio" name="booleano" id="1" class="form-check-input" value="1" checked>
                            <label for="1" class="form-check-label">Sí</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="booleano" id="0" class="form-check-input" value="0">
                            <label for="0" class="form-check-label">No</label>
                        </div>

                        <hr class="bg-danger p-1">

                        <section class="d-flex justify-content-center">
                            <button type="submit" name="enviar" class="btn btn-primary mt-3 w-50">Enviar</button>
                        </section>
                    </fieldset>
                </form>

          
    </main>
</body>

</html>