<?php

namespace API\TABLES\GET;

require_once 'vendor/autoload.php';

use Dotenv\Dotenv as Dotenv;

$dotenv = Dotenv::createUnsafeImmutable('./');
$dotenv->load();

class supabaseGetPaises
{
    private $apiKey;
    private $id_project;

    public function __construct()
    {
        $this->apiKey = $_ENV['APIKEY'];
        $this->id_project = $_ENV['ID_PROJECT'];
    }

    public function getPaises()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://' . $this->id_project . '.supabase.co/rest/v1/paises');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'apikey: ' . $this->apiKey,
            'Authorization: Bearer ' . $this->apiKey,
        ]);

        $respuestaPaises = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($httpCode == 200 || $httpCode == 201) {
            $dataGetPaises = json_decode($respuestaPaises, associative: true);
            if ($respuestaPaises === null) {
                $error = 'Error al decodificar el JSON';
            }
        } else {
            $error = curl_error($ch);
        }

        curl_close($ch);

        return $dataGetPaises ?? [];
    }
}