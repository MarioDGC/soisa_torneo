<?php
// include ('../../lib/coneccion.php');
include ('funciones.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <script src="js/jquery-3.7.1.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <link rel="stylesheet" href="css/styles.css?v=<?php echo time();?>">

    <title>Test</title>

</head>

<body>

    <div class="col-11">
        <div class="row justify-content-around align-items-center mb-3 mt-5">
            <div class="col-1 border border-dark rounded text-center px-0 py-1"><span>00</span></div>
            <div class="col-1 border border-dark rounded text-center px-0 py-1 bg-warning"><span>01</span></div>
            <div class="col-1 border border-dark rounded text-center px-0 py-1"><span>02</span></div>
            <div class="col-1 border border-dark rounded text-center px-0 py-1"><span>03</span></div>
            <div class="col-1 border border-dark rounded text-center px-0 py-1 bg-warning"><span>04</span></div>
            <div class="col-1 border border-dark rounded text-center px-0 py-1"><span>05</span></div>
            <div class="col-1 border border-dark rounded text-center px-0 py-1"><span>06</span></div>
        </div>
        <div class="row justify-content-around align-items-center mb-3">
            <div class="col-1 border border-dark rounded text-center px-0 py-1 bg-warning"><span>07</span></div>
            <div class="col-1 border border-dark rounded text-center px-0 py-1"><span>08</span></div>
            <div class="col-1 border border-dark rounded text-center px-0 py-1"><span>09</span></div>
            <div class="col-1 border border-dark rounded text-center px-0 py-1"><span>10</span></div>
            <div class="col-1 border border-dark rounded text-center px-0 py-1"><span>11</span></div>
            <div class="col-1 border border-dark rounded text-center px-0 py-1 bg-warning"><span>12</span></div>
            <div class="col-1 border border-dark rounded text-center px-0 py-1 bg-warning"><span>13</span></div>
        </div>
        <div class="row justify-content-around align-items-center mb-3">
            <div class="col-1 border border-dark rounded text-center px-0 py-1"><span>14</span></div>
            <div class="col-1 border border-dark rounded text-center px-0 py-1"><span>15</span></div>
            <div class="col-1 border border-dark rounded text-center px-0 py-1 bg-warning"><span>16</span></div>
            <div class="col-1 border border-dark rounded text-center px-0 py-1 bg-warning"><span>17</span></div>
            <div class="col-1 border border-dark rounded text-center px-0 py-1 bg-warning"><span>18</span></div>
            <div class="col-1 border border-dark rounded text-center px-0 py-1"><span>19</span></div>
            <div class="col-1 border border-dark rounded text-center px-0 py-1"><span>20</span></div>
        </div>
        <div class="row justify-content-around align-items-center mb-3">
            <div class="col-1 border border-dark rounded text-center px-0 py-1"><span>00</span></div>
            <div class="col-1 border border-dark rounded text-center px-0 py-1"><span>01</span></div>
            <div class="col-1 border border-dark rounded text-center px-0 py-1 bg-warning"><span>02</span></div>
            <div class="col-1 border border-dark rounded text-center px-0 py-1"><span>03</span></div>
            <div class="col-1 border border-dark rounded text-center px-0 py-1"><span>04</span></div>
            <div class="col-1 border border-dark rounded text-center px-0 py-1"><span>04</span></div>
            <div class="col-1 border border-dark rounded text-center px-0 py-1"><span>04</span></div>
        </div>
        <div class="row justify-content-around align-items-center mb-3">
            <div class="col-1 border border-dark rounded text-center px-0 py-1"><span>00</span></div>
            <div class="col-1 border border-dark rounded text-center px-0 py-1"><span>01</span></div>
            <div class="col-1 border border-dark rounded text-center px-0 py-1"><span>02</span></div>
            <div class="col-1 border border-dark rounded text-center px-0 py-1"><span>03</span></div>
            <div class="col-1 border border-dark rounded text-center px-0 py-1"><span>04</span></div>
            <div class="col-1 border border-dark rounded text-center px-0 py-1"><span>04</span></div>
            <div class="col-1 border border-dark rounded text-center px-0 py-1"><span>04</span></div>
        </div>
        <div class="row justify-content-around align-items-center mb-3">
            <div class="col-1 border border-dark rounded text-center px-0 py-1 bg-warning"><span>00</span></div>
            <div class="col-1 border border-dark rounded text-center px-0 py-1"><span>01</span></div>
            <div class="col-1 border border-dark rounded text-center px-0 py-1"><span>02</span></div>
            <div class="col-1 border border-dark rounded text-center px-0 py-1 bg-warning"><span>03</span></div>
            <div class="col-1 border border-dark rounded text-center px-0 py-1"><span>04</span></div>
            <div class="col-1 border border-dark rounded text-center px-0 py-1"><span>04</span></div>
            <div class="col-1 border border-dark rounded text-center px-0 py-1"><span>04</span></div>
        </div>
        <div class="row justify-content-around align-items-center mb-3">
            <div class="col-1 border border-dark rounded text-center px-0 py-1 bg-warning"><span>00</span></div>
            <div class="col-1 border border-dark rounded text-center px-0 py-1"><span>01</span></div>
            <div class="col-1 border border-dark rounded text-center px-0 py-1"><span>02</span></div>
            <div class="col-1 border border-dark rounded text-center px-0 py-1"><span>03</span></div>
            <div class="col-1 border border-dark rounded text-center px-0 py-1 bg-warning"><span>04</span></div>
            <div class="col-1 border border-dark rounded text-center px-0 py-1 bg-warning"><span>04</span></div>
            <div class="col-1 border border-dark rounded text-center px-0 py-1"><span>04</span></div>
        </div>
        <div class="row justify-content-around align-items-center mb-3">
            <div class="col-1 border border-dark rounded text-center px-0 py-1"><span>01</span></div>
        </div>
    </div>

    <script type="text/javascript" src="js/funciones.js?v=<?php echo rand();?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>