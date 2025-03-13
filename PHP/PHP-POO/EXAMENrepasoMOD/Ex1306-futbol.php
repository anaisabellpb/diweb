<?php
require("errores.php");

// Simulación del formulario y la recolección de datos
$mensaje = "";
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
    public function concentrarse(): void;
    public function viajar(): void;
}

// 2º Seguimos con el Trait
trait Partido
{
    public function jugarPartido(): void
    {
        echo "Voy a jugar";
    }

    public function dirigirPartido(): void
    {
        echo "Soy el Mister";
    }
}

// 3º Clase padre: Deportista
abstract class Deportista
{
    protected string $identidad = "";
    protected int $edad = 0;
    protected bool $sexo = true;

    public function __construct(string $identidad, int $edad, bool $sexo)
    {
        $this->identidad = $identidad;
        $this->edad = $edad;
        $this->sexo = $sexo;
    }

    public function __toString(): string
    {
        return json_encode([
            "Identidad:" => $this->identidad,
            "Edad:" => $this->edad,
            "Sexo" => $this->sexo ? "Mujer" : "Hombre"
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // Definir el método abstrato
    abstract public function federarse(): void;
}

// 4º La composición: class club
class club
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
        return json_encode([
            "Denominacion:" => $this->denominacion,
            "Fundacion:" => $this->fundacion
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}

// 5º Clase hija: futbolista
class Futbolista extends Deportista implements Eventos {
    use Partido;

    // Atributo composición, lo metemos aqui
    public Club $club;

    // Defnimos el atributo privado y setter/getter
    private int $dorsal = 0;
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

    // Construtor
    public function __construct(string $identidad, int $edad, bool $sexo, int $dorsal) // Club $club detrás de dorsal
    {
        parent::__construct($identidad, $edad, $sexo);
        $this->setDorsal($dorsal); // Por que esta en privado más arriba
        $this->club = new Club("Real Betis", 1907); // ASI es el examen sino se pondría
        //$this->club = $club;
    }

    public function __toString(): string
    {
        $miJSON = json_decode(parent::__toString(), true);
        $miJSON['Dorsal'] = $this->dorsal;
        $miJSON['Club'] = json_decode ($this->club, true);
        return json_encode($miJSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // Implementar los tre métodos obligatorios
    public function concentrarse(): void
    {
       echo "Concentrado!";
    }

    public function viajar(): void
    {
        echo "Viajo!";
    }

    public function federarse(): void // El del padre
    {
        echo "Estoy Federado";
    }
 
}


// 6º La otra clase hija: Entrenador
class Entrenador extends Deportista implements Eventos {
    use Partido;

    // Atributo composición, lo metemos aqui
    public Club $club;

    // Defnimos el atributo privado y setter/getter
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

    // Construtor
    public function __construct(string $identidad, int $edad, bool $sexo, int $inicioEntrenador) 
    {
        parent::__construct($identidad, $edad, $sexo);
        $this->setinicioEntrenador($inicioEntrenador); // Por que esta en privado más arriba
        $this->club = new Club("Real Betis", 1907); // ASI es el examen sino se pondría
        //$this->club = $club;
    }

    public function __toString(): string
    {
        $miJSON = json_decode(parent::__toString(), true);
        $miJSON['Inicio Entrenador'] = $this->inicioEntrenador;
        $miJSON['Club'] = json_decode ($this->club, true);
        return json_encode($miJSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // Implementar los tre métodos obligatorios
    public function concentrarse(): void
    {
       echo "Concentrado!";
    }

    public function viajar(): void
    {
        echo "Viajo!";
    }

    public function federarse(): void // El del padre
    {
        echo "Estoy Federado";
    }
 
}

// script principal
if (isset($_REQUEST['solucion'])) {
    $deportistas = [];
    $deportistas [] = new Futbolista("Isco", 32, false, 8);
    $deportistas [] = new Entrenador("Pellegrini", 70, false, 2020);

    foreach ($deportistas as $i => $deportista) {// $deportistas es el array
        $mensaje .= "<br> $deportista <br>";
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
    <section>
        <h4 class="m-3 p-3">Formulario de Clubes</h4>
    </section>
    <section class="m-3 p-3 w-50 bg-secondary text-white">
        <form action="#" method="post">
            <!--<nav class="d-flex mb-3">
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
                    <option value="1">Masculino</option>
                    <option value="0">Femenino</option>
                </select>
            </nav>-->
            <hr class="bg-danger p-1">
            <section class="d-flex justify-content-center">
                <button type="submit" name="solucion" class="btn btn-primary mt-3 w-50">Enviar</button>
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