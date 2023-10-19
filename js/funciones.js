$(document).ready(function () {

    let set1 = true;
    let set2 = false;
    let set3 = false;
    let segundo_tiempo_set3 = false;
    let sets_ganadoIzq;
    let sets_ganadoDer;
    let sets_enfrentamiento = 2;

    let enfrentamiento = "";
    let nombre_equipoDer = "";
    let nombre_equipoIzq = "";
    let idEquipoIzq = "";
    let idEquipoDer = "";

    let puntosEquipoIzq = 0;
    let puntosEquipoDer = 0;

    let obj_equipoIzq = {};
    let obj_equipoDer = {};

    if (document.getElementById('CatA')) {
        $.ajax({
            type: 'post',
            url: 'controller/getTablaPosiciones.php',
            dataType: 'json',
            success: function (data) {
                // if (data.status == 'ok') {
                $('#CatA').html(data.contentCatA);
                $('#CatB').html(data.contentCatB);
                // } else if (data.status == 'err') {
                //     alert('Error al obtener la tabla de posiciones');
                // }
            },
        });
    }

    if (document.getElementById('divEnfrentamientos')) {
        $.ajax({
            type: 'post',
            url: 'controller/getEnfrentamientos.php',
            dataType: 'json',
            success: function (data) {
                $('#divEnfrentamientos').html(data.content);
            },
        });
    }

    $(document).on("click", ".btn-rolar", function () {
        // document.querySelector('#elemento').getAttribute('data-valor');
        enfrentamiento = $(this).attr('data-enfrentamiento');
        nombre_equipoIzq = $(this).attr('data-nomequipo1');
        nombre_equipoDer = $(this).attr('data-nomequipo2');

        // alert(enfrentamiento);
        $('#idModRolar').modal('show');
        $('#spnEquipo1').text(nombre_equipoIzq);
        $('#spnEquipo2').text(nombre_equipoDer);

        // $('#spnEnfrentamiento').text(enfrentamiento);

        $.ajax({
            type: 'post',
            url: 'controller/getHorario.php',
            dataType: 'json',
            success: function (data) {
                $('#sHorario').html(data.content);
            },
        });
    });

    $(document).on("click", "#idRolar", function () {
        let fecha = $('#fecha').val();
        let horario = $('#sHorario').val();

        $.ajax({
            type: 'post',
            url: 'controller/setEnfrentamiento.php',
            dataType: 'json',
            data: {
                accion: 'rolar',
                idEnfrentamiento: enfrentamiento,
                fecha: fecha,
                horario: horario
            },
            success: function (data) {

                if (data.result == 'ocupado') {
                    alert('Ya existe un juego rolado en esa fecha y horario');
                } else if (data.result == 'ok') {
                    location.reload();
                } else {
                    alert('No se pudo rolar el enfrentamiento, volver a intentar');
                }

            },
        });
    });


    $('#CancRolar').click(function () {
        $('#idModRolar').modal('hide');
    });


    $('#btn-enfrentamientos').click(function () {
        window.location = 'roles.html';
    });


    $(document).on("click", ".btn-ver-juego", function () {
        enfrentamiento = $(this).attr('data-enfrentamiento');
        nombre_equipoIzq = $(this).attr('data-nomequipo1');
        nombre_equipoDer = $(this).attr('data-nomequipo2');
        idEquipoIzq = $(this).attr('data-idequipo1');
        idEquipoDer = $(this).attr('data-idequipo2');

        window.location = 'juego.html?eq1=' + nombre_equipoIzq + '&eq2=' + nombre_equipoDer + '&enfrentamiento=' + enfrentamiento + '&ideq1=' + idEquipoIzq + '&ideq2=' + idEquipoDer;

    });


    if (document.getElementById('idEquipoIzq')) {
        const queryString = window.location.search;

        const urlParams = new URLSearchParams(queryString);

        nombre_equipoIzq = urlParams.get('eq1');
        nombre_equipoDer = urlParams.get('eq2');
        idEquipoIzq = urlParams.get('ideq1');
        idEquipoDer = urlParams.get('ideq2');
        idEnfrentamiento = urlParams.get('enfrentamiento');

        document.querySelector('#idEnfrentamiento').setAttribute('data-idenfrentamiento', idEnfrentamiento);
        $('#idEquipoIzq').text(nombre_equipoIzq);
        $('#idEquipoDer').text(nombre_equipoDer);

        document.querySelector('#idEquipoIzq').setAttribute('data-idequipoizq', idEquipoIzq);
        document.querySelector('#idEquipoDer').setAttribute('data-idequipoder', idEquipoDer);

    }


    $('#sumar_eq_izq').click(function () {
        puntosEquipoIzq = puntosEquipoIzq + 1;
        $('#puntosEquipoIzq').text(puntosEquipoIzq);

        tiene_el_saqueIzq = document.querySelector('#saqueEquipoIzq').getAttribute('data-saqueequipoizq');

        if (tiene_el_saqueIzq === "false") {
            document.querySelector('#saqueEquipoIzq').innerHTML = '<img src="assets/icon/volleyball_1.png" height="16px" alt="balon"> ';
            if (document.querySelector('#saqueEquipoDer').childNodes.length > 0) {
                document.querySelector('#saqueEquipoDer').childNodes[0].remove();
            }
            document.querySelector('#saqueEquipoIzq').setAttribute('data-saqueequipoizq', 'true');
            document.querySelector('#saqueEquipoDer').setAttribute('data-saqueequipoder', 'false');
        }

        if (set3) {
            if (segundo_tiempo_set3 === false) {
                if (puntosEquipoIzq == 8) {
                    $('#cambiar_lados').click();
                    alert('Mitad de set 3. Cambio de cancha');
                }
            }
        }
    });


    $('#restar_eq_izq').click(function () {
        puntosEquipoIzq = puntosEquipoIzq - 1;
        $('#puntosEquipoIzq').text(puntosEquipoIzq);
    });


    $('#sumar_eq_der').click(function () {
        puntosEquipoDer = puntosEquipoDer + 1;
        $('#puntosEquipoDer').text(puntosEquipoDer);

        tiene_el_saqueDer = document.querySelector('#saqueEquipoDer').getAttribute('data-saqueequipoder');

        if (tiene_el_saqueDer === "false") {
            document.querySelector('#saqueEquipoDer').innerHTML = '<img src="assets/icon/volleyball_1.png" height="16px" alt="balon"> ';
            if (document.querySelector('#saqueEquipoIzq').childNodes.length > 0) {
                document.querySelector('#saqueEquipoIzq').childNodes[0].remove();
            }
            document.querySelector('#saqueEquipoDer').setAttribute('data-saqueequipoder', 'true');
            document.querySelector('#saqueEquipoIzq').setAttribute('data-saqueequipoizq', 'false');
        }

        if (set3) {
            if (segundo_tiempo_set3 === false) {
                if (puntosEquipoDer == 8) {
                    $('#cambiar_lados').click();
                    alert('Mitad de set 3. Cambio de cancha');
                }
            }
        }
    });



    $('#restar_eq_der').click(function () {
        puntosEquipoDer = puntosEquipoDer - 1;
        $('#puntosEquipoDer').text(puntosEquipoDer);
    });


    $('#cambiar_lados').click(function () {

        let nombre_equipo_izq_temp = nombre_equipoDer;
        let nombre_equipo_der_temp = nombre_equipoIzq;
        nombre_equipoIzq = nombre_equipo_izq_temp;
        nombre_equipoDer = nombre_equipo_der_temp;


        $('#idEquipoIzq').text(nombre_equipoIzq);
        document.querySelector('#idEquipoIzq').setAttribute('data-idequipoizq', idEquipoIzq);
        $('#idEquipoDer').text(nombre_equipoDer);
        document.querySelector('#idEquipoDer').setAttribute('data-idequipoder', idEquipoDer);


        let id_equipo_izq_temp = idEquipoDer;
        let id_equipo_der_temp = idEquipoIzq;
        idEquipoIzq = id_equipo_izq_temp;
        idEquipoDer = id_equipo_der_temp;


        let puntos_equipo_izq_temp = puntosEquipoDer;
        let puntos_equipo_der_temp = puntosEquipoIzq;
        puntosEquipoIzq = puntos_equipo_izq_temp;
        puntosEquipoDer = puntos_equipo_der_temp;


        $('#puntosEquipoIzq').text(puntosEquipoIzq);
        $('#puntosEquipoDer').text(puntosEquipoDer);


        // sets ganados
        let sets_ganados_equipo_izq_temp = $('#setGanadoIzq').text();
        let sets_ganados_equipo_der_temp = $('#setGanadoDer').text();
        $('#setGanadoIzq').text(sets_ganados_equipo_der_temp);
        $('#setGanadoDer').text(sets_ganados_equipo_izq_temp);


        // lado del SAQUE
        if (document.querySelector('#saqueEquipoIzq').childNodes.length > 0) {
            document.querySelector('#saqueEquipoIzq').childNodes[0].remove();
            document.querySelector('#saqueEquipoDer').innerHTML = '<img src="assets/icon/volleyball_1.png" height = "16px" alt = "balon"> ';
        }
        if (document.querySelector('#saqueEquipoDer').childNodes.length > 0) {
            document.querySelector('#saqueEquipoDer').childNodes[0].remove();
            document.querySelector('#saqueEquipoIzq').innerHTML = '<img src="assets/icon/volleyball_1.png" height = "16px" alt = "balon"> ';
        }





        // tiene_el_saqueDer = document.querySelector('#saqueEquipoDer').getAttribute('data-saqueequipoder');

        // if (tiene_el_saqueDer == "true") {
        //     if (document.querySelector('#saqueEquipoDer').childNodes.length > 0) {
        //         document.querySelector('#saqueEquipoDer').childNodes[0].remove();
        //     }
        //     document.querySelector('#saqueEquipoDer').setAttribute('data-saqueequipoder', 'false');
        //     document.querySelector('#saqueEquipoIzq').setAttribute('data-saqueequipoizq', 'true');
        //     document.querySelector('#saqueEquipoIzq').innerHTML = '<img src="assets/icon/volleyball_1.png" height="16px" alt="balon"> ';
        // }

        // tiene_el_saqueIzq = document.querySelector('#saqueEquipoIzq').getAttribute('data-saqueequipoizq');

        // if (tiene_el_saqueIzq == "true") {
        //     if (document.querySelector('#saqueEquipoIzq').childNodes.length > 0) {
        //         document.querySelector('#saqueEquipoIzq').childNodes[0].remove();
        //     }
        //     document.querySelector('#saqueEquipoIzq').setAttribute('data-saqueequipoizq', 'false');
        //     document.querySelector('#saqueEquipoDer').setAttribute('data-saqueequipoder', 'true');
        //     document.querySelector('#saqueEquipoDer').innerHTML = '<img src="assets/icon/volleyball_1.png" height="16px" alt="balon"> ';
        // }




        // resultados de sets
        // SET 1
        let result_Set1_equipo_izq_temp = $('#resultSet1EquipoIzq').text();
        let result_Set1_equipo_der_temp = $('#resultSet1EquipoDer').text();
        $('#resultSet1EquipoIzq').text(result_Set1_equipo_der_temp);
        $('#resultSet1EquipoDer').text(result_Set1_equipo_izq_temp);
        // SET 2
        let result_Set2_equipo_izq_temp = $('#resultSet2EquipoIzq').text();
        let result_Set2_equipo_der_temp = $('#resultSet2EquipoDer').text();
        $('#resultSet2EquipoIzq').text(result_Set2_equipo_der_temp);
        $('#resultSet2EquipoDer').text(result_Set2_equipo_izq_temp);
        // SET 3
        let result_Set3_equipo_izq_temp = $('#resultSet3EquipoIzq').text();
        let result_Set3_equipo_der_temp = $('#resultSet3EquipoDer').text();
        $('#resultSet3EquipoIzq').text(result_Set3_equipo_der_temp);
        $('#resultSet3EquipoDer').text(result_Set3_equipo_izq_temp);


        // Tiempos
        let has_time1_equipoIzq;
        let has_time2_equipoIzq;
        let has_time1_equipoDer;
        let has_time2_equipoDer;

        if ($('#spnTiempo1Izq').hasClass('text-success')) {
            has_time1_equipoIzq = true;
        } else {
            has_time1_equipoIzq = false;
        }

        if ($('#spnTiempo2Izq').hasClass('text-success')) {
            has_time2_equipoIzq = true;
        } else {
            has_time2_equipoIzq = false;
        }

        if ($('#spnTiempo1Der').hasClass('text-success')) {
            has_time1_equipoDer = true;
        } else {
            has_time1_equipoDer = false;
        }

        if ($('#spnTiempo2Der').hasClass('text-success')) {
            has_time2_equipoDer = true;
        } else {
            has_time2_equipoDer = false;
        }

        // var tiempo1EqIzq_temp = document.querySelector("#spnTiempo1Izq").innerHTML;
        // var tiempo2EqIzq_temp = document.querySelector("#spnTiempo2Izq").innerHTML;
        // var tiempo1EqDer_temp = document.querySelector("#spnTiempo1Der").innerHTML;
        // var tiempo2EqDer_temp = document.querySelector("#spnTiempo2Der").innerHTML;

        if (has_time1_equipoIzq) {
            $("#spnTiempo1Der").addClass("text-success");
            $("#spnTiempo1Der").removeClass("text-danger");
        } else {
            $("#spnTiempo1Der").addClass("text-danger");
            $("#spnTiempo1Der").removeClass("text-success");
        }

        if (has_time2_equipoIzq) {
            $("#spnTiempo2Der").addClass("text-success");
            $("#spnTiempo2Der").removeClass("text-danger");
        } else {
            $("#spnTiempo2Der").addClass("text-danger");
            $("#spnTiempo2Der").removeClass("text-success");
        }

        if (has_time1_equipoDer) {
            $("#spnTiempo1Izq").addClass("text-success");
            $("#spnTiempo1Izq").removeClass("text-danger");
        } else {
            $("#spnTiempo1Izq").addClass("text-danger");
            $("#spnTiempo1Izq").removeClass("text-success");
        }

        if (has_time2_equipoDer) {
            $("#spnTiempo2Izq").addClass("text-success");
            $("#spnTiempo2Izq").removeClass("text-danger");
        } else {
            $("#spnTiempo2Izq").addClass("text-danger");
            $("#spnTiempo2Izq").removeClass("text-success");
        }

        if (set3) {
            puntosEquipoIzq == 8 ? segundo_tiempo_set3 = true : null;
            puntosEquipoDer == 8 ? segundo_tiempo_set3 = true : null;
        }
        // $("#spnTiempo1Izq").toggleClass("text-danger text-success");
        // $("#spnTiempo2Izq").toggleClass("text-danger text-success");
        // $("#spnTiempo1Der").toggleClass("text-danger text-success");
        // $("#spnTiempo2Der").toggleClass("text-danger text-success");

        // has_time1_equipoIzq == true ? $('#spnTiempo1Izq').addClass('text-success') : $('#spnTiempo1Izq').addClass('text-danger');


    });

    $('.tiempo-equipo').click(function () {
        $(this).parent().toggleClass("text-danger text-success");
    });


    $(document).on("click", "#btn_ver_rol", function () {

        $('#idModVerRol').modal('show');

        $.ajax({
            type: 'post',
            url: 'controller/getRolJuegos.php',
            dataType: 'json',
            success: function (data) {
                $('#juegos_rolados_container').html(data.content);
            },
        });
    });

    $('#CerrarRol').click(function () {
        $('#idModVerRol').modal('hide');
    });

    $(document).on("click", "#btn_crear_enfrentamiento", function () {

        $('#idModCrearEnfrentamiento').modal('show');

        $.ajax({
            type: 'post',
            url: 'controller/getEquipo.php',
            dataType: 'json',
            success: function (data) {
                $('#idequipo1crearenfrentamiento').html(data.content);
                $('#idequipo2crearenfrentamiento').html(data.content);
            },
        });
    });

    $('#CancCrearEnfrentamiento').click(function () {
        $('#idModCrearEnfrentamiento').modal('hide');
    });

    $(document).on("click", "#idCrearEnfrentamiento", function () {

        let equipo1_enfrentamiento_manual = $('#idequipo1crearenfrentamiento').val();
        let equipo2_enfrentamiento_manual = $('#idequipo2crearenfrentamiento').val();

        $.ajax({
            type: 'post',
            url: 'controller/setEnfrentamiento.php',
            dataType: 'json',
            data: {
                accion: 'enfrentar',
                idEquipo1: equipo1_enfrentamiento_manual,
                idEquipo2: equipo2_enfrentamiento_manual,
            },
            success: function (data) {
                if (data.result == 'ok') {
                    alert("Enfrentamiento creado");
                    location.reload();
                } else {
                    alert("Error al crear el enfrentamiento");
                }
            },
        });
    });

    $('#ir_al_set2').click(function () {
        // set2 va a iniciar
        set2 = true;

        $('#divSet2').addClass('d-none');
        $('#divSet3').removeClass('d-none');

        $("#spnTiempo1Der").addClass("text-success");
        $("#spnTiempo1Der").removeClass("text-danger");
        $("#spnTiempo2Der").addClass("text-success");
        $("#spnTiempo2Der").removeClass("text-danger");
        $("#spnTiempo1Izq").addClass("text-success");
        $("#spnTiempo1Izq").removeClass("text-danger");
        $("#spnTiempo2Izq").addClass("text-success");
        $("#spnTiempo2Izq").removeClass("text-danger");

        if (puntosEquipoIzq > puntosEquipoDer) {
            sets_ganadoIzq = +$('#setGanadoIzq').text() + 1;
            $('#setGanadoIzq').text(sets_ganadoIzq);
        } else {
            sets_ganadoDer = +$('#setGanadoDer').text() + 1;
            $('#setGanadoDer').text(sets_ganadoDer);
        }

        $('#resultSet1EquipoIzq').text(puntosEquipoIzq);
        $('#resultSet1EquipoDer').text(puntosEquipoDer);

        puntosEquipoIzq = 0;
        $('#puntosEquipoIzq').text(puntosEquipoIzq);
        puntosEquipoDer = 0;
        $('#puntosEquipoDer').text(puntosEquipoDer);

        $('#cambiar_lados').click()

    });

    $('#ir_al_set3').click(function () {
        // set2 va a iniciar
        set3 = true;
        sets_enfrentamiento = 3;

        $('#divIrSet3').addClass('d-none');

        if (puntosEquipoIzq > puntosEquipoDer) {
            sets_ganadoIzq = +$('#setGanadoIzq').text() + 1;
            $('#setGanadoIzq').text(sets_ganadoIzq);
        } else {
            sets_ganadoDer = +$('#setGanadoDer').text() + 1;
            $('#setGanadoDer').text(sets_ganadoDer);
        }

        $('#resultSet2EquipoIzq').text(puntosEquipoIzq);
        $('#resultSet2EquipoDer').text(puntosEquipoDer);

        puntosEquipoIzq = 0;
        $('#puntosEquipoIzq').text(puntosEquipoIzq);
        puntosEquipoDer = 0;
        $('#puntosEquipoDer').text(puntosEquipoDer);



        $("#spnTiempo1Der").addClass("text-success");
        $("#spnTiempo1Der").removeClass("text-danger");
        $("#spnTiempo2Der").addClass("text-success");
        $("#spnTiempo2Der").removeClass("text-danger");
        $("#spnTiempo1Izq").addClass("text-success");
        $("#spnTiempo1Izq").removeClass("text-danger");
        $("#spnTiempo2Izq").addClass("text-success");
        $("#spnTiempo2Izq").removeClass("text-danger");
    });

    $('#finalizar_juego').click(function () {

        if (puntosEquipoIzq > puntosEquipoDer) {
            sets_ganadoIzq = +$('#setGanadoIzq').text() + 1;
            $('#setGanadoIzq').text(sets_ganadoIzq);
        } else {
            sets_ganadoDer = +$('#setGanadoDer').text() + 1;
            $('#setGanadoDer').text(sets_ganadoDer);
        }
        
        let id_ganador = sets_ganadoIzq > sets_ganadoDer ? idEquipoIzq : idEquipoDer;

        $('#resultSet3EquipoIzq').text(puntosEquipoIzq);
        $('#resultSet3EquipoDer').text(puntosEquipoDer);

        let idEnfrentamiento = document.querySelector('#idEnfrentamiento').getAttribute('data-idenfrentamiento');
        obj_equipoIzq = {
            idEquipoIzq: document.querySelector('#idEquipoIzq').getAttribute('data-idequipoizq'),
            resultSet1EquipoIzq: $('#resultSet1EquipoIzq').text(),
            resultSet2EquipoIzq: $('#resultSet2EquipoIzq').text(),
            resultSet3EquipoIzq: $('#resultSet3EquipoIzq').text(),
        };

        obj_equipoDer = {
            idEquipoDer: document.querySelector('#idEquipoDer').getAttribute('data-idequipoder'),
            resultSet1EquipoDer: $('#resultSet1EquipoDer').text(),
            resultSet2EquipoDer: $('#resultSet2EquipoDer').text(),
            resultSet3EquipoDer: $('#resultSet3EquipoDer').text(),
        };

        $.ajax({
            type: 'post',
            url: 'controller/setEnfrentamiento.php',
            dataType: 'json',
            data: {
                accion: 'terminar',
                id_ganador: id_ganador,
                sets_enfrentamiento: sets_enfrentamiento,
                idEnfrentamiento: idEnfrentamiento,
                obj_equipoIzq: obj_equipoIzq,
                obj_equipoDer: obj_equipoDer,
            },
            success: function (data) {
                if (data.status == 'ok') {
                    alert('Datos registrados con éxito');
                } else if (data.status == 'err') {
                    alert('No se pudieron registrar los datos. Volver a intentar.');
                }
            },
        });



    });

});