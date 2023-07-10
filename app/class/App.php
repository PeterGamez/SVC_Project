<?php

namespace App\Class;

class App
{
    public static function getAgentIP(): array
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

    public static function apiRequest(string $api_url, array $post = null): array
    {
        $ch = curl_init($api_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if ($post) {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
        }

        $headers = array();
        $headers[] = 'Accept: application/json';
        $headers[] = 'User-Agent: itsvc/1.0';

        if (isset($_SESSION['access_token'])) {
            $headers[] = 'Authorization: Bearer ' . $_SESSION['access_token'];
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response, true);
    }

    public static function RandomText($length): string
    {
        $character = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $characterLength = strlen($character);

        $random = '';

        for ($i = 0; $length < 32; $i++) {
            $random .= $character[rand(0, $characterLength - 1)];
        }
        return $random;
    }

    public static function RandomHex(int $length = 6): string
    {
        $character = '0123456789abcdef';
        $characterLength = strlen($character);

        $randomHex = '';

        for ($i = 0; $i < $length; $i++) {
            $randomHex .= $character[rand(0, $characterLength - 1)];
        }
        return $randomHex;
    }

    public static function Captcha($captcha)
    {
        $cf_turnstile_path = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';

        if (!$captcha) {
            echo Alert_Login::alert('กรุณายืนยันตัวตนด้วย Captcha', 'warning', 1500, 'history.back()');
            return false;
        }
        $ip = App::getAgentIP();

        $result = App::apiRequest($cf_turnstile_path, array(
            'secret' => config('site.cloudflare.turnstile.secret'),
            'response' => $captcha,
            'remoteip' => $ip['ip']
        ));

        if ($result['success'] == false) {
            if ($result['error-codes'][0] == 'missing-input-secret' || $result['error-codes'][0] == 'invalid-input-response') {
                echo Alert_Login::contact();
            } else {
                echo Alert_Login::alert('ยืนยันตัวตนไม่สำเร็จ ' . $result['error-codes'][0], 'error', 1500, 'history.back()');
            }
            return false;
        }
        return true;
    }
}
