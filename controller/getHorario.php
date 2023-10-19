<?php

    require '../includes/conexion.php';
    include 'funciones.php';

    $data = [];
    $content = "";


    $sqlJuego = "SELECT id_juego, hora FROM juego";
    $queryJuego = mysqli_query($cnx, $sqlJuego);

    $content .= '<option value="" selected>Horario</option>';

    while ($arrJuego = mysqli_fetch_array($queryJuego)) {
        $id_juego = $arrJuego['id_juego'];
        $hora = date("g:i a", strtotime($arrJuego['hora']));
        // $hora_12_horas = date("g:i a", strtotime($hora_24_horas));

        $content .= '<option value="'.$id_juego.'">'.$hora.'</option>';

    }

    $data['content'] = $content;

    echo json_encode($data);

    $cnx->Close();

?>