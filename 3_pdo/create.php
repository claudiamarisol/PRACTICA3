<?php
$nroEjercicio = 3;
include "../2header.php";
// Incluir archivo de configuración
require_once "config.php";
 
// Definir variables e inicializar con valores vacíos
$name = $address = $salary = "";
$name_err = $address_err = $salary_err = "";
 
// Procesamiento de datos del formulario cuando se envía el formulario
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Introduce un Nombre.";
    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $name_err = "Por favor ingrese un nombre valido.";
    } else{
        $name = $input_name;
    }
   
    // Validar correo
    $input_address = trim($_POST["address"]);
    if(empty($input_address)){
        $address_err = "Por favor ingrese una direccion de correo.";
    } else{
        $address = $input_address;
    }
   
    // Validar Salario
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
        // Preparar una declaración de inserción
        $sql = "INSERT INTO employees (name, address, salary) VALUES (:name, :address, :salary)";
 
        if($stmt = $pdo->prepare($sql)){
            // Vincular variables a la declaración preparada como parámetros
            $stmt->bindParam(":name", $param_name);
            $stmt->bindParam(":address", $param_address);
            $stmt->bindParam(":salary", $param_salary);
           
            // Establecer parámetros
            $param_name = $name;
            $param_address = $address;
            $param_salary = $salary;
           
            // Ejecutar la consulta preparada
            if($stmt->execute()){
                // Registros creados con éxito. Redirigir a la página de Inicio
                header("location: index.php");
                exit();
            } else{
                echo "¡Ups! Algo salió mal. Por favor, inténtelo de nuevo más tarde.";
            }
        }
         
        // Cerrar declaración
        unset($stmt);
    }
   
    // Cerrar conexion
    unset($pdo);
}
?>
 
 <!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Registro</title>
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
                    <h2 class="mt-5">Crear Registro</h2>
                    <p>Complete este formulario y envíelo para agregar el registro del empleado a la base de datos.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
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
                        <input type="submit" class="btn btn-primary" value="Enviar">
                        <a href="index3.php" class="btn btn-secondary ml-2">Cancelar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>

