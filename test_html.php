<?php
// include ('../../lib/coneccion.php');
include ('funciones.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <script src="js/jquery-3.7.1.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <link rel="stylesheet" href="css/styles.css?v=<?php echo time();?>">

    <title>Test</title>

    <style>

        body {
            background-image: linear-gradient(rgba(255,255,255, 0.75), rgba(255,255,255, 0.75)), url('https://marketplace.canva.com/EAFKmk8ad1Q/1/0/900w/canva-beige-and-green-aesthetic-boho-watercolor-leaves-phone-wallpaper-qmYKeK8cth8.jpg');
            background-repeat: no-repeat;
            /* deja fijo el fondo */
            background-attachment: fixed;
            /* posiciona la imagen al centro de la ventana */
            background-position: center center;
            /* ocupa toda la ventana */
            background-size: cover;
            /* Asegura que el body ocupe al menos todo el alto de la ventana del navegador */
            min-height: 100vh;
            /* Establece el margen a 0 para eliminar los espacios por defecto alrededor del borde de la página */
            margin: 0;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Cormorant SC', serif;
        }


        .h1, .h2, .h3, .h4, .h5, .h6 {
            font-family: 'Cormorant SC', serif;
        }

        .tachado {
            text-decoration: line-through;
        }

        .info-rifa {
            background-color: rgba(255, 234, 201, 0.85);
        }
    </style>

</head>

<body>

    <div class="container">

        <div class="row h1 justify-content-center mt-5">
            <div class="col-12 text-center">
                <p>RIFA DE JOYERÍA NICE</p>
            </div>
        </div>

        <div class="row justify-content-center mt-2">
            <div class="col-8 text-center">
                <img src="img/img_123.webp" class="img-fluid rounded" alt="Conjunto de joyería">
            </div>
        </div>

        <!-- <div class="row justify-content-center rounded-pill info-rifa mt-4">
            <div class="col-auto text-center">
                <p class="py-0 my-2">4 BAÑOS DE ORO 18 KIL</p>
            </div>
        </div> -->

        <div class="row justify-content-center rounded-pill info-rifa mt-4">
            <div class="col-8 text-center">
                <p class="py-0 my-2">4 BAÑOS DE ORO 18 KIL</p>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-11">

            <?php

                $cont = 0;

                for ($i=0; $i < 10; $i++) {

                    if ($i == 0){
                        echo "<div class='row justify-content-around align-items-center mb-3 mt-5'>";
                    } else if ($i == 9) {
                        echo "<div class='row justify-content-around align-items-center mb-3 mb-5'>";
                    } else {
                        echo "<div class='row justify-content-around align-items-center mb-3'>";
                    }

                    for ($j=0; $j <5 ; $j++) {
                        if ($cont % 3 == 0) {
                            $used_number = "tachado text-danger";
                        } else {
                            $used_number = "";
                        }

                        echo "<div class='col-auto border $used_number border-dark rounded text-center py-1'><span>".str_pad($cont, 2, "0", STR_PAD_LEFT)."</span></div>";
                        $cont++;
                    }
                    # code...
                    echo "</div>";

                }
            ?>

        </div>
    </div>

    <script type="text/javascript" src="js/funciones.js?v=<?php echo rand();?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>