<?php

function config($key)
{
    $configKeys = explode('.', $key);
    $filename = array_shift($configKeys);
    $config = include(__ROOT__ . '/config/' . $filename . '.php');

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
    $resourcePath = __ROOT__ . '/public/resource/' . $key;
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

function admin_url($path = null, $ext = '')
{
    if (empty($path)) return url(config('site.admin_panel'));
    return url(config('site.admin_panel') . '/' . $path, $ext);
}

function member_url($path = null, $ext = '')
{
    if (empty($path)) return url(config('site.member_panel'));
    return url(config('site.member_panel') . '/' . $path, $ext);
}

function url_back()
{
    if ($_SERVER['HTTP_REFERER']) return $_SERVER['HTTP_REFERER'];
    else return url();
}

function controller($path)
{
    global $site;
    $path = str_replace('.', '/', $path);
    $controllerPath = __ROOT__ . '/controller/' . $path . '.php';
    if (file_exists($controllerPath)) {
        include $controllerPath;
        return;
    }
    return null;
}

function admin_controller($path)
{
    global $site;
    return controller('admin/' . $path);
}

function member_controller($path)
{
    global $site;
    return controller('member/' . $path);
}

function redirect($path)
{
    header('Location: ' . $path);
    exit;
}

function views($filename)
{
    global $site, $request;
    $filename = str_replace('.', '/', $filename);
    $viewPath = __ROOT__ . '/views/' . $filename . '.php';
    if (file_exists($viewPath)) {
        include $viewPath;
        return;
    }
    return null;
}

function admin_views($path = '')
{
    global $site, $request;
    return views('admin/' . $path);
}

function member_views($path = '')
{
    global $site, $request;
    return views('member/' . $path);
}

function visitor_views($path = '')
{
    global $site, $request;
    return views('visitor/' . $path);
}
