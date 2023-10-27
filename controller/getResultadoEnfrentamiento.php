<?php

    require '../includes/conexion.php';
    include 'funciones.php';

    $data = [];
    $content = "";

    // echo json_encode($data);

    $sqlEnfrentamiento = "SELECT e.id_enfrentamiento, e.id_equipo_1, e1.nombre as nombre_1, e.id_equipo_2, e2.nombre as nombre_2, e.jugado,
                        e.equipo_1_set_1, e.equipo_2_set_1, e.equipo_1_set_2, e.equipo_2_set_2, e.equipo_1_set_3, e.equipo_2_set_3,
                        e.id_equipo_ganador, e.id_juego, e.fecha, e.jornada
                        FROM enfrentamiento e, equipo e1, equipo e2
                        WHERE jugado = 1
                        AND e.id_equipo_1 = e1.id_equipo
                        AND e.id_equipo_2 = e2.id_equipo
                        ORDER BY fecha DESC, id_juego DESC";
    $queryEnfrentamiento = mysqli_query($cnx, $sqlEnfrentamiento);

    while ($arrEnfrentamiento = mysqli_fetch_array($queryEnfrentamiento)) {
        $id_enfrentamiento = $arrEnfrentamiento['id_enfrentamiento'];
        $id_equipo_1 = $arrEnfrentamiento['id_equipo_1'];
        $nombre_1 = $arrEnfrentamiento['nombre_1'];
        $id_equipo_2 = $arrEnfrentamiento['id_equipo_2'];
        $nombre_2 = $arrEnfrentamiento['nombre_2'];
        $jugado = $arrEnfrentamiento['jugado'];
        $equipo_1_set_1 = $arrEnfrentamiento['equipo_1_set_1'];
        $equipo_2_set_1 = $arrEnfrentamiento['equipo_2_set_1'];
        $equipo_1_set_2 = $arrEnfrentamiento['equipo_1_set_2'];
        $equipo_2_set_2 = $arrEnfrentamiento['equipo_2_set_2'];
        $equipo_1_set_3 = $arrEnfrentamiento['equipo_1_set_3'];
        $equipo_2_set_3 = $arrEnfrentamiento['equipo_2_set_3'];
        $id_equipo_ganador = $arrEnfrentamiento['id_equipo_ganador'];
        $id_juego = $arrEnfrentamiento['id_juego'];
        $fecha = $arrEnfrentamiento['fecha'];
        $fecha_objeto = new DateTime($fecha);
        $fecha_formateada = date('l j \d\e F', $fecha_objeto->getTimestamp());
        $fecha_formateada = formato_fechaESP($fecha_formateada);
        $jornada = $arrEnfrentamiento['jornada'];

        $sets_equipo_1 = 0;
        $sets_equipo_2 = 0;

        if ($equipo_1_set_1 > $equipo_2_set_1) {
            $sets_equipo_1++;
        } else {
            $sets_equipo_2++;
        }

        if ($equipo_1_set_2 > $equipo_2_set_2) {
            $sets_equipo_1++;
        } else {
            $sets_equipo_2++;
        }

        if ($equipo_1_set_3 > $equipo_2_set_3) {
            $sets_equipo_1++;
        } else if($equipo_2_set_3 > 0) {
            $sets_equipo_2++;
        }

        $content .= '<div class="row justify-content-center my-3" data-id-enfrentamiento="'.$id_enfrentamiento.'">';
        $content .= '<div class="col-11 text-center resultado-partido rounded-lg py-2">';
        $content .= '<div class="row justify-content-center">';
        $content .= '<div class="col-12 text-center">'.$fecha_formateada.'</div>';
        $content .= '</div>';
        $content .= '<div class="row justify-content-center px-3 no-gutters">';
        $content .= '<div class="col-12 text-center py-0 my-0">';
        $content .= '<p id="" class="mb-0 py-0"><b>'.$sets_equipo_1.' &nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp; '.$sets_equipo_2.'</b></p>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '<div class="row justify-content-center px-3">';
        $content .= '<div class="col-5 text-center trapezoid-left bg-info py-0 my-0">';
        $content .= '<p id="" class="resultado-equipo mb-0 py-1" data-id-equipo-1="'.$id_equipo_1.'">'.$nombre_1.'</p>';
        $content .= '</div>';
        $content .= '<div class="col-2 text-center bg-dark py-0 m-0">';
        $content .= '<b>';
        $content .= '<p id="" class="mb-0 py-1">VS</p>';
        $content .= '</b>';
        $content .= '</div>';
        $content .= '<div class="col-5 text-center trapezoid-right bg-info py-0 my-0">';
        $content .= '<p id="" class="resultado-equipo mb-0 py-1" data-id-equipo-2="'.$id_equipo_2.'">'.$nombre_2.'</p>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '<div class="row justify-content-center">';
        $content .= '<div class="col-12 text-center">';
        $content .= '<p id="" class="py-0 my-0">'.$equipo_1_set_1.'-'.$equipo_2_set_1.' | '.$equipo_1_set_2.'-'.$equipo_2_set_2;
        $content .= ($equipo_1_set_3 > 0 || $equipo_2_set_3 > 0) ? ' | '.$equipo_1_set_3.'-'.$equipo_2_set_3.'</p>' : '</p>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '<div class="row justify-content-center">';
        $content .= '<div class="col-12 text-center">';
        $content .= '<p id="" class="py-0 my-0 text-warning">Jornada '.$jornada.'</p>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';
        $content .= '</div>';

    }

    $data['content'] = $content;

    echo json_encode($data);

    $cnx->Close();

?>