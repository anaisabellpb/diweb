<?php

require("errores.php");
$mensaje = "Mensaje";

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
            header('Location: Ex1306-medioGeom.php');
            break;
        case 'ej5':
            header('Location: Ex1306-biblioteca.php');
            break;
        default:
            # code...
            break;
    }
}


class Empleado
{
    public string $nombre = "";
    private float $salarioBase = 0.0;


    public function __construct(string $nombre, float $salarioBase)
    {
        $this->nombre = $nombre;
        $this->salarioBase = $salarioBase;
    }

    
    public function __toString(): string
    {
        return json_encode([
            'Nombre' => $this->nombre,
            'SalarioBase' => $this->salarioBase,
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function setSalariobase(float $salarioBase): void
    {
        if ($salarioBase > 0) {
            $this->salarioBase = $salarioBase;
        }
    }

    public function getSalariobase(): float
    {
        return $this->salarioBase;
    }
}

class EmpTiempoCompleto extends Empleado
{
    public int $horasExtra;

    public function __construct(
        string $nombre,

        float $salarioBase,
        int  $horasExtra,
    ) {
        parent::__construct($nombre, $salarioBase, $horasExtra);
        $this->horasExtra = $horasExtra;
    }

    public function calcularSalario(): float
    {
        return $this->getSalariobase() + $this->horasExtra * 20;
    }

    public function __toString(): string
    {
        $miJSON = json_decode(parent::__toString(), true);
        $miJSON['HorasExtra'] = $this->horasExtra;
        $miJSON['SalarioTotal'] = $this->calcularSalario();
        return json_encode($miJSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}

class EmpTiempoParcial extends Empleado
{
    public int $horasTrabajadas;

    public function __construct(
        string $nombre,

        float $salarioBase,
        int  $horasTrabajadas,
    ) {
        parent::__construct($nombre, $salarioBase, $horasTrabajadas);
        $this->horasTrabajadas = $horasTrabajadas;
    }

    public function calcularSalario(): float
    {
        return $this->getSalariobase() * $this->horasTrabajadas;
    }

    public function __toString(): string
    {
        $miJSON = json_decode(parent::__toString(), true);
        $miJSON['HorasExtra'] = $this->horasTrabajadas;
        $miJSON['SalarioTotal'] = $this->calcularSalario();
        return json_encode($miJSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }
}

if (isset($_REQUEST['solucion'])) {
    $empleado1 = new EmpTiempoCompleto('Juan',1000,10,20);
    $empleado2 = new EmpTiempoParcial('Sara',30,40);
    $mensaje .= "<br> Empleado1 <br>" . $empleado1;
    $mensaje .= "<br> " . $empleado1->calcularSalario();
    $mensaje .= "<br> Empleado2 <br>" . $empleado2;
    $mensaje .= "<br> " . $empleado2->calcularSalario();
}



?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen MF0952</title>
    <link rel="stylesheet" href="bootstrap.min.css">


</head>

<body>
    <section aria-label="alerta"
        class="alert alert-success m-3 p-3 w-50">
        <pre class="mb-0"><?php echo $mensaje; ?></pre>
    </section>

    <section aria-label="anidi" class="m-3 p-3 w-50 bg-info text-white">
        <form action="#" method="post">
            <button type="submit" name="solucion" class="btn btn-success">Ver Empleado</button>
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