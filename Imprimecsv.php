<?php

$ruta_csv = 'C:\Users\joselux\Desktop\txtcsv\Pruebatxt.csv';
$handle = fopen($ruta_csv,'r');
$test =  fgetcsv($handle,10000,'.');
print_r($test);
while(($fila = fgetcsv($handle,1000,',')) !==false){

    print_r($fila);
}

?>