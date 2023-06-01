<?php
$curl = curl_init();

curl_setopt_array($curl, [
    CURLOPT_URL => "https://hijaeegxjbuivzckpijg.supabase.co/rest/v1/paises",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => [
        "Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImhpamFlZWd4amJ1aXZ6Y2twaWpnIiwicm9sZSI6ImFub24iLCJpYXQiOjE2NTg1MTgxNjAsImV4cCI6MTk3NDA5NDE2MH0.dZo4cMQV2Xm1rugxdthp9Q8c40oHRkRHbrJlh4a3-BU",
        "apikey: eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImhpamFlZWd4amJ1aXZ6Y2twaWpnIiwicm9sZSI6ImFub24iLCJpYXQiOjE2NTg1MTgxNjAsImV4cCI6MTk3NDA5NDE2MH0.dZo4cMQV2Xm1rugxdthp9Q8c40oHRkRHbrJlh4a3-BU"
    ],
]);

$respuestaPaises = curl_exec($curl);
$httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

if ($httpCode == 200 || $httpCode == 201) {
    $dataGetPaises = json_decode($respuestaPaises, true);
    if ($respuestaPaises === null) {
        $error = 'Error al decodificar el JSON';
    }
} else {
    $error = curl_error($curl);
}
$err = curl_error($curl);
