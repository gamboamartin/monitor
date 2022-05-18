<?php
namespace src;
use config\generales;
use gamboamartin\errores\errores;
use gamboamartin\plugins\files;

class base{
    private errores $error;
    public function __construct(){
        $this->error = new errores();
    }
    public function servicios(): array
    {
        $directorio = opendir((new generales())->path_service);

        $servicios = (new files())->get_files_services(directorio: $directorio);
        if(errores::$error){
            return $this->error->error(mensaje:  'Error al maquetar files',data: $servicios);
        }
        return $servicios;
    }
}
