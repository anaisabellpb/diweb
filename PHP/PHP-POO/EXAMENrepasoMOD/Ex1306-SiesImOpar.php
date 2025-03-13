<?php
// SI ES UN NÚMERO IMPAR O PAR

require("errores.php");
// Validación y procesamiento de la solicitud
$mensaje = "Mensajes";

// Clase para determinar si un número es par o impar
class Numero {
    private $numero;

    // Constructor para inicializar el número
    public function __construct($numero) {
        $this->numero = $numero;
    }

    // Método para verificar si el número es par
    public function esPar() {
        return $this->numero % 2 === 0;
    }

    // Método para verificar si el número es impar
    public function esImpar() {
        return $this->numero % 2 !== 0;
    }

    // Método para obtener el resultado
    public function obtenerResultado() {
        if ($this->esPar()) {
            return "El número {$this->numero} es Par.";
        } elseif ($this->esImpar()) {
            return "El número {$this->numero} es Impar.";
        } else {
            return "No es un número válido.";
        }
    }
}

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

// Si se ha enviado el formulario
if (isset($_POST['solucion'])) {
    $numero = $_POST['numero'];

    // Validación de que el número esté entre 1 y 20
    if ($numero < 1 || $numero > 20) {
        $mensaje = "El número debe estar entre 1 y 20.";
    } else {
        // Crear un objeto de la clase Numero
        $numeroObj = new Numero($numero);
        $mensaje = $numeroObj->obtenerResultado(); // Obtener el resultado (par o impar)
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificar Par o Impar</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
    <article class="alert alert-success m-3 p-3 mb-4 w-50">
        <pre class="mb-0"><?php echo $mensaje; ?></pre>
    </article>

    <!-- Formulario para ingresar el número -->
    <form action="#" method="post">
        <section class="m-3 p-3 w-50 bg-info text-white">
            <header class="d-flex mb-3">
                <label for="numero" class="w-50">Introduce un número:</label>
                <input type="number" name="numero" id="numero" class="w-50" min="1" max="20" required>
            </header>

            <p class="text-danger"> * El número debe estar entre 1 y 20.</p>
            <button type="submit" name="solucion" class="btn btn-success">Verificar</button>
        </section>
    </form>

    <!-- Menú de navegación -->
    <nav aria-label="navegacion" class="m-3 p-3 w-50 bg-primary">
        <form action="#" method="post">
            <label for="opcion" class="form-label">Elige Opción:</label><br>
            <select name="opcion" id="opcion" class="form-control">
                <option value="ej1">Menu</option>
                <option value="ej2">Volúmenes</option>
                <option value="ej3">Geometría</option>
                <option value="ej4">TablaMultiplicar</option>
                <option value="ej5">Fútbol</option>
            </select><br>

            <button type="submit" name="elegir" class="btn btn-success">Elegir</button>
        </form>
    </nav>
</body>
</html>
