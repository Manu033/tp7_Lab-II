<?php
// Check existence of id parameter before processing further
if(isset($_GET["COD_PERSONA"]) && !empty(trim($_GET["COD_PERSONA"]))){
    // Include config file
    require_once "config.php";
    
    // Prepare a select statement
    $sql = "SELECT * FROM PERSONAS WHERE COD_PERSONA = ?";
    
    if($stmt = mysqli_prepare($link, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_COD_PERSONA);
        
        // Set parameters
        $param_COD_PERSONA = trim($_GET["COD_PERSONA"]);
        
        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
    
            if(mysqli_num_rows($result) == 1){
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                // Retrieve individual field value
                $nombre = $row["NOMBRE"];
                $apellido = $row["NOMBRE"];
                $email = $row["EMAIL"];
                $telefono = $rox["TELEFONO"]
                $cod_tipo_relacion = $row["COD_TIPO_RELACION"]
            } else{
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
            
        } else{
            echo "Algo ha ido mal.";
        }
    }
     
    // Close statement
    mysqli_stmt_close($stmt);
    
    // Close connection
    mysqli_close($link);
} else{
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
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
                        <label>Nombre</label>
                        <p><b><?php echo $row["NOMBRE"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Apellido</label>
                        <p><b><?php echo $row["APELLIDO"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <p><b><?php echo $row["EMAIL"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Telefono</label>
                        <p><b><?php echo $row["TELEFONO"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Tipo Relacion</label>
                        <p><b><?php echo $row["COD_TIPO_RELACION"]; ?></b></p>
                    </div>

                    <p><a href="index.php" class="btn btn-primary">Atras</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>