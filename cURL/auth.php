<?php

namespace cURL;

require_once __DIR__ . '/../vendor/autoload.php';

use CurlHandle;
use Dotenv\Dotenv as Dotenv;
use Exception;

$dotenv = Dotenv::createUnsafeImmutable(paths: __DIR__ . '/../');
$dotenv->load();

class auth
{
    private static $instance;
    private string $apiKey;
    private string $id_project;

    private function __construct()
    {
        $this->apiKey = $_ENV['APIKEY'];
        $this->id_project = $_ENV['ID_PROJECT'];
    }

    public static function getInstance(): auth
    {
        if (self::$instance === null) {
            self::$instance = new auth();
        }
        return self::$instance;
    }

    /**
     * @throws Exception
     */
    public function USER_SIGNUP(string $email, string $password): bool|string
    {
        $ch = curl_init();
        $url = "https://$this->id_project.supabase.co/auth/v1/signup";
        $data = [
            'email' => $email,
            'password' => $password,
        ];
        $json = json_encode($data);

        curl_setopt(handle: $ch, option: CURLOPT_URL, value: $url);
        curl_setopt(handle: $ch, option: CURLOPT_RETURNTRANSFER, value: true);
        curl_setopt(handle: $ch, option: CURLOPT_CUSTOMREQUEST, value: 'POST');
        curl_setopt(handle: $ch, option: CURLOPT_HTTPHEADER, value: [
            'apikey: ' . $this->apiKey,
            'Content-Type: application/json',
        ]);
        curl_setopt(handle: $ch, option: CURLOPT_POSTFIELDS, value: $json);

        $response = curl_exec($ch);

        curl_close($ch);

        return $response;
    }

    /**
     * @throws Exception
     */
    public function USER_LOGIN_MAIL_PASS(string $email, string $password)
    {
        $ch = curl_init();
        $data = [
            'email' => $email,
            'password' => $password,
        ];
        $json = json_encode($data);
        $url = "https://$this->id_project.supabase.co/auth/v1/token?grant_type=password";

        curl_setopt(handle: $ch, option: CURLOPT_URL, value: $url);
        curl_setopt(handle: $ch, option: CURLOPT_RETURNTRANSFER, value: true);
        curl_setopt(handle: $ch, option: CURLOPT_CUSTOMREQUEST, value: 'POST');
        curl_setopt(handle: $ch, option: CURLOPT_HTTPHEADER, value: [
            'apikey: ' . $this->apiKey,
            'Content-Type: application/json',
        ]);
        curl_setopt(handle: $ch, option: CURLOPT_POSTFIELDS, value: $json);

        $respuesta = curl_exec($ch);
        $response = json_decode($respuesta, true);

        curl_close($ch);

        return $response;
    }


    /**
     * @throws Exception
     */
    public function USER_LOGIN_MAGIC_LINK(string $email): void
    {
        $ch = curl_init();
        $url = "https://$this->id_project.supabase.co/auth/v1/magiclink";
        $data = [
            'email' => $email,
        ];
        $json = json_encode($data);

        curl_setopt(handle: $ch, option: CURLOPT_URL, value: $url);
        curl_setopt(handle: $ch, option: CURLOPT_RETURNTRANSFER, value: true);
        curl_setopt(handle: $ch, option: CURLOPT_CUSTOMREQUEST, value: 'POST');
        curl_setopt(handle: $ch, option: CURLOPT_HTTPHEADER, value: [
            'apikey: ' . $this->apiKey,
            'Content-Type: application/json',
        ]);
        curl_setopt(handle: $ch, option: CURLOPT_POSTFIELDS, value: $json);
    }

    public function USER_LOGOUT(string $user_token): bool|string
    {
        $ch = curl_init();
        $url = "https://$this->id_project.supabase.co/auth/v1/logout";

        curl_setopt(handle: $ch, option: CURLOPT_URL, value: $url);
        curl_setopt(handle: $ch, option: CURLOPT_RETURNTRANSFER, value: true);
        curl_setopt(handle: $ch, option: CURLOPT_CUSTOMREQUEST, value: 'POST');
        curl_setopt(handle: $ch, option: CURLOPT_HTTPHEADER, value: [
            'apikey: ' . $this->apiKey,
            'Content-Type: application/json',
            'Authorization: Bearer ' . $user_token,
        ]);

        $response = curl_exec($ch);

        curl_close($ch);

        session_destroy();
        return $response;
    }

}
