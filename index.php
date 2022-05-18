<?php

use gamboamartin\errores\errores;
use src\base;
use src\out;


include "init.php";
require 'vendor/autoload.php';

$servicios = (new base())->servicios();
if(errores::$error){
    $error = (new errores())->error(mensaje:  'Error al obtener servicios',data: $servicios);
    print_r($error);
    die('Error');
}
$service_data = (new out())->out_services(servicios: $servicios);
if(errores::$error){
    $error = (new errores())->error(mensaje:  'Error al generar salida',data: $service_data);
    print_r($error);
    die('Error');
}
echo $service_data;

