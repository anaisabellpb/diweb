<?php
require("errores.php");
$mensaje = "Mensajes"; // Mensaje inicial
// MENU NAVEGACIÓN Y MENSAJE
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

// 1º Empezamos por la interfaz
interface Eventos
{
    public function concentrarse(): string;  // Modificado para devolver un string
    public function viajar(): string;       // Modificado para devolver un string
}

// 2º Seguimos con el Trait
trait Partido
{
    public function jugarPartido(): string  // Modificado para devolver un string
    {
        return "Voy a jugar";
    }

    public function dirigirPartido(): string  // Modificado para devolver un string
    {
        return "Soy el Mister";
    }
}

// 3º Clase padre: Deportista
abstract class Deportista
{
    protected string $identidad = "";
    protected int $edad = 0;
    protected bool $sexo = true; // true = Mujer, false = Hombre

    public function __construct(string $identidad, int $edad, bool $sexo)
    {
        $this->identidad = $identidad;
        $this->edad = $edad;
        $this->sexo = $sexo;
    }

    public function __toString(): string
    {
        return json_encode([
            "Identidad" => $this->identidad,
            "Edad" => $this->edad,
            "Sexo" => $this->sexo ? "Mujer" : "Hombre"
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    abstract public function federarse(): void;
}

// 4º La composición: class club
class Club
{
    public string $denominacion = "";
    public int $fundacion = 1890;

    public function __construct(string $denominacion, int $fundacion)
    {
        $this->denominacion = $denominacion;
        $this->fundacion = $fundacion;
    }

    public function __toString(): string
    {
        return $this->denominacion . " - Fundación " . $this->fundacion;
    }
}

// 5º Clase hija: futbolista
class Futbolista extends Deportista implements Eventos
{
    use Partido;

    public Club $club;
    private int $dorsal = 0;
    private bool $federado = false;

    public function setDorsal(int $dorsal): void
    {
        if ($dorsal > 0) {
            $this->dorsal = $dorsal;
        }
    }

    public function getDorsal(): int
    {
        return $this->dorsal;
    }

    public function __construct(string $identidad, int $edad, bool $sexo, int $dorsal)
    {
        parent::__construct($identidad, $edad, $sexo);
        $this->setDorsal($dorsal);
        $this->club = new Club("Real Betis Balompié", 1907);
    }

    public function __toString(): string
    {
        // Obtener la información de la clase padre (Deportista)
        $informacion = json_decode(parent::__toString(), true);

        // Obtener la federación
        $informacion['Federado'] = $this->federado ? "Estoy Federado" : "No federado";

        // Obtener la información del club
        $informacion['Club'] = $this->club->__toString();

        // Obtener eventos como una cadena concatenada
        $informacion['Eventos'] = $this->viajar() . $this->concentrarse() . $this->jugarPartido();

        // Formato final: Todos los datos en un solo string
        return json_encode($informacion, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function concentrarse(): string
    {
        return "Concentrado!";  // Modificado para devolver un string
    }

    public function viajar(): string
    {
        return "Viajo!";  // Modificado para devolver un string
    }

    public function federarse(): void
    {
        $this->federado = true;
    }
}

// 6º La clase hija: Entrenador
class Entrenador extends Deportista implements Eventos
{
    use Partido;

    public Club $club;
    private int $inicioEntrenador = 0;

    public function setInicioEntrenador(int $inicioEntrenador): void
    {
        if ($inicioEntrenador >2000) {
            $this->inicioEntrenador = $inicioEntrenador;
        }
    }

    public function getInicioEntrenador(): int
    {
        return $this->inicioEntrenador;
    }

    public function __construct(string $identidad, int $edad, bool $sexo, int $inicioEntrenador, Club $club)
    {
        parent::__construct($identidad, $edad, $sexo);
        $this->setInicioEntrenador($inicioEntrenador);
        $this->club = $club;
    }

    public function __toString(): string
    {
        $miJSON = json_decode(parent::__toString(), true);
        $miJSON['Inicio Entrenador'] = $this->inicioEntrenador;
        $miJSON['Club'] = $this->club->__toString();
        return json_encode($miJSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function concentrarse(): string
    {
        return "Concentrado!";
    }

    public function viajar(): string
    {
        return "Viajo!";
    }

    public function federarse(): void
    {
        // Los entrenadores no necesitan federarse en este caso
        echo "El entrenador está federado";
    }
}

// Manejo de datos del formulario
if (isset($_REQUEST['enviar'])) {
    $identidad = $_REQUEST['texto'];
    $edad = $_REQUEST['edad'];
    $sexo = $_REQUEST['sexo'];
    $dorsal = $_REQUEST['dorsal'];

    // Verificar si la opción 'tipo' ha sido seleccionada en el formulario
    if (isset($_REQUEST['tipo'])) {
        $tipo = $_REQUEST['tipo']; // Obtener el valor de tipo

        // Crear un objeto dependiendo del tipo
        if ($tipo == 'futbolista') {
            // Crear un nuevo Futbolista
            $futbolista = new Futbolista($identidad, $edad, $sexo == 1, $dorsal);
            $futbolista->federarse();
            $mensaje = $futbolista->__toString(); // Llamamos directamente a __toString para obtener toda la info
        } else if ($tipo == 'entrenador') {
            // Crear un nuevo Entrenador
            $entrenador = new Entrenador($identidad, $edad, $sexo == 1, 2010, new Club("Real Betis Balompié", 1907));
            $mensaje = $entrenador->__toString();
        }
    } else {
        // Si no se ha seleccionado el tipo, podemos mostrar un mensaje de error
        $mensaje = "Por favor, seleccione un tipo (Futbolista o Entrenador).";
    }
}



?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen1306</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>
<body>
    <section class="alert alert-success m-3 p-3 mb-4 w-50">
        <pre class="mb-0"><?php echo $mensaje; ?></pre>
    </section>

    <section class="m-3 p-3 w-50 bg-secondary text-white">
        <form action="#" method="post">
            <nav class="d-flex mb-3">
                <label for="texto" class="w-50">Identidad</label>
                <input type="text" name="texto" id="texto" class="w-50" required>
            </nav>
            <nav class="d-flex mb-3">
                <label for="edad" class="w-50">Edad</label>
                <input type="number" name="edad" id="edad" class="w-50" required>
            </nav>
            <nav class="d-flex mb-3">
                <label for="dorsal" class="w-50">Dorsal</label>
                <input type="number" name="dorsal" id="dorsal" class="w-50" required>
            </nav>
            <hr class="bg-danger p-1">
            <nav class="d-flex mb-3">
                <label for="sexo" class="w-50">Sexo:</label>
                <select name="sexo" id="sexo" class="w-50">
                    <option value="1">Femenino</option>
                    <option value="0">Masculino</option>
                </select>
            </nav>
            <nav class="d-flex mb-3">
                <label for="tipo" class="w-50">Tipo:</label>
                <select name="tipo" id="tipo" class="w-50">
                    <option value="futbolista">Futbolista</option>
                    <option value="entrenador">Entrenador</option>
                </select>
            </nav>
            <hr class="bg-danger p-1">
            <section class="d-flex justify-content-center">
                <button type="submit" name="enviar" class="btn btn-primary mt-3 w-50">Enviar</button>
            </section>
        </form>
    </section>

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

