<?php
require("errores.php");

// PHP-POO/Ejemplo_12_Interfaces y Rasgos.php      

/* -INTERFACES 
     - Ayudan a que no te dejes de detrás algún método
     - Es un conjunto de métodos abstractos, no contine atributos, solo métodos abstractos
       (es un catálogo de acciones)
     - Como tengas un solo método abstrato, la clase es abstracta.  
*/


//Las interfaces y los rasgos se ponen antes que las clases
interface iFlota
{ // Copiamos lo de lleeTren, este el 1º método, es asbtracto aunque no lleve abstrac <-<
    public static function leeTren(
        string $modelo,
        int $potencia,
        float $precio,
        bool $electrico,
        bool $remolque2
    ): TrenCarretera;

    // 2º método copiamos lo de crearFlota <-<
    public static function crearFlota(
        string $modelo,
        int $potencia,
        float $precio,
        int $numtrenes
    ): string;
}

// Traits (Rasgos) -> Es una interfaz con métodos DESARROLLADOS!
// Los traits solo se emplean en PHP. Hay algo similar en Python.
// van antes de las clases
trait tBonito
{ // <-<
    public static function saludo()
    { // trait: Ponemos static
        return "Fin del programa!";
    }

    // ChatGPT
    public static function mostarNumTrenes(): string
    {
        return "<br> Nº Trenes Carretera:" . TrenCarretera::$numtrenes;
    }
}

abstract class camion // Esta será la clase PADRE, le hemos puesto abstract delante de classs
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

    // Declaro un método de abstrato 
    abstract static function leeTren(
        string $modelo,
        int $potencia,
        float $precio,
        bool $electrico,
        bool $remolque2
    ): TrenCarretera;
}

// La clase composición (MOTOR)
class motor
{
    // Atributos, y van tipados
    public string $marca;
    public int $cilindrada;

    // Constructor definido completo (sin parámetros opcionales)
    public function __construct(string $marca, int $cilindrada)
    {
        $this->marca = $marca;
        $this->cilindrada = $cilindrada;
    }

