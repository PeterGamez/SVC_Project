<?php

class App
{
    static function getAgentIP()
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
    static function apiRequest($api_url, $post = null)
    {
        $ch = curl_init($api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        if ($post) {
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
        }

        $headers = array();
        $headers[] = 'Accept: application/json';
        $headers[] = 'User-Agent: IBO/1.0';

        if (isset($_SESSION['access_token']))
            $headers[] = 'Authorization: Bearer ' . $_SESSION['access_token'];

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response);
    }
}
