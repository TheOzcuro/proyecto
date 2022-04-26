<?php 
include_once("control/c_index.php");
$noticia=Get();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="vista/css/index.css">
    <title>UNEARTE</title>
</head>
<body>
    <div class="grid-container">
        <div class="header">
        <img src="vista/css/img/logo_unearte.png" alt="">
            <ul class="nav">
                <a href="#mision" id="mision"><li>Mision</li><div class="test"></div></a>
                <a href="#vision" id="vision"><li>Vision</li><div class="test"></div></a>
                <a href="#sobren" id="sobren"><li>Sobre Nosotros</li><div class="test-1"></div></a>
                <a href="#noticias" id="noticias"><li>Noticias</li><div class="test-1"></div></a>
                <a href="vista/login.php" class="login"><li>Iniciar Sesion</li><div class="test-1"></div></a>
            </ul>
        </div>
        <div class="content">
            <p class="parrafo">
            <img src="vista/css/img/mision.png" alt="" class="imgtitle">    
            La UNEARTE es un espacio de discusión y reflexión permanente sobre la construcción, renovación y desarrollo de las artes así como de las culturas de nuestros pueblos. Es una universidad abierta a todas las corrientes de pensamiento, así como al legado y transmisión de las tradiciones latinoamericanas, caribeñas y universales. Reconocida por la formación integral de humanistas con vocación, sensibilidad artística y social, que considera la intuición y la emoción como factores inseparables del artista, capaz de responder a los grandes cambios socio-históricos y culturales del siglo XXI y de coadyuvar en la construcción de una sociedad regida por los principios de una democracia protagónica, participativa, inclusiva, multiétnica y pluricultural.</p>
            <p class="parrafo">
            <img src="vista/css/img/vision.png" alt="" class="imgtitle">    
            UNEARTE, a partir de los valores de nuestra cultura, está destinada a formar profesionales en el campo artístico, humanistas críticos, comprometidos con el país, creativos, participativos y protagónicos, sensibles ante los procesos de transformación social, capaces de enfrentar, desde el terreno artístico, los nuevos retos y cambios históricos, a través de una construcción colectiva, transdisciplinaria, democrática y de diálogo de saberes que involucre a la comunidad universitaria y a todos los actores sociales, para hacer de la educación y el arte hechos sociales transformadores, con énfasis en la creación intelectual y cultural, el poder popular y la visión geoestratégica del desarrollo territorial.</p>
            <p class="parrafo">
            <img src="vista/css/img/nosotros.png" alt="" class="imgtitle">
            La Universidad Nacional Experimental de las Artes (UNEARTE) es una universidad pública de Venezuela, co-tutelada por el Ministerio del Poder Popular para la Educación Universitaria (MPPEU) junto con el Ministerio del Poder Popular para la Cultura (MinCultura) de la República Bolivariana de Venezuela.

            Cuenta con siete Centros de Estudios y Creación Artística signados por los nombres de ejemplares creadoras y creadores venezolanos como Aquiles Nazoa, Modesta Bor, Armando Reverón, Jacobo Borges (Museo Universitario - Museo Escuela), Candelario Aray y Argimiro Gabaldón, y próceres venezolanos como Santiago Mariño.
            </p>
        </div>
        <div class="container-noticia"><h2>Ultimas Noticias</h2>
            <?php
            if (count($noticia)>0) {
                for ($i=0; $i < count($noticia); $i++) { 
                    echo "<div class='noticia'>".$noticia[$i][0];
                    echo "<p>Fecha de Publicacion: ".$noticia[$i][1]."</p>";
                    echo "</div>";
                }
            }
            else {
                echo "<div>No existen noticias actuales</div>";
            }
            ?>

        </div>
        <!--<div class="footer"></div>-->
    </div>

</body>
<script src="vista/js/index.js"></script>
</html>