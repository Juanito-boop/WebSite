<?php

namespace API\TABLES;

require_once __DIR__ . '/../../cURL/cURL.php';

use cURL\cURL as curl;
use Exception;

class supabaseVinos
{
    private curl $cURL;
    public function __construct()
    {
        $this->cURL = curl::getInstance();
    }

    /**
     * @throws Exception
     */
    public function getVinos(): array
    {
        $parametrosConsulta = "select=id,nombre,anada,bodega,region,precio,stock,tipo,nivel_alcohol,tipo_barrica,descripcion,notas_cata,temperatura_consumo,activo,id_unica,url_imagen,promocion,busqueda,maridaje,pais,paises(pais),id_categoria,secciones(nombre),variedad,variedades(variedad)&order=id.asc";
        return $this->cURL->get(tabla: "vinos", parametros: $parametrosConsulta);
    }

    /**
     * @throws Exception
     */
    public function postVino(array $data): string
    {
        return $this->cURL->post(tabla: "vinos", data: $data);
    }

    /**
     * @throws Exception
     */
    public function updateVino(string $columna, mixed $dataBuscar, mixed $dataCambiar): string
    {
        return $this->cURL->patch(tabla: "vinos", columnaBuscar: $columna, valorBuscar: $dataBuscar, valorCambiar: $dataCambiar);
    }

    /**
     * @throws Exception
     */
    public function deleteVino(string $columnaBuscar, mixed $valorEliminar): string
    {
        return $this->cURL->delete("vinos", $columnaBuscar,$valorEliminar);
    }
}