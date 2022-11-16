<?PHP
//Establecer la posibilidad de utilizar variables de sesión
session_start();
$DB_pass = "";
//Definir una constante para usar como salto de línea
define("NEWLINE","<br>");

//Conexión de la base de datos
$host = "localhost";
$DB_name ="tusrutashoy_TP9_CRUD";
$DB_user = "root";  
$DB_pass = "";

$DB_conn = mysqli_connect($host, $DB_user, $DB_pass, $DB_name);

//Consultar sino da error la conexión a la base
if(!$DB_conn) {
    echo "Error: No se pudo conectar a MySQL." . NEWLINE;
    echo "Nro de error: " . mysqli_connect_errno() . NEWLINE;
    echo "Mensaje de depuración: " . mysqli_connect_error() . NEWLINE;
    exit;
}

// echo "Éxito: Se realizó una conexión correcta a MySQL." . NEWLINE;

//mysqli_close($DB_conn);

?>