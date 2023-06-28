<?php

namespace App\Class;

class App
{
    public static function getAgentIP()
    {
        $ip = 'Unknown';
        $cdn = null;
        $country = 'Unknown';
        if ($_SERVER['HTTP_CDN_LOOP'] == 'cloudflare') {
            $ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
            $cdn = $_SERVER['HTTP_CDN_LOOP'];
            $country = $_SERVER['HTTP_CF_IPCOUNTRY'];
        } else if (isset($_SERVER['HTTP_X_REAL_IP'])) {
            $ip = $_SERVER['HTTP_X_REAL_IP'];
        } else if (isset($_SERVER['REMOTE_ADDR'])) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return array('ip' => $ip, 'country' => $country, 'cdn' => $cdn);
    }

    public static function apiRequest(string $api_url, array $post = null)
    {
        $ch = curl_init($api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        if ($post) {
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
        }

        $headers = array();
        $headers[] = 'Accept: application/json';
        $headers[] = 'User-Agent: itsvc/1.0';

        if (isset($_SESSION['access_token']))
            $headers[] = 'Authorization: Bearer ' . $_SESSION['access_token'];

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response);
    }

    public static function RandomHex(int $length = 6)
    {
        $character = '0123456789abcdef';
        $characterLength = strlen($character);

        $randomHex = '';

        for ($i = 0; $i < $length; $i++) {
            $randomHex .= $character[rand(0, $characterLength - 1)];
        }
        return $randomHex;
    }
}
