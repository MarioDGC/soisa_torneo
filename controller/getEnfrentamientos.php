<?php

    require '../includes/conexion.php';
    include 'funciones.php';

    $data = [];
    $content = "";

    // echo json_encode($data);

    $sqlEnfrentamiento = "SELECT en.id_enfrentamiento, en.id_equipo_1, en.id_equipo_2, eq.categoria, en.id_juego
                        FROM enfrentamiento en, equipo eq
                        WHERE en.jugado = 0
                        AND eq.id_equipo = en.id_equipo_1";
    $queryEnfrentamiento = mysqli_query($cnx, $sqlEnfrentamiento);

    while ($arrEnfrentamiento = mysqli_fetch_array($queryEnfrentamiento)) {
        $id_enfrentamiento = $arrEnfrentamiento['id_enfrentamiento'];
        $id_equipo_1 = $arrEnfrentamiento['id_equipo_1'];
        $id_equipo_2 = $arrEnfrentamiento['id_equipo_2'];
        $categoria = $arrEnfrentamiento['categoria'];
        $id_juego = $arrEnfrentamiento['id_juego'];

        $content .= '<div class="row mt-3">';
        $content .= '<div class="col-8">';
        $content .= $categoria.' | '.get_nombre($id_equipo_1).' vs '.get_nombre($id_equipo_2);
        $content .= '</div>';
        $content .= '<div class="col-4">';
        if ($id_juego) {
            $content .= '<button class="btn btn-warning btn-sm btn-ver-juego btn-block" type="button" data-enfrentamiento="'.$id_enfrentamiento.'" data-idequipo1="'.$id_equipo_1.'" data-idequipo2="'.$id_equipo_2.'" data-nomequipo1="'.get_nombre($id_equipo_1).'" data-nomequipo2="'.get_nombre($id_equipo_2).'">IR</button>';
        } else {
           $content .= '<button class="btn btn-primary btn-sm btn-rolar btn-block" type="button" data-enfrentamiento="'.$id_enfrentamiento.'" data-equipo1="'.$id_equipo_1.'" data-equipo2="'.$id_equipo_2.'" data-nomequipo1="'.get_nombre($id_equipo_1).'" data-nomequipo2="'.get_nombre($id_equipo_2).'">ROLAR</button>';
        }
        $content .= '</div>';
        $content .= '</div>';

    }

    $data['content'] = $content;

    echo json_encode($data);

    $cnx->Close();

?>