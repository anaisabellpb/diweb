<!--para probar un archivo PHP debemos poner en el buscador: http://localhost/Curso/PHP/Ejemplo_00_plantilla.php-->
<?php/*para una inyección de php*/
/*Recogemos datos del formulario*/
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plantilla Formulario</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <script src="bootstrap.bundle.min.js"></script>
</head>
<body>
    <header>
        <p class="alert alert-primary m-3 w-50">Mensaje</p>
    </header>
<form action="#" method="post" class="m-3 shadow-lg">
    <label for="usuario" class="form-label">Usuario</label>
    <input type="text" name="usuario" id="usuario" class="form-control w-50"><br>
    <hr class="border border-primary border-5 w w-50">
    <button type="submit" class="btn btn-success">Enviar</button>
  </form> 
</body>
</html>