<?php

namespace api\GET;

class supabaseGetSecciones
{
    private $apiKey;

    public function __construct()
    {
        $this->apiKey = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6Im5wdXhwdWVsaW1heXFyc216cXVyIiwicm9sZSI6ImFub24iLCJpYXQiOjE2ODU5MzIyOTMsImV4cCI6MjAwMTUwODI5M30.XBKmo8wZRwFviHAgQjgDbbE3D_vmaeqvEP4mKi6W3bU';
    }

    public function getSecciones()
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://npuxpuelimayqrsmzqur.supabase.co/rest/v1/secciones?id_unica=neq.4&select=*',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => [
                'apikey: '.$this->apiKey,
                'Authorization: Bearer '.$this->apiKey,
            ],
        ]);

        $respuestaSecciones = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if ($httpCode == 200 || $httpCode == 201) {
            $dataGetSecciones = json_decode($respuestaSecciones, associative: true);
            if ($dataGetSecciones === null) {
                $error = 'Error al decodificar el JSON';
            }
        } else {
            $error = curl_error($curl);
        }

        curl_close($curl);

        return $dataGetSecciones ?? [];
    }
}