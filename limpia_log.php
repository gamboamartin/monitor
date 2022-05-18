<?php

use config\generales;
use gamboamartin\errores\errores;
use gamboamartin\plugins\files;

include "init.php";
require 'vendor/autoload.php';


$service = $_GET['service'];

$data_service = (new files())->get_data_service((new generales())->path_service, $service);
if(errores::$error){
    $error = (new errores())->error(mensaje: 'Error al obtener datos',data: $data_service );
    print_r($error);
    die('Error');
}
if($data_service['file_lock'] !=='') {
    unlink((new generales())->path_service.'/'.$data_service['file_lock']);
}
if($data_service['file_info'] !=='') {
    unlink((new generales())->path_service.'/'.$data_service['file_info']);
}

var_dump($data_service);