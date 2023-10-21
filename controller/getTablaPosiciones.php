<?php

    require '../includes/conexion.php';
    include 'funciones.php';

    $data = [];
    $contentA = "";

    // Obtener puntos a favor y en contra de cada equipo
    // $sqlIdEquipo = "SELECT id_equipo FROM equipo";
    // $queryIdEquipo = mysqli_query($cnx, $sqlIdEquipo);
    // while ($arrIdEquipo = mysqli_fetch_array($queryIdEquipo)) {
    //     $afavor = 0;
    //     $encontra = 0;
    //     $id_equipo = $arrIdEquipo['id_equipo'];
    //     $sqlPtsFavor = "SELECT SUM(equipo_1_set_1 + equipo_1_set_2 + equipo_1_set_3) as afavor,
    //                     SUM(equipo_2_set_1 + equipo_2_set_2 + equipo_2_set_3) as encontra
    //                     FROM enfrentamiento
    //                     WHERE id_equipo_1 = $id_equipo";
    //     $queryPtsFavor = mysqli_query($cnx, $sqlPtsFavor);
    //     $arrPtsFavor = mysqli_fetch_array($queryPtsFavor);
    //     $afavor += $arrPtsFavor['afavor'];
    //     $encontra += $arrPtsFavor['encontra'];

    //     $sqlPtsFavor = "SELECT SUM(equipo_2_set_1 + equipo_2_set_2 + equipo_2_set_3) as afavor,
    //                     SUM(equipo_1_set_1 + equipo_1_set_2 + equipo_1_set_3) as encontra
    //                     FROM enfrentamiento
    //                     WHERE id_equipo_2 = $id_equipo";
    //     $queryPtsFavor = mysqli_query($cnx, $sqlPtsFavor);
    //     $arrPtsFavor = mysqli_fetch_array($queryPtsFavor);
    //     $afavor += $arrPtsFavor['afavor'];
    //     $encontra += $arrPtsFavor['encontra'];
    //     echo "$id_equipo , AF:$afavor *** EC:$encontra<br>";

    // }


    // Obtener sets ganados y perdidos de cada equipo
    // $sqlIdEquipo = "SELECT id_equipo FROM equipo";
    // $queryIdEquipo = mysqli_query($cnx, $sqlIdEquipo);
    // while ($arrIdEquipo = mysqli_fetch_array($queryIdEquipo)) {
    //     $setsGanados = 0;
    //     $setsPerdidos = 0;
    //     $id_equipo = $arrIdEquipo['id_equipo'];
    //     $sqlPtsFavor = "SELECT SUM(if(equipo_1_set_1 > equipo_2_set_1, 1,0) + if(equipo_1_set_2 > equipo_2_set_2, 1,0) + if(equipo_1_set_3 > equipo_2_set_3, 1,0)) as sets_ganados,
    //                     SUM(if(equipo_1_set_1 < equipo_2_set_1, 1,0) + if(equipo_1_set_2 < equipo_2_set_2, 1,0) + if(equipo_1_set_3 < equipo_2_set_3, 1,0)) as sets_perdidos
    //                     FROM enfrentamiento
    //                     WHERE id_equipo_1 = $id_equipo";
    //     $queryPtsFavor = mysqli_query($cnx, $sqlPtsFavor);
    //     $arrPtsFavor = mysqli_fetch_array($queryPtsFavor);
    //     $setsGanados += $arrPtsFavor['sets_ganados'];
    //     $setsPerdidos += $arrPtsFavor['sets_perdidos'];

    //     $sqlPtsFavor = "SELECT SUM(if(equipo_2_set_1 > equipo_1_set_1, 1,0) + if(equipo_2_set_2 > equipo_1_set_2, 1,0) + if(equipo_2_set_3 > equipo_1_set_3, 1,0)) as sets_ganados,
    //                     SUM(if(equipo_2_set_1 < equipo_1_set_1, 1,0) + if(equipo_2_set_2 < equipo_1_set_2, 1,0) + if(equipo_2_set_3 < equipo_1_set_3, 1,0)) as sets_perdidos
    //                     FROM enfrentamiento
    //                     WHERE id_equipo_2 = $id_equipo";
    //     $queryPtsFavor = mysqli_query($cnx, $sqlPtsFavor);
    //     $arrPtsFavor = mysqli_fetch_array($queryPtsFavor);
    //     $setsGanados += $arrPtsFavor['sets_ganados'];
    //     $setsPerdidos += $arrPtsFavor['sets_perdidos'];
    //     echo "$id_equipo , SG:$setsGanados *** SP:$setsPerdidos<br>";

    // }

    // die;


    /* Reglas de posicionamiento
    1 Mayor número de Juegos Jugados (JJ) DESC
    2 Mayor número de Juegos Ganados (JG) DESC
    3 Mayor número de Sets Ganados (SG) DESC
    4 Menor número de Sets Perdidos (SP) ASC
    5 Mayor Diferencia de Sets (DS) - ganados menos perdidos - DESC
    6 Mayor número de Diferencia de Puntos (DP) DESC



    */
    $sqlCatA = "SELECT nombre, categoria, partidos_jugados, partidos_ganados, partidos_perdidos, puntos_favor, puntos_contra, (puntos_favor - puntos_contra) as dif_puntos, puntos
                FROM equipo
                ORDER BY partidos_jugados DESC, partidos_ganados DESC, dif_puntos DESC";
    $queryCatA = mysqli_query($cnx, $sqlCatA);

    $counter = 1;
    while ($arrCatA = mysqli_fetch_array($queryCatA)) {
        $equipoCatA = $arrCatA['nombre'];
        $pjA = $arrCatA['partidos_jugados'];
        $cat = $arrCatA['categoria'];
        $pgA = $arrCatA['partidos_ganados'];
        $ppA = $arrCatA['partidos_perdidos'];
        $pfA = $arrCatA['puntos_favor'];
        $pcA = $arrCatA['puntos_contra'];
        $dpA = $arrCatA['dif_puntos'];
        $puntosCatA = $arrCatA['puntos'];

        $contentA .= '<tr>';
        $contentA .= '<td>'.$counter.' '.$equipoCatA.'</td>';
        $contentA .= '<td class="text-center">'.$pjA.'</td>';
        $contentA .= '<td class="text-center">'.$pgA.'</td>';
        $contentA .= '<td class="text-center">'.$ppA.'</td>';
        $contentA .= '<td class="text-center">'.$pfA.'</td>';
        $contentA .= '<td class="text-center">'.$pcA.'</td>';
        $contentA .= '<td class="text-center">'.$dpA.'</td>';
        $contentA .= '<td class="text-center">'.$puntosCatA.'</td>';
        $contentA .= '</tr>';

        $counter++;
    }

    $data['contentCatA'] = $contentA;

    echo json_encode($data);

    $cnx->Close();


?>