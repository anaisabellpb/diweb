<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>El Corte Inglés</title>

    <!--<link href="https://fonts.googleapis.com/css?family=Kalam" rel="stylesheet">-->

    <link href="IMG/grupo-eci.ico" rel="shortcut icon"><!--icono que sale en la pestaña del buscador-->

    <link rel="stylesheet" href="bootstrap.min.css">
    <script src="bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="CSS.css" rel="stylesheet">

</head>
<body>
    <header>
        <!--APP-->
        <section aria-label="app">
            <p>descarga aquí nuestra <a href="#"><span>&nbsp;app</span></a></p>
        </section>
        <div class="header-content">
            <!-- Logo Corte Inglés -->
            <figure class="logo-container">
                <a href="#"><img src="IMG/logo_corte_ingles-removebg-preview.png" width="200" alt="Logo"></a>
            </figure>
            <!-- Formulario de búsqueda -->
            <nav role="search">
                <form action="#" method="get">
                    <label for="buscar" class="search"></label>
                    <input type="text" name="buscar" id="buscar" placeholder="¿Qué estás buscando?"
                        aria-label="iniciar búsqueda">
                    <button type="submit"><img src="IMG/lupa_buscador.png" alt="lupa_buscador" width="26">
                    </button>
                </form>
            </nav>
            <!-- Iconos laterales -->
            <aside class="icon-container">
                <a href="#"><img src="IMG/usuario.png" width="20" alt="Usuario"></a>
                <a href="#"><img src="IMG/me-gusta.png" width="27" alt="Favoritos"></a>
                <a href="#"><img src="IMG/bolsa-de-la-compra.png" width="28" alt="Carrito"></a>
            </aside>
        </div>
        <nav aria-label="categorías principales">
            <ul class="categorias-lista">
                <li><a href="https://www.elcorteingles.es/moda-mujer/"><span>Moda mujer</span></a></li>
                <li><a href="https://www.elcorteingles.es/deportes/"><span>Deportes</span></a></li>
                <li><a href="https://www.elcorteingles.es/electronica/"><span>Electrónica</span></a></li>
                <li><a href="https://www.elcorteingles.es/hogar/"><span>Hogar</span></a></li>
                <li><a href="https://n9.cl/0ozga"><span>Supermercado</span></a></li>
            </ul>
        </nav>
    </header>
    <!--Banner-->
  <!-- Banner con Carousel de Bootstrap -->
<main>
    <section aria-label="gallery" class="carousel-section">
        <div id="carouselIndicators" class="carousel slide" data-bs-ride="carousel">
            <ol class="carousel-indicators d-none">
                <li data-bs-target="#carouselIndicators" data-bs-slide-to="0" class="active"></li>
                <li data-bs-target="#carouselIndicators" data-bs-slide-to="1"></li>
                <li data-bs-target="#carouselIndicators" data-bs-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="IMG/feliz2025_home_VID_P_1_.jpg" class="d-block w-100" alt="feliz">
                    <div class="carousel-caption d-none d-md-block">
                        <p class="pri-text">hasta el 5 de enero la magia de regalar</p>
                        <p class="primary-text">feliz 2025 | hasta -40%</p>
                        <p class="secundary-text"><a href="#" class="btn btn-light custom-link">Ver ofertas</a></p>

                    </div>
                </div>
                <div class="carousel-item">
                    <img src="IMG/niños.jpg" class="d-block w-100" alt="Imagen 2">
                    <div class="carousel-caption d-none d-md-block">
                        <p class="tertiary-text">una aventura de navidad en la planta 2 1/2</p>
                        <p class="quaternary-text"><a href="#" class="btn btn-light custom-link">Descubre nuestro spot</a></p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="IMG/comida.jpg" class="d-block w-100" alt="Imagen 3">
                    <div class="carousel-caption d-none d-md-block">
                        <p class="quin-text">platos preparados</p>
                        <p class="quintenary-text">esta navidad cocinamos por ti</p>
                        <p class="sextary-text"><a href="#" class="btn btn-light custom-link">Descubre más</a></p>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselIndicators" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselIndicators" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </a>
        </div>
    </section>
