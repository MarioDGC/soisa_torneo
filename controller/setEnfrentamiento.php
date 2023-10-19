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




?>