<?php
//errores.php
ini_set('display_errors',1);              // Muestra errores por pantalla
ini_set('display_startup_errors',1);      // Muestra al inicio
error_reporting(E_ALL);                   // Muestra todos los errores

ini_set('error_log','errores.log');       // Graba errores en archivo
ini_set('log_errors',1);                  // Activa el grabado errores

/*
* Comentario Multilínea
* Debemos configurar los errores a nivel de servidor:
* Consola:
* sudo nano /etc/php/8.3/cli/php.ini
* Las siguientes secciones se les quita los ; tiene que quedar así:
* ; display_errors
   Default Value: On
   Development Value: On
   Production Value: Off

; display_startup_errors
   Default Value: On
   Development Value: On
   Production Value: Off

; error_reporting
   Default Value: E_ALL
   Development Value: E_ALL
   Production Value: E_ALL & ~E_DEPRECATED & ~E_STRICT

; log_errors
   Default Value: Off
   Development Value: On
   Production Value: On

* Al final guardar y salir: CTRL + O le damos intro y luego CRTL + X
* Y por último reiniciar el apache poniendo: sudo service apache2 restart
*/

// echo $variable;
// require "miarchivo.php";
// echo "Hola clase";   este esta bien y sin embargo no lo va a ejecutar