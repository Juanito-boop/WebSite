<?php

namespace api\GET;

require_once 'vendor/autoload.php';

class supabaseGetVinos
{
    private $apiKey;

    public function __construct()
    {
        $this->apiKey = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6Im5wdXhwdWVsaW1heXFyc216cXVyIiwicm9sZSI6ImFub24iLCJpYXQiOjE2ODU5MzIyOTMsImV4cCI6MjAwMTUwODI5M30.XBKmo8wZRwFviHAgQjgDbbE3D_vmaeqvEP4mKi6W3bU";
    }

    public function getProductos()
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://npuxpuelimayqrsmzqur.supabase.co/rest/v1/vinos?select=id%2Cnombre%2Canada%2Cbodega%2Cregion%2Cprecio%2Cstock%2Ctipo%2Cnivel_alcohol%2Ctipo_barrica%2Cdescripcion%2Cnotas_cata%2Ctemperatura_consumo%2Cactivo%2Cid_unica%2Curl_imagen%2Cpromocion%2Cbusqueda%2Cmaridaje%2Cpais%2Cpaises(pais)%2Cid_categoria%2Csecciones(nombre)%2Cvariedad%2Cvariedades(variedad)&order=id.asc',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => [
                'apikey: ' . $this->apiKey,
                'Authorization: Bearer ' . $this->apiKey,
            ],
        ]);

        $respuestaProductos = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ($httpCode == 200 || $httpCode == 201) {
            $dataGetProductos = json_decode($respuestaProductos, true);
            if ($dataGetProductos === null) {
                $error = 'Error al decodificar el JSON';
            }
        } else {
            $error = curl_error($curl);
        }

        curl_close($curl);

        return $dataGetProductos ?? [];
    }
}