<?php

function getNombreEquipo ($id_equipo) {

    $cnx = $GLOBALS['cnx'];

    $sqlNombre = "SELECT nombre FROM equipo WHERE id_equipo = $id_equipo";
    $queryNombre = mysqli_query($cnx, $sqlNombre);
    $arrNombre = mysqli_fetch_array($queryNombre);
    $nombre = $arrNombre['nombre'];

    return $nombre;
}

function get_nombre($id_equipo) {

    $cnx = $GLOBALS['cnx'];
    $sqlnombre = "SELECT nombre
                    FROM equipo
                    WHERE id_equipo = $id_equipo";
    $querynombre = mysqli_query($cnx, $sqlnombre);
    $arrnombre = mysqli_fetch_array($querynombre);

    $nombre = acentostohtmlentities($arrnombre['nombre']);
    return $nombre;

}

function acentostohtmlentities($cadena) {
    $search = array('á','é','í','ó','ú','ñ','Á','É','Í','Ó','Ú','Ñ');
    $replace = array('&aacute;','&eacute;','&iacute;','&oacute;','&uacute;','&ntilde;','&AACUTE;','&EACUTE;','&IACUTE;','&OACUTE;','&UACUTE;','&NTILDE;');

    $cadena = str_replace($search,$replace,$cadena);

    return $cadena;
}

function formato_fechaESP($cadena) {
    $search = array('Monday','Tuesday','Wednesday','Thursday','Friday','October');
    $replace = array('Lunes','Martes','Miércoles','Jueves','Viernes','Octubre');

    $cadena = str_replace($search,$replace,$cadena);

    return $cadena;
}

?>