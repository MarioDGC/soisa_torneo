<?php

    include '../includes/conexion.php';
    include 'funciones.php';

    $equipos_a = array();
    $equipos_b = array();

    $sqlEquiposA = "SELECT id_equipo
                    FROM equipo
                    WHERE categoria = 'A'";
    $queryEquiposA = mysqli_query($cnx, $sqlEquiposA);

    while ($arrEquiposA = mysqli_fetch_array($queryEquiposA)) {
        $equipoA = $arrEquiposA['id_equipo'];
        array_push($equipos_a, $equipoA);
    }

    /* 1 vs 2
    1 vs 3
    1 vs 4
    2 vs 3
    2 vs 4
    3 vs 4 */

    for ($i = 0; $i < count($equipos_a)-1; $i++) {

        for ($j = $i+1; $j < count($equipos_a); $j++) {
            // echo $equipos_a[$i]." vs ".$equipos_a[$j]."<br>";
            $equipo1 = $equipos_a[$i];
            $equipo2 = $equipos_a[$j];

            $insEnfrentamientosA = "INSERT INTO enfrentamiento (id_equipo_1, id_equipo_2)
                                VALUES($equipo1,$equipo2)";
            mysqli_query($cnx, $insEnfrentamientosA);

            echo "$equipo1 vs. $equipo2<br>";
        }
    }

    echo "<br>";

    $sqlEquiposB = "SELECT id_equipo
                    FROM equipo
                    WHERE categoria = 'B'";
    $queryEquiposB = mysqli_query($cnx, $sqlEquiposB);

    while ($arrEquiposB = mysqli_fetch_array($queryEquiposB)) {
        $equipoB = $arrEquiposB['id_equipo'];
        array_push($equipos_b, $equipoB);
    }

    for ($i = 0; $i < count($equipos_b)-1; $i++) {

        for ($j = $i+1; $j < count($equipos_b); $j++) {
            // echo $equipos_a[$i]." vs ".$equipos_a[$j]."<br>";
            $equipo1 = $equipos_b[$i];
            $equipo2 = $equipos_b[$j];

            $insEnfrentamientosB = "INSERT INTO enfrentamiento (id_equipo_1, id_equipo_2)
                                VALUES($equipo1,$equipo2)";
            mysqli_query($cnx, $insEnfrentamientosB);

            echo "$equipo1 vs. $equipo2<br>";
        }
    }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

</body>

</html>