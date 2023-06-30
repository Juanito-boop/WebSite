<?php

namespace cURL;

require_once __DIR__ . '/../vendor/autoload.php';

use CurlHandle;
use Dotenv\Dotenv as Dotenv;
use Exception;

$dotenv = Dotenv::createUnsafeImmutable(paths: __DIR__ . '/../');
$dotenv->load();

class cURL
{
    private static $instance;
    private string $apiKey;
    private string $id_project;

    private function __construct()
    {
        $this->apiKey = $_ENV['APIKEY'];
        $this->id_project = $_ENV['ID_PROJECT'];
    }

    public static function getInstance(): cURL
    {
        if (self::$instance === null) {
            self::$instance = new cURL();
        }

        return self::$instance;
    }

    /**
     * La función realiza una solicitud GET a un extremo de la API REST de Supabase
     * y devuelve la respuesta como una matriz.
     *
     * @param string $tabla El parámetro "tabla" representa el nombre de la tabla en
     * la base de datos de Supabase de la que desea recuperar datos. Es un valor de
     * cadena.
     * @param string $parametros El parámetro "parametros" es una cadena que representa los
     * parámetros de consulta que se agregarán a la URL. Estos parámetros se
     * utilizan para filtrar u ordenar los datos devueltos por la API de Supabase.
     * Por ejemplo, si desea filtrar los datos según una condición específica,
     * puede pasar la condición como
     *
     * @return array una matriz.
     * @throws Exception
     */
    public function get(string $tabla, string $parametros): array
    {
        $ch = curl_init();
        $url = "https://$this->id_project.supabase.co/rest/v1/$tabla?$parametros";

        curl_setopt($ch, option: CURLOPT_URL, value: $url);
        curl_setopt($ch, option: CURLOPT_RETURNTRANSFER, value: true);
        curl_setopt($ch, option: CURLOPT_CUSTOMREQUEST, value: 'GET');
        curl_setopt($ch, option: CURLOPT_HTTPHEADER, value: [
            'apikey: ' . $this->apiKey,
            'Authorization: Bearer ' . $this->apiKey,
        ]);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            $error = curl_error($ch);
            curl_close($ch);
            throw new Exception(message: 'Error en la solicitud cURL: ' . $error);
        }

        curl_close($ch);
        $array = json_decode($response, true);

