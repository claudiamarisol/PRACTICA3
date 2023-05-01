<?php
$nroEjercicio = 3;
include "../2header.php";
// Verifique la existencia del parámetro id antes de continuar con el procesamiento
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    // Incluir archivo de configuración
    require_once "config.php";
   
    // Preparar una la consulta SELECT
    $sql = "SELECT * FROM employees WHERE id = :id";
   
    if($stmt = $pdo->prepare($sql)){
        // Vincular variables a la declaración preparada como parámetros
        $stmt->bindParam(":id", $param_id);
       
        // Establecer parámetros
        $param_id = trim($_GET["id"]);
       
        // Intento de ejecutar la declaración preparada
        if($stmt->execute()){
            if($stmt->rowCount() == 1){
                /* Obtenga la fila de resultados como una matriz asociativa. Dado que el conjunto de resultados
                contiene solo una fila, no necesitamos usar while loop */
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
               
                // Recuperar valor de campo individual
                $name = $row["name"];
                $address = $row["address"];
                $salary = $row["salary"];
            } else{
                // La URL no contiene un parámetro de identificación válido. Redirigir a la página de error
                header("location: error.php");
                exit();
            }
           
        } else{
            echo "¡Ups! Algo salió mal. Por favor, inténtelo de nuevo más tarde.";
        }
    }
     
    // Cerrar declaracion
    unset($stmt);
   
    // Cerrar conexion
    unset($pdo);
} else{
    // La URL no contiene el parámetro de identificación. Redirigir a la página de error
    header("location: error.php");
    exit();
}
?>
 
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ver registro</title>
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
                    <h1 class="mt-5 mb-3">Ver registro</h1>
                    <div class="form-group">
                        <label>Nombres</label>
                        <p><b><?php echo $row["name"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Correo Electronico</label>
                        <p><b><?php echo $row["address"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Salario</label>
                        <p><b><?php echo $row["salary"]; ?></b></p>
                    </div>
                    <p><a href="index3.php" class="btn btn-primary">Atras</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
