<?php
namespace src;
use config\generales;
use gamboamartin\errores\errores;
use stdClass;

class links{
    private errores $error;
    public function __construct(){
        $this->error = new errores();
    }
    private function link_ejecuta_servicio(string $name_service, array $servicio): string
    {
        $link = '<a href="'.(new generales())->url_services.'/services/'.$servicio['file'].'">';
        $link.=$name_service;
        $link.='</a>';
        return $link;
    }

    private function link_file_info(array $servicio): string
    {
        $liga = '<a href="'.(new generales())->url_services.'/services/'.$servicio['file_info'].'">';
        $liga .= $servicio['file_info'];
        $liga .= "</a>";
        return $liga;
    }
    private function link_limpia(string $name_service): string
    {
        $liga = '<a href="'.(new generales())->url_base.'/limpia_log.php?service='.$name_service.'">';
        $liga .= ' LIMPIA ';
        $liga .= "</a>";
        return $liga;
    }

    public function links_out(string $name_service, array $servicio): array|stdClass
    {
        $link_ejecuta_servicio = $this->link_ejecuta_servicio(name_service:$name_service,servicio: $servicio);
        if(errores::$error){
            return $this->error->error(mensaje:  'Error al generar link',data: $link_ejecuta_servicio);

        }
        $link_file_info = $this->link_file_info(servicio: $servicio);
        if(errores::$error){
            return $this->error->error(mensaje:  'Error al generar link',data: $link_file_info);
        }
        $link_limpia = $this->link_limpia(name_service:$name_service);
        if(errores::$error){
            return $this->error->error(mensaje:  'Error al generar link',data: $link_limpia);
        }

        $data = new stdClass();
        $data->info = $link_file_info;
        $data->limpia = $link_limpia;
        $data->servicio = $link_ejecuta_servicio;
        return  $data;
    }
}
