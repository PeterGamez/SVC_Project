<?php
session_start();

if (!isset($_SESSION['id'])) {
    $_SESSION['id'] = session_id();
    $_SESSION['login'] = false;
    $_SESSION['user_role'] = 'visitor';
}

function config($key)
{
    $configKeys = explode('.', $key);
    $filename = array_shift($configKeys);
    $config = include('./config/' . $filename . '.php');

    foreach ($configKeys as $nestedKey) {
        if (isset($config[$nestedKey])) {
            $config = $config[$nestedKey];
        } else {
            $config = null;
        }
    }

    return $config;
}

function resource($key, $url = false)
{
    global $site, $request;
    $resourcePath = './resource/' . $key;
    if (file_exists($resourcePath)) {
        if ($url == true) {
            $value = explode('.', $key);
            $key = $value[0];
            array_shift($value);
            $ext = implode('.', $value);

            return url('resource/' . $key, $ext);
        } else {
            include $resourcePath;
            return;
        }
    }
    return null;
}

function url($path = '', $ext = '')
{
    $protocol = $_SERVER['REQUEST_SCHEME'] . '://';
    if (!$path) $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    else {
        $path = str_replace('.', '/', $path);
        if ($path[0] != '/') $path = '/' . $path;
    }
    $url = $protocol . $_SERVER['HTTP_HOST'] . $path;
    if ($ext) $url .= '.' . $ext;
    return $url;
}

function sub_url($sub, $path = '', $ext = '')
{
    return url($sub . '/' . $path, $ext);
}

function admin_url($path = '', $ext = '')
{
    return url(config('site.admin_panel') . '/' . $path, $ext);
}

function controller($path)
{
    global $site;
    $path = str_replace('.', '/', $path);
    $controllerPath = './app/controller/' . $path . '.php';
    if (file_exists($controllerPath)) {
        include $controllerPath;
        return;
    }
    return null;
}

function api($path)
{
    global $site;
    $path = str_replace('.', '/', $path);
    $apiPath = './api/' . $path . '.php';
    if (file_exists($apiPath)) {
        include $apiPath;
        return;
    }
    return null;
}

function redirect($path)
{
    header('Location: ' . url($path));
    exit;
}

function views($filename)
{
    global $site, $request;
    $filename = str_replace('.', '/', $filename);
    $viewPath = './views/' . $filename . '.php';
    if (file_exists($viewPath)) {
        include $viewPath;
        return;
    }
    return null;
}

function admin_views($path = '')
{
    return views('admin/' . $path);
}

$agent = $_SERVER['HTTP_USER_AGENT'];
$agent_url = $_SERVER['REQUEST_URI'];
$agent_path = parse_url($agent_url, PHP_URL_PATH);
$agent_request = explode('/', $agent_path);
$agent_method = $_SERVER['REQUEST_METHOD'];

$Class = scandir('./app/class'); // ไฟล์ทั้งหมดในโฟลเดอร์
foreach ($Class as $key => $value) {
    if ($value != '.' && $value != '..') {
        require_once './app/class/' . $value;
    }
}

require_once './app/database.php';
