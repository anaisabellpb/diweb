<?php
// Clase Reloj Digital
class RelojDigital {
    private $hora;

    // Constructor que obtiene la hora actual
    public function __construct() {
        $this->hora = new DateTime();  // Establece la hora actual
    }

    // Método para obtener la hora en formato HH:MM:SS
    public function obtenerHora() {
        return $this->hora->format('H:i:s');  // Formato de 24 horas
    }

    // Método para actualizar la hora (esto se llamaría si se quisiera actualizar manualmente)
    public function actualizarHora() {
        $this->hora = new DateTime();  // Actualiza la hora
    }
}

// Crear un objeto de la clase RelojDigital
$reloj = new RelojDigital();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reloj Digital en PHP</title>
</head>
<body>
    <h1>Reloj Digital</h1>
    <p>Hora actual: <?php echo $reloj->obtenerHora(); ?></p> <!-- Muestra la hora actual -->
    <p><small>Recarga la página para actualizar la hora.</small></p> <!-- Instrucciones -->

</body>
</html>
