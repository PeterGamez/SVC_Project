<?php

namespace App\Class;

class App
{
    public static function isGET(): bool
    {
        return $_SERVER['REQUEST_METHOD'] == 'GET';
    }

    public static function isPOST(): bool
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }

    public static function error_404($message = null): string
    {
        $error_404 = [
            'status' => 404,
            'message' => $message ?? 'API Not Found'
        ];
        http_response_code(404);
        return json_encode($error_404);
    }

    public static function error_405(): string
    {
        $error_405 = [
            'status' => 405,
            'message' => 'Method Not Allowed'
        ];
        http_response_code(405);
        return json_encode($error_405);
    }

    /** 
     * @return array [ip, country, cdn]
     */
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

        for ($i = 0; $i < $length; $i++) {
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

    /**
     * @param string $captcha ค่า Captcha ที่ได้จาก cloudflare turnstile
     */
    public static function Captcha(string $captcha): bool
    {
        if (!$captcha) {
            echo Alert::alerts('กรุณายืนยันตัวตนด้วย Captcha', 'warning', 1500, 'history.back()');
            return false;
        }
        $ip = App::getAgentIP();

        $result = App::apiRequest('https://challenges.cloudflare.com/turnstile/v0/siteverify', array(
            'secret' => config('site.cloudflare.turnstile.secret'),
            'response' => $captcha,
            'remoteip' => $ip['ip']
        ));

        if ($result['success'] == false) {
            if ($result['error-codes'][0] == 'missing-input-secret' || $result['error-codes'][0] == 'invalid-input-response') {
                echo AlertLogin::contact();
            } else {
                echo Alert::alerts('ยืนยันตัวตนไม่สำเร็จ ' . $result['error-codes'][0], 'error', 1500, 'history.back()');
            }
            return false;
        }
        return true;
    }

    /**
     * @param string $datetime
     * @param int $format 0 = วันที่แบบเต็ม, 1 = วันที่แบบย่อ
     * @param bool $time แสดงเวลาด้วยหรือไม่
     * @param bool $second แสดงวินาทีด้วยหรือไม่
     */
    static function th_date($datetime, $format = 0, $time = false, $second = false): string
    {
        list($date, $time) = explode(' ', $datetime);
        list($H, $i) = explode(':', $time);
        list($Y, $m, $d) = explode('-', $date);
        $Y = $Y + 543;

        $month = array(
            '0' => array('01' => 'มกราคม', '02' => 'กุมภาพันธ์', '03' => 'มีนาคม', '04' => 'เมษายน', '05' => 'พฤษภาคม', '06' => 'มิถุนายน', '07' => 'กรกฏาคม', '08' => 'สิงหาคม', '09' => 'กันยายน', '10' => 'ตุลาคม', '11' => 'พฤษจิกายน', '12' => 'ธันวาคม'),
            '1' => array('01' => 'ม.ค.', '02' => 'ก.พ.', '03' => 'มี.ค.', '04' => 'เม.ย.', '05' => 'พ.ค.', '06' => 'มิ.ย.', '07' => 'ก.ค.', '08' => 'ส.ค.', '09' => 'ก.ย.', '10' => 'ต.ค.', '11' => 'พ.ย.', '12' => 'ธ.ค.')
        );

        $date =  $d . ' ' . $month[$format][$m] . ' ' . $Y;
        if ($time == true) {
            $date .= ' ' . $H . ':' . $i;
            if ($second == true) {
                $date .= ':' . $second;
            }
        }
        return $date;
    }

    /**
     * @param string $datetime
     * @param int $format 0 = วันที่แบบเต็ม, 1 = วันที่แบบย่อ
     * @param bool $time แสดงเวลาด้วยหรือไม่
     * @param bool $second แสดงวินาทีด้วยหรือไม่
     */
    static function en_date($datetime, $format = 0, $time = false, $second = false): string
    {
        list($date, $time) = explode(' ', $datetime);
        list($H, $i) = explode(':', $time);
        list($Y, $m, $d) = explode('-', $date);

        $month = array(
            '0' => array('01' => 'January', '02' => 'February', '03' => 'March', '04' => 'April', '05' => 'May', '06' => 'June', '07' => 'July', '08' => 'August', '09' => 'September', '10' => 'October', '11' => 'November', '12' => 'December'),
            '1' => array('01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr', '05' => 'May', '06' => 'Jun', '07' => 'July', '08' => 'Aug', '09' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec')
        );

        $date =  $d . ' ' . $month[$format][$m] . ' ' . $Y;
        if ($time == true) {
            $date .= ' ' . $H . ':' . $i;
            if ($second == true) {
                $date .= ':' . $second;
            }
        }
        return $date;
    }
}
