<html lang="en">

<head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/png" href="img/image-removebg-preview.png" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Raleway:wght@200&display=swap" />
    <title>Vinos De La Villa</title>
    <!-- Estilos -->
    <link rel="stylesheet" href="css/Global.css" />
    <link rel="stylesheet" href="css/Hamburguer.css" />
    <link rel="stylesheet" href="css/Header.css" />
    <link rel="stylesheet" href="css/Products.css" />
    <link rel="stylesheet" href="css/Slider.css" />

</head>

<body>
    <header class="main-header">
        <div class="container container--flex">
            <br>
            <div class="main-header__container">
                <img src="img/image-removebg-preview.png" alt="" class="logo">
                <div class="centrado1">
                    <h1 class="main-header__title">LOS VINOS</h1>
                    <h2 class="main-header__subtitle"><i>Tienda Gourmet</i></h2>
                    <strong>
                        <h3 class="main-header-subsubtitle">Carrera 9 11 47 Segundo piso de La Galleta</h3>
                    </strong>
                    <br>
                    <div class="main-header__container">
                        <p class="main-header__txt">CONTACTANOS (+57) 3219085857 <em class="fas fa-phone"></em></p>
                    </div>
                </div>
                <div class="icono-menu">
                    <img src="img/bars-solid.svg" id="icono-menu">
                </div>
                <div class="cont-menu active" id="menu">
                    <ul>
                        <a href="index.html">
                            <li> Home </li>
                        </a>
                        <a href="">
                            <li> Sepas </li>
                        </a>
                    </ul>
                </div>
            </div>
            <br>
        </div>
        <div class="main-header__container">
            <input type="search" class="main-header__input" placeholder="Que Producto Deseas Buscar? ">
            <em class="fas fa-search" id="lupa
            "></em>
            <div>
                <!-- falta agregar boton de carrito -->
            </div>
        </div>
    </header>
    <div class="main" style="padding-bottom: 0px;">
        <div class="container">
            <?php
            require 'functions.php';
            //<!-- empiezan las tarjetas -->
            tarjetas(1);
            tarjetas(2);
            tarjetas(3);

            ?>
        </div>
        <div class="testimonials">
            <div class="container_testimonials">
                <h2 class="section_title">DESCUBRE UN POCO DE NOSOTROS</h2>
                <h3 class="testimonial_title">SOMOS VINOS DE LA VILLA</h3>
                <br>
                <p class="testimonial_txt">Estamos ubicados en Villa De Leyba boyaca
                    Carrera 9 11 47 Segundo piso de La Galleta, Villa de Leyva ,Boyaca, Colombia</p>
                <br>
                <p class="testimonial_txt"> lugar para los amantes del vino. Vino por copa desde COP$8000 Botellas
                    desde COP$27.900 Amplio surtido en vinos de:
                    Colombia, España, Italia, Francia, Chile, Argentina, California
                    para acompañar: Tapas, Panini, tablas de quesos y jamones. Buena musica. Ambiente agradable.</p>
                <br>
                <p class="testimonial_txt"> Poseemos deferentes servicios como :Bar de vinos, Bar, Española, Pub
                    tambien podemos ofrecer servicio de restarurante como :Cena, Abierto hasta tarde(revisar horario
                    segun corresponda ), Bebidas</p>
                <br>
                <p class="testimonial_txt"> OTRAS CARACTERÍSTICAS
                    Comodos Asientos, Brindaos el fino alcohol, Wi-Fi gratis, Acepta tarjetas de crédito, Servicio de
                    mesa, Reservas, Acceso para silla de ruedas, Vino y cerveza</p>
                HORARIOS DE ATENCION :
                <br>
                dom
                12:00 p. m. - 10:00 p. m.
                <br>
                lun
                3:00 p. m. - 10:00 p. m.
                <br>
                mar
                3:00 p. m. - 10:00 p. m.
                <br>
                mié
                3:00 p. m. - 10:00 p. m.
                <br>
                jue
                3:00 p. m. - 10:00 p. m.
                <br>
                vie
                12:00 p. m. - 12:00 a. m.
                <br>
                sáb
                12:00 p. m. - 12:00 a. m.
                </p>
            </div>
            <div class="container-editor">
                <div class="editor_item">
                    <img src="img/pexels-payam-masouri-731348.jpg" alt="" class="editor_img">
                    <p class="editor_circle">SOPORTE </p>
                </div>
                <div class="editor_item">
                    <img src="img/pexels-grape-things-2647933.jpg" alt="" class="editor_img">
                    <p class="editor_circle">SERVICIO AL CLINETE </p>
                </div>
            </div>
            <div class="container-tips">
                <div class="tip">
                    <em class="far fa-hand-paper"></em>
                    <h2 class="tip_title">DUEÑO</h2>
                    <p class="tip_txt">DIEGO Y COMPAÑIA S.A.S
                    <P>
                        NIT 890309454-8
                    </P>
                    <p>
                        KRA 9 # 11-47 P.2
                    </p>
                    <a href="" class="btn_shop">contacto </a>
                    </p>
                </div>
                <div class="tip">
                    <em class="fas fa-rocket"></em>
                    <h2 class="tip_title">Gerente General</h2>
                    <p class="tip_txt">
                    <p>
                        NUBIA VELASCO
                    </p>
                    <P>
                        KRA 9 # 11-47 P.2
                    </P>
                    <P>
                        Telefono : 3219085857
                    </P>
                    <P>
                        Correo Electronico: ventas@vinosdelavilla.com
                    </P>
                    </p>
                    <a href="" class="btn_shop">contacto </a>
                </div>
            </div>
        </div>
        <footer class="main-footer">
            <div class="footer_section">
                <h2 class="footer_title">UBICACION :</h2>
                <p class="footer_txt"> Carrera 9 11 47 Segundo piso de La Galleta, a unos pasos de la plaza principal
                    de Villa de Leyva ,Boyaca, Colombia</p>
            </div>
            <div class="footer_section">
                <h2 class="footer_title">Links</h2>
                <p class="footer_txt"><a href="">HOME</a></p>
            </div>
        </footer>
        <script src="js/slider.js"></script>
        <script src="js/hamburguer.js"></script>
    </div>
</body>