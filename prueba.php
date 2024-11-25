<?php 
session_start();
$host = "localhost";
$dbname = "eventos_deportivos";
$username = "root";
$password = "";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Error en la conexión a la base de datos: " . $conn->connect_error);
}

$ruta_csv = 'C:\Users\joselux\Desktop\txtcsv\Pruebatxt.csv';
$handle = fopen($ruta_csv,'r');
$test =  fgetcsv($handle,10000,'.');
print_r($test);
while(($fila = fgetcsv($handle,1000,',')) !==false){
    
$sql = "INSERT INTO eventos (nombre_evento, tipo_deporte, fecha, hora, ubicacion) 
VALUES ('$fila[0]', '$fila[1]', '$fila[2]', '$fila[3]')";


}



?>