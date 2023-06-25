<?php

namespace API\TABLES\GET;

require_once 'vendor/autoload.php';

use Dotenv\Dotenv as Dotenv;

$dotenv = Dotenv::createUnsafeImmutable('./');
$dotenv->load();

class supabaseGetSecciones
{
    private $apiKey;
    private $id_project;

    public function __construct()
    {
        $this->apiKey = $_ENV['APIKEY'];
        $this->id_project = $_ENV['ID_PROJECT'];
    }

    public function getSecciones()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://' . $this->id_project . '.supabase.co/rest/v1/secciones?id_unica=neq.4&select=*');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'apikey: ' . $this->apiKey,
            'Authorization: Bearer ' . $this->apiKey,
        ]);

        $respuestaSecciones = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($httpCode == 200 || $httpCode == 201) {
            $dataGetSecciones = json_decode($respuestaSecciones, associative: true);
            if ($dataGetSecciones === null) {
                $error = 'Error al decodificar el JSON';
            }
        } else {
            $error = curl_error($ch);
        }

        curl_close($ch);

        return $dataGetSecciones ?? [];
    }
}