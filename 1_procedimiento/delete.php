<?php
$nroEjercicio = 1;
include "../2header.php";
// Procesar la operación de eliminación después de la confirmación
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Incluir archivo de configuración
    require_once "config.php";
   
    // Preparar una declaración de eliminación
    $sql = "DELETE FROM employees WHERE id = ?";
   
    if($stmt = mysqli_prepare($link, $sql)){
        // Vincular variables a la declaración preparada como parámetros
        mysqli_stmt_bind_param($stmt, "i", $param_id);
       
        // Establecer parámetros
        $param_id = trim($_POST["id"]);
       
        // Ejecutar la consulta preparada
        if(mysqli_stmt_execute($stmt)){
            // Registros eliminados con éxito. Redirigir a la página de destino
            header("location: index1.php");
            exit();
        } else{
            echo "¡Ups! Algo salió mal. Por favor, inténtelo de nuevo más tarde.";
        }
    }
     
    // Cerrar declaración
    mysqli_stmt_close($stmt);
   
    // Cerrar conexion
    mysqli_close($link);
} else{
    // Comprobar la existencia del parámetro id
    if(empty(trim($_GET["id"]))){
        // La URL no contiene el parámetro de identificación. Redirigir a la página de error
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminar el registro</title>
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
                    <h2 class="mt-5 mb-3">Eliminar el registro</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                            <p>¿Está seguro de que desea eliminar este registro de empleado?</p>
                            <p>
                                <input type="submit" value="Si" class="btn btn-danger">
                                <a href="index1.php" class="btn btn-secondary">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
