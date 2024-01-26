<?php

    require '../includes/conexion.php';
    include 'funciones.php';

    $data = [];
    $content = "";

    $categorita = array('A', 'B', 'V');

    $content .= '<option value="">Seleccionar</option>';

    foreach ($categoria as $cat) {

        $sqlEquipos = "SELECT id_equipo, nombre FROM marioswe_torneo_soisa.equipo WHERE categoria = '$cat' ORDER BY nombre ASC";
        $queryEquipos = mysqli_query($cnx, $sqlEquipos);

        $content .= '<option value="" disabled>- Categoría '.$cat.' -</option>';

        while ($arrEquipos = mysqli_fetch_array($queryEquipos)) {

            $id_equipo = $arrEquipos['id_equipo'];
            $nombre = $arrEquipos['nombre'];

            $content .= '<option value="'.$id_equipo.'">'.$nombre.'</option>';
        }
    }


    $data['content'] = $content;

    echo json_encode($data);

    $cnx->Close();

?>