<?php
require("errores.php");
$mensaje = "Mensajes"; 

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

class Empleado
{
    public string $nombre = "";
    private float $salarioBase = 0.0;

    public function __construct(string $nombre, float $salarioBase)
    {
        $this->nombre = $nombre;
        $this->setSalarioBase($salarioBase);
    }

    public function __toString(): string
    {
        return json_encode([
            'Nombre' => $this->nombre,
            'Salario Base' => $this->salarioBase
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function setsalarioBase(float $salarioBase): void
    {
        if ($salarioBase > 0) {
            $this->salarioBase = $salarioBase;
        }
    }

     public function getsalarioBase (): float {
        return $this->salarioBase;
     }
}

class EmpTiempoCompleto extends Empleado
{
    public int $horasExtra;

    public function __construct(string $nombre, float $salarioBase, int $horasExtra) 
    {
        parent::__construct($nombre, $salarioBase);
        $this->horasExtra = $horasExtra;
    }

    // Sobrescribir el método __toString()de triangulo para mostrar la información como JSON
    public function __toString(): string
    {
        $miJSON = json_decode(parent::__toString(), true);
        $miJSON['Horas Extra'] = $this->horasExtra;

        return json_encode($miJSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // Método para calcular el área del triángulo
    public function calcularSalario(): string
    {
        return "El Total es: " . ($this->salarioBase + $this->horasExtra) * 20;
    }
}


class EmpTiempoParcial extends Empleado
{ // atributo propio 
    public int $horasTrabajadas;

    public function __construct(string $nombre, float $salarioBase, int $horasTrabajadas) 
    {
        parent::__construct($nombre, $salarioBase);
        $this->horasTrabajadas = $horasTrabajadas;
    }

   
    public function __toString(): string
    {
        $miJSON = json_decode(parent::__toString(), true);
        $miJSON['Horas Trabajadas'] = $this->horasTrabajadas;

        return json_encode($miJSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // Método para calcular el área del triángulo
    public function calcularSalario(): string
    {
        return "El Total es: " . ($this->salarioBase * $this->horasTrabajadas);
    }
}

// Script principal
if (isset($_REQUEST['solucion'])) {
   
    $empleadoTiempoCompleto1 = new EmpTiempoCompleto ('Jose',1000, 20); 
    $empTiempoParcial1 = new EmpTiempoParcial('Alba',900, 30);
    $mensaje .= "<br> Empleado Completo <br>" . $empleadoTiempoCompleto1;
    $mensaje .= "<br> " . $empleadoTiempoCompleto1->calcularSalario();
    $mensaje .= "<br> Empleado Parcial <br>" . $empTiempoParcial1;
    $mensaje .= "<br> " . $EmpTiempoParcial1->calcularSalario();
}
?>
<!--HTML-->
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Examen MF0951</title>
    <link rel="stylesheet" href="bootstrap.min.css">
</head>

<body>
    <section aria-label="alerta" class="alert alert-success m-3 p-3 mb-4 w-50">
        <pre class="mb-0"><?php echo $mensaje; ?></pre>
    </section>
    <section aria-label="volumenes" class="m-3 p-3 w-50 bg-info text-white">
        <form action="#" method="post">
            <!--<nav class="d-flex mb-3">
                <label for="a" class="w-50">Base</label>
                <input type="number" name="a" id="a" class="w-50" min="1" required>
            </nav>
            <nav class="d-flex mb-3">
                <label for="h" class="w-50">Altura</label>
                <input type="number" name="h" id="h" class="w-50" min="1" required>
            </nav><br>
            <label for="figura" class="form-label">Elige Figura:</label><br>
            <select name="figura" id="figura" class="form-control">
                <option value="triangulo">Triángulo</option>
                <option value="rectangulo">Rectángulo</option>
            </select><br>-->

            <button type="submit" name="solucion" class="btn btn-success">Ver solución</button>
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