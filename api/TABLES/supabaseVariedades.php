<?php

namespace API\TABLES;

require_once __DIR__ . '/../../cURL/cURL.php';

use cURL\cURL as curl;
use Exception;

class supabaseVariedades
{
    private curl $cURL;
    public function __construct()
    {
        $this->cURL = curl::getInstance();
    }

    /**
     * @throws Exception
     */
    public function getVariedades(): array
    {
        return $this->cURL->get(tabla: "variedades", parametros: "select=*");
    }

    /**
     * @throws Exception
     */
    public function postVariedad($data): string
    {
        return $this->cURL->post(tabla: "variedades", data: $data);
    }

    /**
     * @throws Exception
     */
    public function updateVariedad(string $columna, mixed $dataBuscar, mixed $dataCambiar): string
    {
        return $this->cURL->patch(tabla: "variedades", columnaBuscar: $columna, valorBuscar: $dataBuscar, valorCambiar: $dataCambiar);
    }

    /**
     * @throws Exception
     */
    public function deleteVariedad(int $id_unica): string
    {
        return $this->cURL->delete(tabla: "variedades", columnaBuscar: "id", valorEliminar: $id_unica);
    }
}

$vino = new supabaseVariedades();
$vino->deleteVariedad(1);