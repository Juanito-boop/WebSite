<?php

namespace API\TABLES\GET;

use Dotenv\Dotenv as Dotenv;

require_once 'vendor/autoload.php';

$dotenv = Dotenv::createUnsafeImmutable('./');
$dotenv->load();

class supabaseGetVinos
{
    private $apiKey;
    private $id_project;

    public function __construct()
    {
        $this->apiKey = $_ENV['APIKEY'];
        $this->id_project = $_ENV['ID_PROJECT'];
    }

    public function getProductos()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://' . $this->id_project . '.supabase.co/rest/v1/vinos?select=id%2Cnombre%2Canada%2Cbodega%2Cregion%2Cprecio%2Cstock%2Ctipo%2Cnivel_alcohol%2Ctipo_barrica%2Cdescripcion%2Cnotas_cata%2Ctemperatura_consumo%2Cactivo%2Cid_unica%2Curl_imagen%2Cpromocion%2Cbusqueda%2Cmaridaje%2Cpais%2Cpaises(pais)%2Cid_categoria%2Csecciones(nombre)%2Cvariedad%2Cvariedades(variedad)&order=id.asc');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'apikey: ' . $this->apiKey,
            'Authorization: Bearer ' . $this->apiKey,
        ]);

        $respuestaProductos = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($httpCode == 200 || $httpCode == 201) {
            $dataGetProductos = json_decode($respuestaProductos, true);
            if ($dataGetProductos === null) {
                $error = 'Error al decodificar el JSON';
            }
        } else {
            $error = curl_error($ch);
        }

        curl_close($ch);

        return $dataGetProductos ?? [];
    }
}