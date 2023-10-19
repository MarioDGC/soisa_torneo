<?php

    require '../includes/conexion.php';
    include 'funciones.php';

    $data = [];
    $contentA = "";
    $contentB = "";


    $sqlCatA = "SELECT nombre, partidos_jugados, partidos_ganados, partidos_perdidos, puntos FROM equipo WHERE categoria = 'A' ORDER BY puntos DESC";
    $queryCatA = mysqli_query($cnx, $sqlCatA);

    while ($arrCatA = mysqli_fetch_array($queryCatA)) {
        $equipoCatA = $arrCatA['nombre'];
        $pjA = $arrCatA['partidos_jugados'];
        $pgA = $arrCatA['partidos_ganados'];
        $ppA = $arrCatA['partidos_perdidos'];
        $puntosCatA = $arrCatA['puntos'];
        $contentA .= '<div class="row">';
        $contentA .= '<div class="col-sm-12">';
        $contentA .= '<div class="row justify-content-center">';
        $contentA .= '<div class="col-5">'.$equipoCatA.'</div>';
        $contentA .= '<div class="col-1">'.$pjA.'</div>';
        $contentA .= '<div class="col-1">'.$pgA.'</div>';
        $contentA .= '<div class="col-1">'.$ppA.'</div>';
        $contentA .= '<div class="col-1">'.$puntosCatA.'</div>';
        $contentA .= '</div>';
        $contentA .= '</div>';
        $contentA .= '</div>';
    }

    $data['contentCatA'] = $contentA;

    $sqlCatB = "SELECT nombre, partidos_jugados, partidos_ganados, partidos_perdidos, puntos FROM equipo WHERE categoria = 'B' ORDER BY puntos";
    $queryCatB = mysqli_query($cnx, $sqlCatB);

    while ($arrCatB = mysqli_fetch_array($queryCatB)) {
        $equipoCatB = $arrCatB['nombre'];
        $pjB = $arrCatB['partidos_jugados'];
        $pgB = $arrCatB['partidos_ganados'];
        $ppB = $arrCatB['partidos_perdidos'];
        $puntosCatB = $arrCatB['puntos'];
        $contentB .= '<div class="row">';
        $contentB .= '<div class="col-sm-12">';
        $contentB .= '<div class="row justify-content-center">';
        $contentB .= '<div class="col-5">'.$equipoCatB.'</div>';
        $contentB .= '<div class="col-1">'.$pjB.'</div>';
        $contentB .= '<div class="col-1">'.$pgB.'</div>';
        $contentB .= '<div class="col-1">'.$ppB.'</div>';
        $contentB .= '<div class="col-1">'.$puntosCatB.'</div>';
        $contentB .= '</div>';
        $contentB .= '</div>';
        $contentB .= '</div>';
    }

    $data['contentCatB'] = $contentB;

    echo json_encode($data);

    $cnx->Close();


?>