<?php
$nroEjercicio = 3;
include "../2header.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Error</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5 mb-3">Solicitud NO válida</h2>
                    <div class="alert alert-danger">Lo sentimos, ha realizado una solicitud no válida. Por favor <a href="index.php" class="alert-link">Regresar</a> e intenta de nuevo.</div>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
