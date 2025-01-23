<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro Usuario</title>

    <link href="https://fonts.googleapis.com/css?family=Kalam" rel="stylesheet">

    <script src="bootstrap.bundle.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap.bundle.min.js"></script>
    <link href="IMG/grupo-eci.ico" rel="shortcut icon">
    <link rel="stylesheet" href="t3.css">

</head>

<body>
    <section aria-label="fin">
        <footer>
            <section aria-label="registro">
                <!-- Imagen de formulario inscripción -->
                <img src="IMG/mi_cuenta-removebg-preview.png" width="250" alt="Mi cuenta">
                <h3>Crea una cuenta para todo El Corte Inglés</h3>
                <p>Y podrás acceder a El Corte Inglés y disfrutar también del resto de nuestras marcas y tiendas.</p>
            </section>
            <!--Formulario de inscripción-->
            <section aria-label="cuenta" class="my-5">
                <form action="#" method="post" class="border p-4 rounded shadow-sm">
                    <fieldset class="mb-4">
                        <legend class="fs-5 fw-bold">datos básicos de tu cuenta</legend>
                        <div class="mb-3">
                            <label for="email">Añade tu correo electrónico:</label><br>
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="usuario@example.com" required>
                            <small>*Este será tu identificador de cuenta.</small><br>
                        </div>
                        <div class="mb-3">
                            <label for="password">Crea una contraseña fuerte:</label><br>
                            <input type="password" id="password" name="password" class="form-control"
                                placeholder="Nueva contraseña" required>
                            <small>
                                *Tu contraseña debe tener al menos:
                                8 caracteres, 1 número, 1 minúscula, 1 mayúscula y 1 carácter especial.
                            </small>
                        </div>
                    </fieldset>
                    <!-- Datos personales -->
                    <fieldset class="mb-4">
                        <legend class="fs-5 fw-bold">datos personales</legend>
                        <div class="mb-3">
                            <label for="nombre">Nombre:</label>
                            <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="apellido">Primer apellido:</label>
                            <input type="text" id="apellido" name="apellido" class="form-control" placeholder="1º Apellido"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="apellidos">Segundo apellido (opcional):</label>
                            <input type="text" id="apellidos" name="apellidos" class="form-control"
                                placeholder="2º apellido">
                        </div>
                    </fieldset>
                    <!-- Aotónomo si o no-->
                    <fieldset class="mb-4">
                        <legend class="d-flex justify-content-between align-items-center fs-5 fw-bold">
                            soy autónomo o empresa
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id=>
                                <label class="form-check-label" for="toggleSwitch"></label>
                            </div>
                        </legend>
                        <!-- nif autonomo -->
                        <div class="mb-3">
                            <label for="text" class="form-label"></label>
                            <input type="text" class="form-control" id="text" placeholder="CIF/NIF:">
                        </div>
                    </fieldset>
                    <section aria-label="botones_inscripcion">
                        <!-- Botones -->
                        <button type="submit" class="btn btn-success">Continuar</button>
                        <button type="reset" class="btn btn-secondary">Borrar</button>
                    </section>
                </form>
            </section>
        </footer>
    </section>

</body>

</html>