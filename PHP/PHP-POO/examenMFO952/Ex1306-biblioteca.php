<?php
require("errores.php");
$mensaje = "Mensajes";

// Si se envia el formulerio....
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
            header('Location: Ex1306-anidi.php');
            break;
        case 'ej4':
            header('Location: Ex1306-mediaGeom.php');
            break;
        case 'ej5':
            header('Location: Ex1306-biblioteca.php');
            break;
    }
}
// 1º Empezamos por la interfaz
interface Prestamo
{
    public function prestar(): void;
    public function devolver(): void;
}

// 2º Seguimos con el Trait
trait Reservable
{
    public function reservar(): string
    {
        return "Publicación reservada";
    }

    public function CancelarReserva(): string
    {
        return "Publicación cancelada";
    }
}

// 3º Clase padre: Publicación
abstract class Publicacion
{
    public string $titulo = "";
    protected int $publicacion = 0;
    public float $signatura = 0.0;
    public bool $disponible = true;
    public int $numPublicaciones = 0;

    public function __construct(string $titulo, int $publicacion,float $signatura, bool $disponible, int $numPublicaciones)
    {
        $this->titulo = $titulo;
        $this->publicacion = $publicacion;
        $this->signatura = $signatura;
        $this->disponible = $disponible;
        $this->numPublicaciones = $numPublicaciones;
    }

    public function __toString(): string
    {
        return json_encode([
            "Titulo:" => $this->titulo,
            "Publicacion:" => $this->publicacion,
            "Signatura:" => $this->signatura,
            "Disponible" => $this->disponible ? "Si" : "No"
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // Definir el método abstrato
    abstract public function obtenerTipo(): string;
}

// 4º La composición: class biblioteca
class Biblioteca
{
    public string $nombre = "";
    public bool $publica = true;

    public function __construct(string $nombre, bool $publica)
    {
        $this->nombre = $nombre;
        $this->publica = $publica;
    }
    public function __toString(): string
    {
        return json_encode([
            "Nombre:" => $this->nombre,
            "Publica:" => $this->publica
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}

// 5º Clase hija: libro
class Libro extends Publicacion implements Prestamo {
    use Reservable;

    // Atributos (propios)
    public string $autor = "";
    private int $numPaginas = 0;

    // Atributo composición, lo metemos aqui
    public Biblioteca $biblioteca;

    // Defnimos el atributo privado y setter/getter
    public function setnumPaginas(int $numPaginas): void
    {
        if ($numPaginas > 0) {
            $this->numPaginas = $numPaginas;
        }
    }

    public function getnumPaginas(): int
    {
        return $this->numPaginas;
    }

    // Construtor
    public function __construct(string $titulo, int $publicacion,float $signatura, bool $disponible, int $numPublicaciones, string $autor, int $numPaginas) 
    {
        parent::__construct($titulo, $publicacion, $signatura, $disponible, $numPublicaciones);
        $this->setnumPaginas($numPaginas);
        $this->autor = $autor;
        $this->biblioteca = new Biblioteca("Biblioteca Montequinto", True); 
    }

    public function __toString(): string
    {
        $miJSON = json_decode(parent::__toString(), true);
        $miJSON['numPaginas'] = $this->numPaginas;
        $miJSON['Biblioteca'] = json_decode ($this->biblioteca, true);
        return json_encode($miJSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // Implementar los tres métodos obligatorios
  


// 6º La otra clase hija: Entrenador
class Revista extends Publicacion implements Prestamo {
    use Reservable;

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

    // Implementar los tres métodos obligatorios
    

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
                <option value="ej3">Anidi</option>
                <option value="ej4">MediaGeom</option>
                <option value="ej5">Biblioteca</option>
            </select><br>

            <button type="submit" name="elegir" name="elegir" class="btn btn-success">Elegir</button>

        </form>

    </nav>
</body>

</html>