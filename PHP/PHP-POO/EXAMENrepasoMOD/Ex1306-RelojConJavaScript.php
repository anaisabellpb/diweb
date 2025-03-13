<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reloj Digital</title>
    <style>
        /* Estilos para el reloj */
        #reloj {
            font-family: 'Arial', sans-serif;
            font-size: 50px;
            font-weight: bold;
            color: #000;
            background-color: #f1f1f1;
            width: 300px;
            padding: 20px;
            text-align: center;
            border-radius: 10px;
            margin: 50px auto;
        }
    </style>
</head>
<body>
    <div id="reloj">
        <!-- Aquí se mostrará la hora -->
        <span id="hora"></span>
    </div>

    <script>
        // Función para actualizar la hora cada segundo
        function actualizarReloj() {
            var fecha = new Date();  // Obtener la fecha y hora actual
            var horas = fecha.getHours().toString().padStart(2, '0');  // Obtener las horas, con 2 dígitos
            var minutos = fecha.getMinutes().toString().padStart(2, '0');  // Obtener los minutos, con 2 dígitos
            var segundos = fecha.getSeconds().toString().padStart(2, '0');  // Obtener los segundos, con 2 dígitos

            // Mostrar la hora en formato HH:MM:SS
            document.getElementById('hora').textContent = horas + ':' + minutos + ':' + segundos;
        }

        // Actualizar la hora cada segundo
        setInterval(actualizarReloj, 1000);
        
        // Llamamos a la función una vez para que inicie el reloj de inmediato
        actualizarReloj();
    </script>
</body>
</html>
