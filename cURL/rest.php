<?php

namespace cURL;

require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv as Dotenv;
use Exception;

$dotenv = Dotenv::createUnsafeImmutable(paths: __DIR__ . '/../');
$dotenv->load();

class rest {
    private static $instance;
    private string $apiKey;
    private string $id_project;

    private function __construct() {
        $this->apiKey = $_ENV['APIKEY'];
        $this->id_project = $_ENV['ID_PROJECT'];
    }

    public static function getInstance(): rest {
        if (self::$instance === null) {
            self::$instance = new rest();
        }
        return self::$instance;
    }

    /**
     * @throws Exception
     */
    public function get(string $tabla, string $parametros): array {
        $ch = curl_init();
        $url = "https://$this->id_project.supabase.co/rest/v1/$tabla?$parametros";
        curl_setopt(handle: $ch, option: CURLOPT_URL, value: $url);
        curl_setopt(handle: $ch, option: CURLOPT_RETURNTRANSFER, value: true);
        curl_setopt(handle: $ch, option: CURLOPT_CUSTOMREQUEST, value: 'GET');
        curl_setopt(handle: $ch, option: CURLOPT_HTTPHEADER, value: [
            'apikey: ' . $this->apiKey,
            'Authorization: Bearer ' . $this->apiKey,
        ]);
        $response = curl_exec(handle: $ch);
        if (curl_errno(handle: $ch)) {
            $error = curl_error(handle: $ch);
            curl_close(handle: $ch);
            throw new Exception(message: 'cURL Request Error: ' . $error);
        }
        curl_close(handle: $ch);
        $array = json_decode(json: $response, associative: true);
        return $array ?? [];
    }

    /**
     * @throws Exception
     */
    public function post(string $tabla, array $data): string {
        $ch = curl_init();
        $url = "https://$this->id_project.supabase.co/rest/v1/$tabla";
        $dataPost = json_encode(value: $data);
        curl_setopt(handle: $ch, option: CURLOPT_URL, value: $url);
        curl_setopt(handle: $ch, option: CURLOPT_RETURNTRANSFER, value: true);
        curl_setopt(handle: $ch, option: CURLOPT_CUSTOMREQUEST, value: 'POST');
        curl_setopt(handle: $ch, option: CURLOPT_HTTPHEADER, value: [
            'apikey: ' . $this->apiKey,
            'Authorization: Bearer ' . $this->apiKey,
            'Content-Type: application/json',
            'Prefer: return=minimal',
        ]);
        return $this->executeCurlRequest(ch: $ch, data: $dataPost);
    }

    /**
     * @throws Exception
     */
    public function patch(string $tabla, string $columnaBuscar, mixed $valorBuscar, mixed $valorCambiar): string {
        $ch = curl_init();
        $url = "https://$this->id_project.supabase.co/rest/v1/$tabla?$columnaBuscar=eq." . urlencode(string: $valorBuscar);
        $dataPatch = json_encode(value: [$columnaBuscar => $valorCambiar]);
        curl_setopt(handle: $ch, option: CURLOPT_URL, value: $url);
        curl_setopt(handle: $ch, option: CURLOPT_RETURNTRANSFER, value: true);
        curl_setopt(handle: $ch, option: CURLOPT_CUSTOMREQUEST, value: 'PATCH');
        curl_setopt(handle: $ch, option: CURLOPT_HTTPHEADER, value: [
            'apikey: ' . $this->apiKey,
            'Authorization: Bearer ' . $this->apiKey,
            'Content-Type: application/json',
            'Prefer: return=minimal',
        ]);
        return $this->executeCurlRequest(ch: $ch, data: $dataPatch);
    }

    /**
     * @throws Exception
     */
    public function delete(string $tabla, string $columnaBuscar, mixed $valorEliminar): string {
        $ch = curl_init();
        $url = "https://$this->id_project.supabase.co/rest/v1/$tabla?$columnaBuscar=eq." . urlencode($valorEliminar);
        curl_setopt(handle: $ch, option: CURLOPT_URL, value: $url);
        curl_setopt(handle: $ch, option: CURLOPT_RETURNTRANSFER, value: true);
        curl_setopt(handle: $ch, option: CURLOPT_CUSTOMREQUEST, value: 'DELETE');
        curl_setopt(handle: $ch, option: CURLOPT_HTTPHEADER, value: [
            'apikey: ' . $this->apiKey,
            'Authorization: Bearer ' . $this->apiKey,
        ]);
        return $this->executeCurlRequest(ch: $ch);
    }

    /**
     * @throws Exception
     */
    private function executeCurlRequest($ch, ?string $data = null): string {
        if ($data !== null) {
            curl_setopt(handle: $ch, option: CURLOPT_POSTFIELDS, value: $data);
        }
        $response = curl_exec(handle: $ch);
        if (curl_errno(handle: $ch)) {
            $error = curl_error(handle: $ch);
            curl_close(handle: $ch);
            throw new Exception('cURL Request Error: ' . $error);
        }
        $statusCode = curl_getinfo(handle: $ch, option: CURLINFO_HTTP_CODE);
        curl_close(handle: $ch);
        return "<script>alert('HTTP Response Code: $statusCode');</script>";
    }
}