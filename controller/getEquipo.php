<?php

    require '../includes/conexion.php';
    include 'funciones.php';

    $data = [];
    $content = "";

    $sqlEquiposA = "SELECT id_equipo, nombre FROM marioswe_torneo_soisa.equipo WHERE categoria = 'A' ORDER BY nombre ASC";
    $queryEquiposA = mysqli_query($cnx, $sqlEquiposA);

    $content .= '<option value="">Seleccionar</option>';
    $content .= '<option value="" disabled>- Categoría A -</option>';

    while ($arrEquiposA = mysqli_fetch_array($queryEquiposA)) {

        $id_equipoA = $arrEquiposA['id_equipo'];
        $nombreA = $arrEquiposA['nombre'];

        $content .= '<option value="'.$id_equipoA.'">'.$nombreA.'</option>';
    }

    $sqlEquiposB = "SELECT id_equipo, nombre FROM marioswe_torneo_soisa.equipo WHERE categoria = 'B' ORDER BY nombre ASC";
    $queryEquiposB = mysqli_query($cnx, $sqlEquiposB);

    $content .= '<option value="" disabled>- Categoría B -</option>';

    while ($arrEquiposB = mysqli_fetch_array($queryEquiposB)) {

        $id_equipoB = $arrEquiposB['id_equipo'];
        $nombreB = $arrEquiposB['nombre'];

        $content .= '<option value="'.$id_equipoB.'">'.$nombreB.'</option>';
    }

    $sqlEquiposV = "SELECT id_equipo, nombre FROM marioswe_torneo_soisa.equipo WHERE categoria = 'V' ORDER BY nombre ASC";
    $queryEquiposV = mysqli_query($cnx, $sqlEquiposV);

    $content .= '<option value="" disabled>- Categoría VARONIL -</option>';

    while ($arrEquiposV = mysqli_fetch_array($queryEquiposV)) {

        $id_equipoV = $arrEquiposV['id_equipo'];
        $nombreV = $arrEquiposV['nombre'];

        $content .= '<option value="'.$id_equipoV.'">'.$nombreV.'</option>';
    }

    $data['content'] = $content;

    echo json_encode($data);

    $cnx->Close();

?>