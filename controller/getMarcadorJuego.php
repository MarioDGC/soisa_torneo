<?php

    require '../includes/conexion.php';
    include 'funciones.php';

    $data = [];
    $content = "";
    $idEnfrentamiento = $_POST['IdEnfrentamiento'];
    $idEquipoIzq = $_POST['IdEquipoIzq'];
    $idEquipoDer = $_POST['IdEquipoDer'];

    $sets_jugados = 0;
    $set1 = false;
    $set2 = false;
    $set3 = false;

    //
    $sqlMarcador = "SELECT id_equipo_1, id_equipo_2,
                    equipo_1_set_1, equipo_2_set_1, equipo_1_set_2, equipo_2_set_2, equipo_1_set_3, equipo_2_set_3
                    FROM enfrentamiento
                    WHERE id_enfrentamiento = $idEnfrentamiento";
    $queryMarcador = mysqli_query($cnx, $sqlMarcador);

    if ($queryMarcador) {

        $arrMarcador = mysqli_fetch_array($queryMarcador);
        $idEquipo1 = $arrMarcador['id_equipo_1'];
        $idEquipo2 = $arrMarcador['id_equipo_2'];
        $equipo1_set1 = $arrMarcador['equipo_1_set_1'];
        $equipo2_set1 = $arrMarcador['equipo_2_set_1'];
        $equipo1_set2 = $arrMarcador['equipo_1_set_2'];
        $equipo2_set2 = $arrMarcador['equipo_2_set_2'];
        $equipo1_set3 = $arrMarcador['equipo_1_set_3'];
        $equipo2_set3 = $arrMarcador['equipo_2_set_3'];

        // consultar en cuál número de set van
        if ($equipo1_set3 == 0 && $equipo2_set3 == 0) {
            if ($equipo1_set2 == 0 && $equipo2_set2 == 0) {
                $sets_jugados = 1;
            } else {
                $sets_jugados = 2;
            }
        } else {
            $sets_jugados = 3;
        }

        if ($idEquipoIzq != $idEquipo1) {
            $equipo2_set1 = $arrMarcador['equipo_1_set_1'];
            $equipo1_set1 = $arrMarcador['equipo_2_set_1'];
            $equipo2_set2 = $arrMarcador['equipo_1_set_2'];
            $equipo1_set2 = $arrMarcador['equipo_2_set_2'];
            $equipo2_set3 = $arrMarcador['equipo_1_set_3'];
            $equipo1_set3 = $arrMarcador['equipo_2_set_3'];
        }

        $data['puntosEquipoIzq_set1'] = $equipo1_set1;
        $data['puntosEquipoDer_set1'] = $equipo2_set1;
        $data['puntosEquipoIzq_set2'] = $equipo1_set2;
        $data['puntosEquipoDer_set2'] = $equipo2_set2;
        $data['puntosEquipoIzq_set3'] = $equipo1_set3;
        $data['puntosEquipoDer_set3'] = $equipo2_set3;
        $data['sets_jugados'] = $sets_jugados;
        $data['status'] = 'ok';

    } else {
        $data['status'] = 'err: '.$cnx->error;
    }

    $cnx->Close();

    echo json_encode($data);


?>