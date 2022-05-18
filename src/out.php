<?php
namespace src;
use gamboamartin\errores\errores;

class out{
    private errores $error;
    public function __construct(){
        $this->error = new errores();
    }
    private function out_service(string $name_service, array $servicio): array|string
    {

        $links = (new links())->links_out(name_service: $name_service,servicio: $servicio);
        if(errores::$error){
            return $this->error->error(mensaje:  'Error al generar links',data: $links);
        }

        $liga = ' SERVICIO: ';
        $liga .= $links->servicio;
        $liga .= ' INFO: ';
        $liga .= $links->info;
        $liga.= ' LOCK: '.$servicio['file_lock'];
        $liga.= $links->limpia;

        return $liga;
    }

    public function out_services(array $servicios): array|string
    {
        $service_data_out = '';
        foreach($servicios as $name_service =>$servicio){

            $service_data = $this->out_service(name_service: $name_service,servicio:  $servicio);
            if(errores::$error){
                return $this->error->error(mensaje:  'Error al generar salida',data: $service_data);
            }

            $service_data_out.=$service_data."<br><br>";
        }
        return $service_data_out;
    }


}
