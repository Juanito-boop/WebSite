<?php

namespace API\TABLES;

require_once __DIR__ . '/../../cURL/cURL.php';

use cURL\cURL as curl;
use Exception;

class supabaseSecciones
{
    private curl $cURL;
    public function __construct()
    {
        $this->cURL = curl::getInstance();
    }

    /**
     * @throws Exception
     */
    public function getSecciones(): array
    {
        $parametrosConsulta = "id_unica=neq.4&select=*";
        return $this->cURL->get(tabla: "secciones", parametros: $parametrosConsulta);
    }

    /**
     * @throws Exception
     */
    public function postSeccion($data): string
    {
        return $this->cURL->post(tabla: "secciones", data: $data);
    }

    /**
     * @throws Exception
     */
    public function updateSeccion(string $columna, mixed $dataBuscar, mixed $dataCambiar): string
    {
        return $this->cURL->patch(tabla: "secciones", columnaBuscar: $columna, valorBuscar: $dataBuscar, valorCambiar: $dataCambiar);
    }

    /**
     * @throws Exception
     */
    public function deleteSeccion(string $columnaBuscar, mixed $valorEliminar): string
    {
        return $this->cURL->delete(tabla: "secciones", columnaBuscar: $columnaBuscar, valorEliminar: $valorEliminar);
    }
}