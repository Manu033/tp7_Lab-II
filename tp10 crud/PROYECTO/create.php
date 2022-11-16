<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$nombre = $apellido = $email = "";
$telefono $cod_tipo_contacto = 0;
$nombre_err = $apellido_err = $email_err = "";
$telefono_err $cod_tipo_contacto_err = 0;

 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate nombre
    $input_name = trim($_POST["NOMBRE"]);
    if(empty($input_name)){
        $nombre_err = "Porfavor ingresa un nombre:";
    } elseif(!filter_var($input_nombre, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $nombre_err = "Porfavor ingresa un nombre valido.";
    } else{
        $nombre = $input_nombre;
    }
    
    // Validate apellido
    $input_apellido = trim($_POST["apellido"]);
    if(empty($input_apellido)){
        $apellido_err = "Porfavor ingresa un apellido.";     
    } else{
        $apellido = $input_apellido;
    }
    
    // Validate email
    $input_ = trim($_POST["email"]);
    if(empty($input_email)){
        $email_err = "Porfavor ingrese un email.";     
    } else{
        $email = $input_email;
    }

    // Validate telefono
    $input_telefono = trim($_POST["telefono"]);
    if(empty($input_telefono)){
        $telefono_err = "Porfavor ingrese un numero de telefono.";     
    } elseif(!ctype_digit($input_telefono)){
        $telefono_err = "Ingrese un numero de telefono valido.";
    } else{
        $telefono = $input_telefono;
    }
    
    // Check input errors before inserting in database
    if(empty($nombre_err) && empty($aapellido_err) && empty($email_err) && empty($telefono_err)){
        // Prepare an insert statement
        $sql = "INSERT INTO employees (NOMBRE, APELLIDO, EMAIL, TELEFONO, COD_TIPO_RELACION) VALUES (?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_nombre, $param_apellido, $param_email, $param_telefono, $param_cod_tipo_relacion);
            
            // Set parameters
            $param_nombre = $nombre;
            $param_apellido = $apellido;
            $param_email = $email;
            $param_telefono = $telefono
            $param_cod_tipo_relacion = $cod_tipo_contacto

            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Algo ha ido mal. Intente nuevamente.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
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
                    <p>Porfavor complete el siguiente formulario.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Nombre</label>
                            <input type="text" name="nombre" class="form-control <?php echo (!empty($nombre_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nombre; ?>">
                            <span class="invalid-feedback"><?php echo $nombre_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Apellido</label>
                            <textarea name="apellido" class="form-control <?php echo (!empty($apellido_err)) ? 'is-invalid' : ''; ?>"><?php echo $apellido; ?></textarea>
                            <span class="invalid-feedback"><?php echo $apellido_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                            <span class="invalid-feedback"><?php echo $email_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                            <span class="invalid-feedback"><?php echo $email_err;?></span>
                        </div>

                        <div>
                            <label for="tipo_relacion">Selecciona un tipo de relacion</label>
                            <select name="cars" id="cars">
                                <option value="personal">Personal</option>
                                <option value="laboral">Laboral</option>
                                <option value="estudio">Estudio</option>
                                <option value="familia">Familia</option>
                            </select>
                        </div>
                    


                        <input type="submit" class="btn btn-primary" value="Aceptar">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>