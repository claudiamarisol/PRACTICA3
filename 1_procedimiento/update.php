<?php
$nroEjercicio = 1;
include "../2header.php";
// Incluir archivo de configuración
require_once "config.php";
 
// Definir variables e inicializar con valores vacíos
$name = $address = $salary = "";
$name_err = $address_err = $salary_err = "";
 
// Procesamiento de datos del formulario cuando se envía el formulario
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Obtener valor de entrada oculto
    $id = $_POST["id"];
   
    // Validar nombre
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Introduce un Nombre.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Por favor ingrese un nombre valido.";
    } else{
        $name = $input_name;
    }
   
    // Validar dirección dirección
    $input_address = trim($_POST["address"]);
    if(empty($input_address)){
        $address_err = "Por favor ingrese una direccion de correo.";
    } else{
        $address = $input_address;
    }
   
    // Validar salario
    $input_salary = trim($_POST["salary"]);
    if(empty($input_salary)){
        $salary_err = "Por favor ingrese el monto del salario.";
    } elseif(!ctype_digit($input_salary)){
        $salary_err = "Introduzca un valor entero positivo.";
    } else{
        $salary = $input_salary;
    }
   
    // Verifique los errores de entrada antes de insertar en la base de datos
    if(empty($name_err) && empty($address_err) && empty($salary_err)){
        // Preparar una declaración de actualización
        $sql = "UPDATE employees SET name=?, address=?, salary=? WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Vincular variables a la declaración preparada como parámetros
            mysqli_stmt_bind_param($stmt, "sssi", $param_name, $param_address, $param_salary, $param_id);
           
            // Establecer parámetros
            $param_name = $name;
            $param_address = $address;
            $param_salary = $salary;
            $param_id = $id;
           
            // Intento de ejecutar la declaración preparada
            if(mysqli_stmt_execute($stmt)){
                // Registros actualizados con éxito. Redirigir a la página de destino
                header("location: index.php");
                exit();
            } else{
                echo "¡Ups! Algo salió mal. Por favor, inténtelo de nuevo más tarde.";
            }
        }
         
        // Cerrar declaración
        mysqli_stmt_close($stmt);
    }
   
    // Cerrar conexion
    mysqli_close($link);
} else{
    // Verifique la existencia del parámetro id antes de continuar con el procesamiento
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Obtener parámetro de URL
        $id =  trim($_GET["id"]);
       
        // Preparar una consulta Select
        $sql = "SELECT * FROM employees WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Vincular variables a la declaración preparada como parámetros
            mysqli_stmt_bind_param($stmt, "i", $param_id);
           
            // Establecer parámetros
            $param_id = $id;
           
            // Intento de ejecutar la declaración preparada
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
   
                if(mysqli_num_rows($result) == 1){
                    /* Obtenga la fila de resultados como una matriz asociativa. Dado que el conjunto de resultados
                    contiene solo una fila, no necesitamos usar while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                   
                    // Recuperar valor de campo individual
                    $name = $row["name"];
                    $address = $row["address"];
                    $salary = $row["salary"];
                } else{
                    // La URL no contiene una identificación válida. Redirigir a la página de error
                    header("location: error.php");
                    exit();
                }
               
            } else{
                echo "¡Ups! Algo salió mal. Por favor, inténtelo de nuevo más tarde.";
            }
        }
       
        // Cerrar declaración
        mysqli_stmt_close($stmt);
       
        // Cerrar conexion
        mysqli_close($link);
    }  else{
        // La URL no contiene el parámetro de identificación. Redirigir a la página de error
        header("location: error.php");
        exit();
    }
}
 if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Obtener parámetro de URL
        $id =  trim($_GET["id"]);
       
        // Preparar una consulta Select
        $sql = "SELECT * FROM employees WHERE id = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Vincular variables a la declaración preparada como parámetros
            mysqli_stmt_bind_param($stmt, "i", $param_id);
           
            // Establecer parámetros
            $param_id = $id;
           
            // Intento de ejecutar la declaración preparada
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
   
                if(mysqli_num_rows($result) == 1){
                    /* Obtenga la fila de resultados como una matriz asociativa. Dado que el conjunto de resultados
                    contiene solo una fila, no necesitamos usar while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                   
                    // Recuperar valor de campo individual
                    $name = $row["name"];
                    $address = $row["address"];
                    $salary = $row["salary"];
                } else{
                    // La URL no contiene una identificación válida. Redirigir a la página de error
                    header("location: error.php");
                    exit();
                }
               
            } else{
                echo "¡Ups! Algo salió mal. Por favor, inténtelo de nuevo más tarde.";
            }
        }
       
        // Cerrar declaración
        mysqli_stmt_close($stmt);
       
        // Cerrar conexion
        mysqli_close($link);
    }  else{
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
    <title>Actualizar Registro</title>
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
                    <h2 class="mt-5">Actualizar Registro</h2>
                    <p>Edite los valores de entrada y envíelos para actualizar el registro del empleado.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>Nombres</label>
                            <input type="text" name="name" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Correo</label>
                            <input type="text" name="address" class="form-control <?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $address; ?>">                            
                            <span class="invalid-feedback"><?php echo $address_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Salario</label>
                            <input type="text" name="salary" class="form-control <?php echo (!empty($salary_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $salary; ?>">
                            <span class="invalid-feedback"><?php echo $salary_err;?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Actualizar">
                        <a href="index1.php" class="btn btn-secondary ml-2">Cancelar</a>
                    </form>
                </div>
            </div>        
            </div>
    </div>
</body>
</html>