    // El método toString
    public function __toString(): string
    {
        return json_encode([
            'Marca'             => $this->marca,
            'Cilindrada'        => $this->cilindrada
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}

// Definimos la clase HIJA con extends, y el nombre con camelcase
class TrenCarretera extends Camion implements iFlota // INTERFACES: Ponemos ahora implements iFlota aquí <-<
{

    use tBonito; // Añadimos el TRAIT a la clase poniendo USE <-<

    // Atributos (propios)
    public bool $remolque2;
    public static int $numtrenes = 0;  // Este es el atributo estático

    // Añado el atributo de composición
    public Motor $motorTren;

    // El constructor (añadimos datos al padre)
    // bool $remolque2 = true -> esto es un parámetro opcional
    public function __construct(string $modelo, int $potencia, float $precio, bool $electrico, bool $remolque2 = true)
    {
        parent::__construct($modelo, $potencia, $precio, $electrico);
        $this->remolque2 = $remolque2;

        // El atributo estático se usa con -> self::
        self::$numtrenes++; // Al crear un tren, suma 1

        $this->motorTren = new Motor("Volvo", 3000); //Esto es de la composición
    }

    // Igual con el __toString
    public function __toString(): string
    {
        // json_decode -> para ocnvertir un JSON a STRING, en este caso es un array
        $miJSON = json_decode(parent::__toString(), true); // al tener el JSON del padre lo convierto a string
        // Al string le añadimos otra línea
        $miJSON['¿Tiene 2ºRemolque?'] = $this->remolque2 ? "Si" : "No";

        $miJSON['Motor'] = json_decode($this->motorTren); // Esto es de la Composición

        // Y ahora convertimos el resultado a JSON, (que antes era un STRING)
        return json_encode($miJSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // Creamos un método estático (static)
    public static function leeTren(
        string $modelo,
        int $potencia,
        float $precio,
        bool $electrico,
        bool $remolque2
    ): TrenCarretera { //  : Returntype 
        return new TrenCarretera($modelo, $potencia, $precio, $electrico, $remolque2);
    }

    // Otro método estático. Incluye arrays!
    public static function crearFlota(
        string $modelo,
        int $potencia,
        float $precio,
        int $numtrenes // bool $electrico, bool $remolque2 saldrán true
    ): string { // No va tipado xq no esta : Returntype, pero ponemos :string
        $flota = []; //Array vacío

        // Creo N trenes, eso si, TODOS IGUALES!
        for ($i = 0; $i < $numtrenes; $i++) {
            $nuevoTren = TrenCarretera::leeTren($modelo, $potencia, $precio, true, true);
            $flota[] = $nuevoTren;
        }

        // Devuelvo el string con el JSON de todos los trenes
        $mensaje = "";
        foreach ($flota as $num => $tren) {
            $mensaje .= "Tren Nº" . ($num + 1) . "<br> $tren";
        }

        return $mensaje; // al poner :string ahy que poner este mensaje
    }
}

$mensaje = "Mensajes";

if (isset($_REQUEST['enviar'])) {
    $modelo = $_REQUEST['texto'];
    $potencia = $_REQUEST['entero'];
    $precio = $_REQUEST['decimal'];
    $electrico = $_REQUEST['booleano'];
    $remolque2 = isset($_REQUEST['remolque2']) ? $_REQUEST['remolque2'] == '1' : true; // '1' significa sí, '0' no

    // No se puede crear objetos de clases abstractas, por eso las 2 líneas de abajo le hemos comentado
    // 1º línea comentada ->  $MiCamion = new Camion($modelo, $potencia, $precio, $electrico);
    // 2º línea comentada ->  $mensaje = $MiCamion; // Clase padre

    // $miTren = new TrenCarretera($modelo, $potencia, $precio, $electrico, false);
    $miTren = new TrenCarretera($modelo, $potencia, $precio, $electrico, $remolque2);
    $mensaje = "<br> Mi tren! <br>" . $miTren; // hemos quitado el . 

    // Aquí usamos el método estático
    $miTren2 = TrenCarretera::leeTren("Mercedes", $potencia, $precio, $electrico, true);
    $mensaje .= "<br> Mi tren2! <br>" . $miTren2;

    $miTrenX = new TrenCarretera($modelo, 750, $precio, true, true);
    //$mensaje .= "<br> Mi trenX! <br>" . $miTrenX;

    $mensaje .= "<br> Nº Trenes: " . TrenCarretera::$numtrenes; // Línea añadida del stático
    // $numtrenes, nos va a dar el número total de trenes, en este caso dos: $miTren y $miTren2
    // si desmarcamos del comentario $miTrenX, ya $numtrenes contaría tres trenes no dos

    // Vamos a crear una flota de trenes de Carretera
    $flota = TrenCarretera::crearFlota("Volvo FH Electric", $potencia, 450000.95, 5);
    $mensaje .= "<br> Mi FLOTA!: <br> $flota";

    // COMENTAMOS ahora este mensaje, traid ChatGPT
    // $mensaje .= "<br> Nº Trenes: " . TrenCarretera::$numtrenes; // A mi me sale nº total de trenes 7 xq $miTrenX no esta desmarcado
    $mensaje .= TrenCarretera::mostarNumTrenes();


    /** Trait, ahora ponemos esto: $mensaje .= "<br>" . $miTrenX->saludo(); 
     *  ponemos: $miTrenX xq es el último que contabiliza, en: 
     *  $mensaje .= "<br> Nº Trenes: " . TrenCarretera::$numtrenes;
     */
    // $mensaje .= "<br>" . $miTrenX->saludo(); // <-< tarit: al poner static arriba lo debemos comentar y poner: $mensaje .= "<br>" . TrenCarretera::saludo();
    $mensaje .= "<br>" . TrenCarretera::saludo();
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