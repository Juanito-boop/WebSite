<?php

namespace API\TABLES;

require_once __DIR__ . '/../../cURL/cURL.php';

use cURL\cURL as curl;
use Exception;

class supabasePaises
{
    private curl $cURL;
    public function __construct()
    {
        $this->cURL = curl::getInstance();
    }

    /**
     * @throws Exception
     */
    public function getPaises(): array
    {
        return $this->cURL->get(tabla: "paises", parametros: "select=*");
    }

    /**
     * @throws Exception
     */
    public function postPais($data): string
    {
        return $this->cURL->post(tabla: "paises", data: $data);
    }

    /**
     * @throws Exception
     */
    public function updatePais(string $columna, mixed $dataBuscar, mixed $dataCambiar): string
    {
        return $this->cURL->patch(tabla: "paises", columnaBuscar: $columna, valorBuscar: $dataBuscar, valorCambiar: $dataCambiar);
    }

    /**
     * @throws Exception
     */
    public function deletePais(string $columnaBuscar, mixed $valorEliminar): string
    {
        return $this->cURL->delete(tabla: "paises", columna: $columnaBuscar, valorColumna: $valorEliminar);
    }

}