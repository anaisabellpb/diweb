<?php
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
            'Identidad' => $this->identidad,
            'Edad' => $this->edad,
            'Sexo' => $this->sexo ? "Masculino" : "Femenino"
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function federarse():void {}
}

class Futbolista extends Deportista{
    public int $dorsal;

    public function __construct(string $identidad, int $edad, bool $sexo, int $dorsal)
    {
        parent::__construct($identidad, $edad, $sexo);
        $this->dorsal = $dorsal;
    }

    public function __toString(): string
    {
        $miJSON = json_decode(parent::__toString(), true);
        $miJSON['Dorsal'] = $this->dorsal;
        return json_encode($miJSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}

class Entrenador extends Deportista{
    public int $inicioEntrenador;

    public function __construct()
    {
        
    }
}

$mensajes = "Mensajes";

if (isset($_REQUEST['Enviar'])) {
    $identidad = $_REQUEST['texto'];
    $edad = $_REQUEST['entero'];
    $sexo = $_REQUEST['booleano'];
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen1306</title>
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
            <nav class="d-flex mb-3">
                <label for="texto" class="w-50">Identidad</label>
                <input type="text" name="texto" id="texto" class="w-50" required>
            </nav>
            <nav class="d-flex mb-3">
                <label for="edad" class="w-50">Edad</label>
                <input type="number" name="edad" id="edad" class="w-50" required>
            </nav>
            <hr class="bg-danger p-1">
            <nav class="d-flex mb-3">
                <label for="sexo" class="w-50">Sexo:</label>
                <select name="sexo" id="sexo" class="w-50">
                    <option value="" selected></option>
                    <option value="1">Masculino</option>
                    <option value="0">Femenino</option>
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