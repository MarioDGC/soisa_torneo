<?php

    require '../includes/conexion.php';
    include 'funciones.php';

    $accion = $_POST['accion'];

    $data = [];
    $content = "";

    switch ($accion) {
        case 'rolar':
            rolar();
            break;
        case 'enfrentar':
            enfrentar();
            break;
        case 'terminar':
            terminar();
            break;
    }

    echo json_encode($data);

    $cnx->Close();

    function rolar() {

        global $data;
        $cnx = $GLOBALS['cnx'];
        $idEnfrentamiento = $_POST['idEnfrentamiento'];
        $fecha = $_POST['fecha'];
        $horario = $_POST['horario'];

        $sqlVerificacion = "SELECT id_enfrentamiento
                            FROM enfrentamiento
                            WHERE id_juego = $horario
                            AND fecha = '$fecha'";
        $queryVerificacion = mysqli_query($cnx, $sqlVerificacion);

        $rowsVerificacion = mysqli_num_rows($queryVerificacion);

        if ($rowsVerificacion > 0) {
            $data['result'] = 'ocupado';
        } else {

            $updEnfrentamiento = "UPDATE enfrentamiento SET id_juego = $horario, fecha = '$fecha' WHERE id_enfrentamiento = $idEnfrentamiento";

            if (!mysqli_query($cnx, $updEnfrentamiento)) {
                $data['result'] = 'err: '.$cnx->error;
                console.log(__LINE__.'::'.$cnx->error);
            } else {
                $data['result'] = 'ok';
            }
        }

        return $data;

    }

    function enfrentar() {

        global $data;
        $cnx = $GLOBALS['cnx'];
        $idEquipo1 = $_POST['idEquipo1'];
        $idEquipo2 = $_POST['idEquipo2'];

        $insEnfrentamiento = "INSERT INTO enfrentamiento(id_equipo_1,id_equipo_2) VALUES($idEquipo1,$idEquipo2)";

        if (!mysqli_query($cnx, $insEnfrentamiento)) {
            $data['result'] = 'err: '.$cnx->error;
            console.log(__LINE__.'::'.$cnx->error);
        } else {
            $data['result'] = 'ok';
        }

        return $data;

    }

    function terminar() {
        global $data;
        $cnx = $GLOBALS['cnx'];

        /* obtener id del enfrentamiento
        sets_enfrentamiento → si es = 2 sumar 3 puntos en la tabla al ganador, si fue en 3 sets sumar 2 puntos solamente
        array_equipoIzq y arr_equipoDer que contiene el json

        Obtener de obj_equipoIzq el idEquipoIzq y comprobar en bdd en la tbl de enfrentamiento si la columna de

        accion: 'terminar',
        id_ganador: id_ganador,
        sets_enfrentamiento: sets_enfrentamiento,
        idEnfrentamiento: idEnfrentamiento,
        obj_equipoIzq: obj_equipoIzq,
        obj_equipoDer: obj_equipoDer,
        */

        $id_ganador = $_POST['id_ganador'];
        $sets_enfrentamiento = $_POST['sets_enfrentamiento'];
        $idEnfrentamiento = $_POST['idEnfrentamiento'];
        $obj_equipoIzq = $_POST['obj_equipoIzq'];
        $obj_equipoDer = $_POST['obj_equipoDer'];

        // si el juego se gana en 2 set, el equipo ganador suma 3 puntos a la tabla, si se gana en 3 sets, el equipo ganador suma 2 puntos
        if ($sets_enfrentamiento == 2) {
            $puntos_en_tabla = 2;
        } else {
            $puntos_en_tabla = 1;
        }

        $idEquipoIzq = $obj_equipoIzq['idEquipoIzq'];
        $idEquipoDer = $obj_equipoDer['idEquipoDer'];

        $sql1Equipo1 = "SELECT id_equipo_1 FROM enfrentamiento WHERE id_enfrentamiento = $idEnfrentamiento";
        $query1Equipo1 = mysqli_query($cnx, $sql1Equipo1);
        $rows1Equipo1 = mysqli_num_rows($query1Equipo1);

        if ($rows1Equipo1 > 0) {

            $arrnombre = mysqli_fetch_array($query1Equipo1);
            $id_equipo1_sql = $arrnombre['id_equipo_1'];

            // comprobar si el $idEquipoIzq esta registrado en la tabla de enfrentamientos en la columna de id_equipo_1 o id_equipo_2
            if ($idEquipoIzq == $id_equipo1_sql) {
                // El obj_equipoIzq es el equipo 1
                $arr_equipo1 = $obj_equipoIzq;
                $arr_equipo2 = $obj_equipoDer;

                $idEquipo1 = $arr_equipo1['idEquipoIzq'];
                $set1Equipo1 = $arr_equipo1['resultSet1EquipoIzq'];
                $set2Equipo1 = $arr_equipo1['resultSet2EquipoIzq'];
                $set3Equipo1 = $arr_equipo1['resultSet3EquipoIzq'];
                $puntosTotalesEquipo1 = $arr_equipo1['puntosTotalesEquipoIzq'];

                $idEquipo2 = $arr_equipo2['idEquipoDer'];
                $set1Equipo2 = $arr_equipo2['resultSet1EquipoDer'];
                $set2Equipo2 = $arr_equipo2['resultSet2EquipoDer'];
                $set3Equipo2 = $arr_equipo2['resultSet3EquipoDer'];
                $puntosTotalesEquipo2 = $arr_equipo2['puntosTotalesEquipoDer'];

            } else {
                // El obj_equipoDer es el equipo 1
                $arr_equipo1 = $obj_equipoDer;
                $arr_equipo2 = $obj_equipoIzq;

                $idEquipo1 = $arr_equipo1['idEquipoDer'];
                $set1Equipo1 = $arr_equipo1['resultSet1EquipoDer'];
                $set2Equipo1 = $arr_equipo1['resultSet2EquipoDer'];
                $set3Equipo1 = $arr_equipo1['resultSet3EquipoDer'];
                $puntosTotalesEquipo1 = $arr_equipo1['puntosTotalesEquipoDer'];

                $idEquipo2 = $arr_equipo2['idEquipoIzq'];
                $set1Equipo2 = $arr_equipo2['resultSet1EquipoIzq'];
                $set2Equipo2 = $arr_equipo2['resultSet2EquipoIzq'];
                $set3Equipo2 = $arr_equipo2['resultSet3EquipoIzq'];
                $puntosTotalesEquipo2 = $arr_equipo2['puntosTotalesEquipoIzq'];

            }


            // INICIO DE TRANSACCION
            mysqli_begin_transaction($cnx, MYSQLI_TRANS_START_READ_WRITE);
            $result_transaccion = true;

            $updEnfrentamiento = "UPDATE enfrentamiento
                                SET id_equipo_1 = $idEquipo1,
                                id_equipo_2 = $idEquipo2,
                                jugado = 1,
                                equipo_1_set_1 = $set1Equipo1,
                                equipo_2_set_1 = $set1Equipo2,
                                equipo_1_set_2 = $set2Equipo1,
                                equipo_2_set_2 = $set2Equipo2,
                                equipo_1_set_3 = $set3Equipo1,
                                equipo_2_set_3 = $set3Equipo2,
                                id_equipo_ganador = $id_ganador
                                WHERE id_enfrentamiento = $idEnfrentamiento";

            if (mysqli_query($cnx, $updEnfrentamiento)) {

                if ($id_ganador == $idEquipo1) {
                    $sets_ganados_equipo_1 = 2;
                    $sets_perdidos_equipo_2 = 2;
                    if ($sets_enfrentamiento == 2) {
                        $sets_perdidos_equipo_1 = 0;
                        $sets_ganados_equipo_2 = 0;
                    } else {
                        $sets_perdidos_equipo_1 = 1;
                        $sets_ganados_equipo_2 = 1;
                    }
                } else {
                    $sets_ganados_equipo_2 = 2;
                    $sets_perdidos_equipo_1 = 2;
                    if ($sets_enfrentamiento == 2) {
                        $sets_perdidos_equipo_2 = 0;
                        $sets_ganados_equipo_1 = 0;
                    } else {
                        $sets_perdidos_equipo_2 = 1;
                        $sets_ganados_equipo_1 = 1;
                    }
                }

                $updEquipo1 = "UPDATE equipo SET partidos_jugados = partidos_jugados + 1,
                                partidos_ganados = partidos_ganados + IF ($id_ganador = id_equipo, 1, 0),
                                partidos_perdidos = partidos_perdidos + IF ($id_ganador != id_equipo, 1, 0),
                                puntos_favor = puntos_favor + $puntosTotalesEquipo1,
                                puntos_contra = puntos_contra + $puntosTotalesEquipo2,
                                sets_ganados = sets_ganados + $sets_ganados_equipo_1,
                                sets_perdidos = sets_perdidos + $sets_perdidos_equipo_1,
                                puntos = puntos + IF ($id_ganador = id_equipo, $puntos_en_tabla, 0)
                                WHERE id_equipo = $idEquipo1";

                $updEquipo2 = "UPDATE equipo SET partidos_jugados = partidos_jugados + 1,
                                partidos_ganados = partidos_ganados + IF ($id_ganador = id_equipo, 1, 0),
                                partidos_perdidos = partidos_perdidos + IF ($id_ganador != id_equipo, 1, 0),
                                puntos_favor = puntos_favor + $puntosTotalesEquipo2,
                                puntos_contra = puntos_contra + $puntosTotalesEquipo1,
                                sets_ganados = sets_ganados + $sets_ganados_equipo_2,
                                sets_perdidos = sets_perdidos + $sets_perdidos_equipo_2,
                                puntos = puntos + IF ($id_ganador = id_equipo, $puntos_en_tabla, 0)
                                WHERE id_equipo = $idEquipo2";

                if (mysqli_query($cnx, $updEquipo1) && mysqli_query($cnx, $updEquipo2)) {
                    $data['result'] = 'ok';
                } else {
                    $result_transaccion = false;
                    $data['result'] = 'err: '.$cnx->error;
                }

            } else {
                $result_transaccion = false;
                $data['result'] = 'err: No se pudo localizar ID del enfrentamiento. Volver a intentar.';
            }

            if ($result_transaccion) {
                mysqli_commit($cnx);
            } else {
                $cnx->rollback();
            }

        } else {
            $data['result'] = 'err: No se pudo localizar ID del enfrentamiento. Volver a intentar.';
        }


        return $data;

    }




?>