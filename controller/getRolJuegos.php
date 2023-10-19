<?php

    require '../includes/conexion.php';
    include 'funciones.php';

    $data = [];
    $content = "";

    $sqlEnfrentamiento = "SELECT en.id_enfrentamiento, en.id_equipo_1, en.id_equipo_2, eq.categoria, en.fecha, j.hora
                        FROM enfrentamiento en, equipo eq, juego j
                        WHERE en.jugado = 0
                        AND en.id_juego > 0
                        AND eq.id_equipo = en.id_equipo_1
                        AND en.id_juego = j.id_juego
                        ORDER BY hora ASC";
    $queryEnfrentamiento = mysqli_query($cnx, $sqlEnfrentamiento);

    while ($arrEnfrentamiento = mysqli_fetch_array($queryEnfrentamiento)) {

        $id_enfrentamiento = $arrEnfrentamiento['id_enfrentamiento'];
        $id_equipo_1 = $arrEnfrentamiento['id_equipo_1'];
        $nombre_equipo1 = getNombreEquipo($id_equipo_1);
        $id_equipo_2 = $arrEnfrentamiento['id_equipo_2'];
        $nombre_equipo2 = getNombreEquipo($id_equipo_2);
        $categoria = $arrEnfrentamiento['categoria'];
        $fecha = $arrEnfrentamiento['fecha'];
        $fecha_objeto = new DateTime($fecha);
        $fecha_formateada = date('l j \d\e F', $fecha_objeto->getTimestamp());
        $fecha_formateada = formato_fechaESP($fecha_formateada);
        $hora = date("g:i a", strtotime($arrEnfrentamiento['hora']));

        $content .= '<div class="row justify-content-center juego-rolado mx-1 my-2 rounded-lg">';
        $content .= '<div class="col-12 text-center">';
        $content .= '<p class="mb-0 pb-0"><b><span class="fecha-juego">'.$fecha_formateada.' '.$hora.'</span></b>';
        $content .= '</p>';
        $content .= '</div>';
        $content .= '<div class="col-12 text-center">';
        $content .= '<p class="mb-0 pb-0"><span class="equipos-juego">'.$nombre_equipo1.' vs '.$nombre_equipo2.' </span></p>';
        $content .= '</div>';
        $content .= '</div>';
    }

    $data['content'] = $content;

    echo json_encode($data);

    $cnx->Close();

?>