</main><br><br>

        <!-- Categorías -->
        <section aria-label="categorias" class="category-section">
            <h2>categorías</h2>
            <table>
                <thead>
                    <tr>
                        <td><a href="https://www.elcorteingles.es/moda-mujer/"><img src="IMG/img1.png" alt="mujer"
                                    width="180"></a></td>
                        <td><a href="https://www.elcorteingles.es/moda-hombre/"><img src="IMG/img2.png" alt="hombre"
                                    width="180"></a></td>
                        <td><a href="https://www.elcorteingles.es/moda-infantil/"><img src="IMG/img3.png" alt="infantil"
                                    width="180"></a></td>
                        <td><a href="https://www.elcorteingles.es/hogar/"><img src="IMG/img4.png" alt="hogar"
                                    width="180"></a></td>
                        <td><a href="https://www.elcorteingles.es/deportes/"><img src="IMG/img5.png" alt="deportes"
                                    width="180"></a></td>
                        <td><a href="https://www.elcorteingles.es/electronica/"><img src="IMG/img6.png"
                                    alt="electronica" width="180"></a></td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>moda mujer</td>
                        <td>moda hombre</td>
                        <td>moda infantil</td>
                        <td>hogar</td>
                        <td>deportes</td>
                        <td>electrónica</td>
                    </tr>
                </tbody>
            </table>
            <!-- Botones abajo -->
            <section aria-label="servicios" class="service-buttons">
                <ul class="bt-verde">
                    <li><img src="IMG/plus.jpg" alt="plus" width="25"><a href="#">El Corte Inglés Plus</a></li>
                    <li><img src="IMG/enviogratis.jpg" alt="gratis" width="25"><a href="#">Recogida en tienda
                            <span>gratis</span></a></li>
                    <li><img src="IMG/domicilio.jpg" alt="domicilio" width="25"><a href="#">Envío a domicilio</a></li>
                    <li><img src="IMG/devolucion.jpg" alt="devolución" width="25"><a href="#">Devolución
                            <span>gratis</span> en tienda</a></li>
                    <li><img src="IMG/click.jpg" alt="click" width="25"><a href="#"><span>Click & Car</span></a></li>
                    <li><img src="IMG/24h.jpg" alt="24h" width="25"><a href="#">Recogida en el día</a></li>
                </ul>
            </section><br><br>
            <!-- zona banner verde-->
            <section aria-label="descuento-especial" class="especial-tiendas">
                <p class="text-span"><span>Nuestras tiendas</span></p>
                <p class="text-span">Vive experiencias únicas</p>
            </section>
            <!-- Tiendas -->
            <section class="contenedor-tiendas" aria-label="tiendas">
                <article class="tienda">
                    <figure>
                        <img src="IMG/estudio.jpeg" alt="Silla" />
                        <figcaption>Studio</figcaption>
                    </figure>
                    <p>Haz realidad tus ideas. Podemos convertir tu casa en el hogar de tus sueños.</p>
                    <p><a href="#">Reserva tu cita</a></p>
                </article>
                <article class="tienda">
                    <figure>
                        <img src="IMG/shooper.jpeg" alt="vestido rojo" />
                        <figcaption>Personal Shopper</figcaption>
                    </figure>
                    <p>El mejor servicio de asesoramiento personalizado posible en nuestro espacio.</p>
                    <p><a href="#">Reserva tu cita</a></p>
                </article>
                <article class="tienda">
                    <figure>
                        <img src="IMG/electronica.jpg" alt="Tienda de tecnología" />
                        <figcaption>Electrónica. Callao, Madrid</figcaption>
                    </figure>
                    <p>Las mejores marcas y tecnología al alcance de tu mano.</p>
                    <p><a href="#">Descubre más</a></p>
                </article>
                <article class="tienda">
                    <figure>
                        <img src="IMG/cultura.jpeg" alt="Librería" />
                        <figcaption>Cultura y Ocio. Callao, Madrid</figcaption>
                    </figure>
                    <p>Sumérgete en nuestro nuevo espacio de cultura y ocio. Entretenimiento para todos los gustos.</p>
                    <p><a href="#">Descubre más</a></p>
                </article>
            </section>
            <!--registro perfil-->
            <hr>
            <section class="newsletter">
                <img src="IMG/mi_cuenta-removebg-preview.png" width="200" alt="">
                <h2>Registrate, crea <span>tu cuenta</span></h2>
                <a href="registro.php" class="btn btn-dark w-100 text-center">CREAR UNA CUENTA</a>
                <p>¿Ya tienes una cuenta?<a href="login.php">INICIAR SESIÓN</a></p>
            </section>
            <br>
            <!--Pie de página-->
            <footer class="footer">
                <div class="legal">
                    <p><img src="IMG/grupo-eci.ico" width="30" alt="grupo-eci.ico">&copy; 1940-2025 El Corte Inglés S.A.
                        Todos los derechos reservados.</p>
                    <ul>
                        <li><a href="#">Condiciones de uso</a></li>
                        <li><a href="#">Política de privacidad</a></li>
                        <li><a href="#">Política de Cookies</a></li>
                    </ul>
                </div>
            </footer>       
</body>

</html>