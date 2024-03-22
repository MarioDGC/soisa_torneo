<?php
// include ('../../lib/coneccion.php');
include ('funciones.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <link rel="stylesheet" href="/sistemas/control_mp/css/bootstrap.min.css">
    <link rel="stylesheet" href="/js/datatables_bootstrap4.min.css">

    <!-- Para poder utilizar JQUERY -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

    <!-- Para poder utilizar modal (tambien necesita script de jquery-3.4.1.min.js)-->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="/js/datatables_bootstrap4.min.js"></script>

    <title>Test</title>

</head>

<body>

    <div class="container justify-content-center">
        <div class="row  justify-content-center align-items-center mt-5">
            <div class="col-1 border border-dark text-center px-2 py-2"><span>00</span></div>
            <div class="col-1 border border-dark text-center px-2 py-2"><span>01</span></div>
            <div class="col-1 border border-dark text-center px-2 py-2"><span>02</span></div>
            <div class="col-1 border border-dark text-center px-2 py-2"><span>03</span></div>
            <div class="col-1 border border-dark text-center px-2 py-2"><span>04</span></div>
            <div class="col-1 border border-dark text-center px-2 py-2"><span>05</span></div>
            <div class="col-1 border border-dark text-center px-2 py-2"><span>06</span></div>
            <div class="col-1 border border-dark text-center px-2 py-2"><span>07</span></div>
            <div class="col-1 border border-dark text-center px-2 py-2"><span>08</span></div>
            <div class="col-1 border border-dark text-center px-2 py-2"><span>09</span></div>
        </div>
        <div class="row  justify-content-center align-items-center">
            <div class="col-1 border border-dark text-center px-2 py-2"><span>00</span></div>
            <div class="col-1 border border-dark text-center px-2 py-2"><span>01</span></div>
            <div class="col-1 border border-dark text-center px-2 py-2"><span>02</span></div>
            <div class="col-1 border border-dark text-center px-2 py-2"><span>03</span></div>
            <div class="col-1 border border-dark text-center px-2 py-2"><span>04</span></div>
            <div class="col-1 border border-dark text-center px-2 py-2"><span>05</span></div>
            <div class="col-1 border border-dark text-center px-2 py-2"><span>06</span></div>
            <div class="col-1 border border-dark text-center px-2 py-2"><span>07</span></div>
            <div class="col-1 border border-dark text-center px-2 py-2"><span>08</span></div>
            <div class="col-1 border border-dark text-center px-2 py-2"><span>09</span></div>
        </div>
        <div class="row  justify-content-center align-items-center">
            <div class="col-1 border border-dark text-center px-2 py-2"><span>00</span></div>
            <div class="col-1 border border-dark text-center px-2 py-2"><span>01</span></div>
            <div class="col-1 border border-dark text-center px-2 py-2"><span>02</span></div>
            <div class="col-1 border border-dark text-center px-2 py-2"><span>03</span></div>
            <div class="col-1 border border-dark text-center px-2 py-2"><span>04</span></div>
            <div class="col-1 border border-dark text-center px-2 py-2"><span>05</span></div>
            <div class="col-1 border border-dark text-center px-2 py-2"><span>06</span></div>
            <div class="col-1 border border-dark text-center px-2 py-2"><span>07</span></div>
            <div class="col-1 border border-dark text-center px-2 py-2"><span>08</span></div>
            <div class="col-1 border border-dark text-center px-2 py-2"><span>09</span></div>
        </div>
        <div class="row  justify-content-center align-items-center">
            <div class="col-1 border border-dark text-center px-2 py-2"><span>00</span></div>
            <div class="col-1 border border-dark text-center px-2 py-2"><span>01</span></div>
            <div class="col-1 border border-dark text-center px-2 py-2"><span>02</span></div>
            <div class="col-1 border border-dark text-center px-2 py-2"><span>03</span></div>
            <div class="col-1 border border-dark text-center px-2 py-2"><span>04</span></div>
            <div class="col-1 border border-dark text-center px-2 py-2"><span>05</span></div>
            <div class="col-1 border border-dark text-center px-2 py-2"><span>06</span></div>
            <div class="col-1 border border-dark text-center px-2 py-2"><span>07</span></div>
            <div class="col-1 border border-dark text-center px-2 py-2"><span>08</span></div>
            <div class="col-1 border border-dark text-center px-2 py-2"><span>09</span></div>
        </div>
        <div class="row  justify-content-center align-items-center">
            <div class="col-1 border border-dark text-center px-2 py-2"><span>00</span></div>
            <div class="col-1 border border-dark text-center px-2 py-2"><span>01</span></div>
            <div class="col-1 border border-dark text-center px-2 py-2"><span>02</span></div>
            <div class="col-1 border border-dark text-center px-2 py-2"><span>03</span></div>
            <div class="col-1 border border-dark text-center px-2 py-2"><span>04</span></div>
            <div class="col-1 border border-dark text-center px-2 py-2"><span>05</span></div>
            <div class="col-1 border border-dark text-center px-2 py-2"><span>06</span></div>
            <div class="col-1 border border-dark text-center px-2 py-2"><span>07</span></div>
            <div class="col-1 border border-dark text-center px-2 py-2"><span>08</span></div>
            <div class="col-1 border border-dark text-center px-2 py-2"><span>09</span></div>
        </div>
    </div>


</body>
</html>