        return $array ?? [];
    }

    /**
     * La función envía una solicitud POST a un extremo de la API REST de Supabase
     * con los datos proporcionados y devuelve una alerta de JavaScript con el
     * código de respuesta HTTP.
     *
     * @param string $tabla El parámetro "tabla" es una cadena que representa él
     * nombre de la tabla donde desea publicar los datos.
     * @param array $data El parámetro "data" es una matriz que contiene los datos
     * que se enviarán en la solicitud POST. Debe tener el formato requerido por la
     * API de Supabase para crear un nuevo registro en la tabla especificada.
     *
     * @return string una cadena que contiene un mensaje de alerta de JavaScript.
     * El mensaje incluye el código de respuesta HTTP recibido de la solicitud
     * cURL.
     * @throws Exception
     */
    public function post(string $tabla, array $data): string
    {
        $ch = curl_init();
        $url = "https://$this->id_project.supabase.co/rest/v1/$tabla";

        curl_setopt($ch, option: CURLOPT_URL, value: $url);
        curl_setopt($ch, option: CURLOPT_RETURNTRANSFER, value: true);
        curl_setopt($ch, option: CURLOPT_CUSTOMREQUEST, value: 'POST');
        curl_setopt(handle: $ch, option: CURLOPT_HTTPHEADER, value: [
            'apikey: ' . $this->apiKey,
            'Authorization: Bearer ' . $this->apiKey,
            'Content-Type: application/json',
            'Prefer: return=minimal',
        ]);
        return $this->extracted($ch, $data);
    }

    /**
     * La función realiza una solicitud PATCH para actualizar un valor específico
     * en una tabla de Supabase utilizando la API REST de Supabase.
     *
     * @param string $tabla El parámetro "tabla" representa el nombre de la tabla en
     * la base de datos de Supabase donde se realizará la operación de parcheo.
     * @param string $columnaBuscar El parámetro "columnaBuscar" es una cadena que
     * representa el nombre de la columna en la tabla que desea buscar un valor
     * específico.
     * @param mixed $valorBuscar El parámetro valorBuscar es el valor que desea buscar
     * en la columna especificada (columnaBuscar) de la tabla (tabla). Se
     * utiliza para identificar las filas que deben actualizarse.
     * @param mixed $valorCambiar El parámetro valorCambiar es el valor que desea
     * actualizar en la columna especificada de la tabla.
     *
     * @return string una cadena que contiene un mensaje de alerta de JavaScript.
     * El mensaje incluye el código de respuesta HTTP de la solicitud cURL.
     * @throws Exception
     */
    public function patch(string $tabla, string $columnaBuscar, mixed $valorBuscar, mixed $valorCambiar): string
    {
        $ch = curl_init();
        $url = "https://$this->id_project.supabase.co/rest/v1/$tabla?$columnaBuscar=eq." . urlencode($valorBuscar);
        $dataPatch = json_encode([$columnaBuscar => $valorCambiar]);

        curl_setopt($ch, option: CURLOPT_URL, value: $url);
        curl_setopt($ch, option: CURLOPT_RETURNTRANSFER, value: true);
        curl_setopt($ch, option: CURLOPT_CUSTOMREQUEST, value: 'PATCH');
        curl_setopt($ch, option: CURLOPT_HTTPHEADER, value: [
            'apikey: ' . $this->apiKey,
            'Authorization: Bearer ' . $this->apiKey,
            'Content-Type: application/json',
            'Prefer: return=minimal',
        ]);
        return $this->extracted($ch, $dataPatch);
    }

    /**
     * La función `delete` envía una solicitud DELETE a un extremo de la API REST
     * de Supabase para eliminar un registro de una tabla específica en función de
     * un valor de columna dado.
     *
     * @param string $tabla tabla El parámetro "tabla" representa el nombre de la tabla de
     * la que se quiere borrar un registro.
     * @param string $columnaBuscar columnaBuscar El parámetro "columnaBuscar" es una cadena que
     * representa el nombre de la columna en la tabla para buscar el valor a
     * eliminar.
     * @param mixed $valorEliminar valorEliminar El parámetro `` es el valor que desea
     * utilizar para buscar el registro que desea eliminar en la tabla
     * especificada. Es el valor que se utilizará en la consulta para encontrar el
     * registro a eliminar.
     *
     * @return string una cadena que contiene un mensaje de alerta de JavaScript.
     * El mensaje incluye el código de respuesta HTTP recibido de la solicitud
     * DELETE.
     * @throws Exception
     */
    public function delete(string $tabla, string $columna, int $valorColumna): string
    {
        $ch = curl_init();
        $url = "https://$this->id_project.supabase.co/rest/v1/$tabla?$columna=eq.$valorColumna";

        curl_setopt($ch, option: CURLOPT_URL, value: $url);
        curl_setopt($ch, option: CURLOPT_RETURNTRANSFER, value: true);
        curl_setopt($ch, option: CURLOPT_CUSTOMREQUEST, value: 'DELETE');
        curl_setopt($ch, option: CURLOPT_HTTPHEADER, value: [
            'apikey: ' . $this->apiKey,
            'Authorization: Bearer ' . $this->apiKey,
        ]);

        curl_exec($ch);
        $http_response = curl_getinfo($ch, option: CURLINFO_HTTP_CODE);

        if (curl_errno($ch)) {
            $error = curl_error($ch);
            curl_close($ch);
            throw new Exception(message: 'Error en la solicitud cURL: ' . $error);
        }

        curl_close($ch);

        return '<script> alert("Correcto ' . $http_response . '")</script>';
    }

    /**
     * @param CurlHandle|false $ch
     * @param array $data
     * @return string
     * @throws Exception
     */
    public function extracted(CurlHandle|false $ch, array $data): string
    {
        curl_setopt($ch, option: CURLOPT_POSTFIELDS, value: $data);

        curl_exec($ch);
        $http_response = curl_getinfo($ch, option: CURLINFO_HTTP_CODE);

        if (curl_errno($ch)) {
            $error = curl_error($ch);
            curl_close($ch);
            throw new Exception(message: 'Error en la solicitud cURL: ' . $error);
        }

        curl_close($ch);

        return '<script> alert("Correcto ' . $http_response . '")</script>';
    }
}